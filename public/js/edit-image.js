var textData = {};
textData.str = '';
textData.array = [];

$(function() {
    var controlPanel = $("#control-panel");
    var fontFamily = $('#font-family');
    var fontSize = $('#font-size');
    var localLanguageId = localStorage.languageId;

    setSelected(fontFamily, localStorage.font);
    setSelected(fontSize, localStorage.fontSize);
    setChecked('background', localStorage.background);

    $('.sub-container').css('display', 'block');

    controlPanel.draggable({containment: "html"});
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 400) {
            controlPanel.addClass("fixed");
        } else {
            controlPanel.removeClass("fixed");
        }
    });

    if (localLanguageId) {
        setChecked('language', localLanguageId);
        changeLanguage(localLanguageId);
    }

    fontFamily.on('change', function() {
        changeInput($(this));
        localStorage.font = $(this).val();
    });

    fontSize.on('input', function() {
        changeInput($(this), 'px');
        localStorage.fontSize = $(this).val();
    });

    $('input[name=background]').on('change', function() {
        $('.input-text.bubble').toggleClass('transparent');
        localStorage.background = $(this).val();
    });

    $('input[name=language]').on('change', function() {
        var language_id = $(this).val();
        var typing = $(this).data('typing');
        if (typing == 2) {
            $('.input-text.bubble').addClass('vertical-style');
        } else {
            $('.input-text.bubble').removeClass('vertical-style');
        }
        changeLanguage(language_id);
        localStorage.languageId = language_id;
    });

    $('#add-bold').on('click', function() {
        var $input = $('#code-text');
        var txt = $input.val();
        if (txt.search('<b>') != -1) {
            txt = txt.replace('<b>', '');
            txt = txt.replace('</b>', '');
        } else {
            txt = '<b>'+txt+'</b>';
        }
        $input.val(txt).change();
    });

    $('#toggle-background').on('click', function() {
        $('.input-text.active').toggleClass('white-bg');
    });

    $('#toggle-text-style').on('click', function() {
        $('.input-text.active').toggleClass('vertical-style');
    });

    $('#rotate-left').on('click', function() {
        rotateText('left');
    });

    $('#rotate-right').on('click', function() {
        rotateText('right');
    });

    $('#code-text').on('keydown keyup change', function() {
        insertText(this);
    });

    $('#apply-text-field').on('click', function() {
        var fields  = $('.draggable');
        var img = $('.image-container').find('img');
        console.log(fields.length);
        fields.each(function(i, obj) {
            var object = $(obj);
            var input = object.find('.input-text');
            var text_id = object.attr('data-text-id').replace('-', '');
            var text = input.html();
            var typing = '';
            if (input.hasClass('vertical-style')) {
                typing = ' vertical-style';
            }
            if (text != '') {
                var $language = $('input[name=language]:checked');
                var font = object.css('font-family');
                var fontSize = object.css('font-size');
                var position = getPosition(object, 'left', 'top');
                var matrix = object.css('transform');
                var textStyle = object.find('.input-text').css('-webkit-writing-mode');

                var style = '';
                style += 'font-family:'+font+';font-size:'+fontSize;
                style += ';left:'+position['f']+';top:'+position['s'];

                if ($language.data('typing') == 1) {
                    style += ';width:'+input.css('width');
                }

                if (textStyle == 'horizontal-tb' && $language.data('typing') == 2) {
                    style += ';-webkit-writing-mode:initial;-webkit-text-orientation:initial';
                }

                if (input.hasClass('white-bg')) {
                    style += ';background:#fff;padding:5px;border:1px solid';
                }

                if (matrix != 'none') {
                    var angle = getAngle(matrix);
                    style += ';-ms-transform:rotate('+angle+'deg);-webkit-transform:rotate('+angle+'deg);transform:rotate('+angle+'deg)';
                }

                var text_bubble = $('<div class="div-text bubble'+typing+'" data-text-id="'+text_id+'" style="'+style+'"><div class="edit-speech"><i class="fa fa-remove"></i><i class="fa fa-edit"></i></div><span>'+text+'</span></div>');
                object.remove();
                var language_id = $language.val();
                $('.language[data-language-id='+language_id+']').append(text_bubble);
                $('#code-text').val('');
            }
        });
    });

    $('#save-all').on('click', function() {
        var area = $('#image-area');
        var image_id = area.find('img').data('image-id');
        var data = [];
        $('*[data-text-id]').each(function(i, obj) {
            var object = $(obj);
            data.push({
                'text_id': object.attr('data-text-id'),
                'image_id': image_id,
                'language_id': object.parent().data('language-id'),
                'content': object.find('span').html(),
                'style': object.attr('style')
            });
        });

        if (!data) {
            return false;
        }

        $.ajax({
            context: this,
            type: "POST",
            url: "/manga/store_texts",
            data: { '_token': $('#_token').val(), 'image_id': image_id, 'data': data },
            beforeSend: function() {
                $(this).html('<img src="/images/ajax-loader.gif"/>');
            },
            success: function(result) {
                area.find('.div-text.bubble[data-text-id=0]').each(function(i, obj) {
                    $(obj).attr('data-text-id', result[i]);
                });
                jellyNoti('ns-success', ['Success']);
            },
            error: function() {
                jellyNoti('ns-error', [':(']);
            },
            complete: function() {
                $(this).html('Save');
            }
        });
    });

    $('.language').on('click', function(e) {
        var $activeInput = $('.input-text.active');
        if ($activeInput.length > 0) {
            $activeInput.removeClass("active");
            $('#code-text').val("");
        } else if (textData.array.length > 0) {
            var parentOffset = $(this).parent().offset();
            var x = e.pageX - parentOffset.left;
            var y = e.pageY - parentOffset.top;

            var family = getStyle($('#font-family'));
            var size = getStyle($('#font-size'), 'px');
            var style = '';

            var movedText = textData.array.splice(0, 1);
			if (textData.array.length !== 0) {
				textData.str = textData.str.replace(movedText+'\n\n', '');
			} else {
				textData.str = '';
			}
            
            style += family['attr'] + ':' + family['style'] + ';';
            style += size['attr'] + ':' + size['style'] + ';';
            style += 'left:' + x + 'px;top:' + y + 'px;';
            draggableHtml(style, movedText, 0, '');
            $('#code-text').val(textData.str).focus();
        }
    });
});

$(document).on('mousedown', '.drag-handle', function() {
    var $input = $(this).siblings('.input-text');
    changeActiveStatus($input);
    $('#code-text').val(removeRubyTag($input.html())).focus();
});

$(document).on('click', '.fa-remove', function() {
    var object = $(this).parent().parent();
    var text_id =  object.data('text-id');
    object.fadeOut('fast', function() {
        if (text_id == 0) {
            object.remove();
        } else {
            object.attr('data-text-id', '-'+text_id);
        }
    });
});

$(document).on('click', '.fa-edit', function() {
    var object = $(this).parent().parent();
    var style = object.attr('style');
    var inputClass = 'active';
    if (object.css('border') == '1px solid rgb(0, 0, 0)') {
        inputClass += ' white-bg';
        style = style.replace('background:#fff;padding:5px;border:1px solid', '');
    }
    var text = removeRubyTag(object.find('span').html());
    draggableHtml(style, text, -object.attr('data-text-id'), inputClass);
    object.remove();
    $('#code-text').val(text).change();
});

function getStyle(element, size) {
    var data = {};
    data['attr'] = element.attr('id');
    var style = element.val();
    if (size) {
        style += size;
    }
    data['style'] = style;
    return data;
}

function changeInput(element, size) {
    var data = getStyle(element, size);
    $('.draggable').css(data['attr'], data['style']);
}

function changeActiveStatus(el) {
    textData.str = '';
    textData.array = [];
    $('.input-text').removeClass('active');
    el.addClass('active');
}

function getPosition(object, first, second) {
    var img = $('.image-container').find('img');
    var data = [];
    data['f'] = object.css(first);
    data['s'] = object.css(second);
    return data;
}

function changeLanguage(language_id) {
    $('.language').each(function(i, obj) {
        var object = $(obj);
        object.removeClass('active').addClass('none');
        if (object.data('language-id') == language_id) {
            object.addClass('active').removeClass('none');
        }
    });
}

function setSelected(object, value) {
    if (value) {
        object.val(value);
    }
}

function setChecked(name, value) {
    $('input[name='+name+'][value="'+value+'"]').prop('checked',true);
}

function getAngle(matrix) {
    var values = matrix.split('(')[1].split(')')[0].split(',');
    var a = values[0];
    var b = values[1];
    return Math.round(Math.atan2(b, a) * (180/Math.PI));
}

function rotateText(direction) {
    var $input = $('.draggable');
    var matrix = $input.css('transform');
    var angle = 0;
    if (matrix != 'none') {
        angle = getAngle(matrix);
    }
    if (direction == 'left') {
        angle -= 1;
    } else {
        angle += 1;
    }
    $input.css('transform', 'rotate('+angle+'deg)');
}

function draggableHtml(style, text, text_id, inputClass) {
    var $language = $('input[name=language]:checked');
    var background = '';
    var typingStyle = '';
    var width = '';
    if ($language.data('typing') == 1) {
        width = 'width:10px';
    }
    if ($('input[name=background]:checked').val() == 2) {
        background = ' transparent ';
    }
    if ($language.data('typing') == 2) {
        typingStyle = ' vertical-style ';
    }
    $('.input-text').removeClass('active');
    var $html = $('<div class="draggable" data-text-id="'+text_id+'" style="'+style+'"><div class="drag-handle"></div><div style="'+width+'" class="input-text bubble '+background+typingStyle+inputClass+'">'+text+'</div></div>');

    var container = $('.image-container');
    container.append($html);
    var img = container.find('img');
    $html.draggable({
        containment: img,
        cancel: '.input-text'
    }).bind('click', function() {
        changeActiveStatus($html.find('.input-text'));
        $('#code-text').val(removeRubyTag($html.find('.input-text').html())).focus();
    });
}

function removeRubyTag(txt) {
    var $txt = $('<span>'+txt+'</span>');
    $txt.find('ruby').each(function(i, obj) {
        var $object = $(obj);
        var kanji = $object.html().split('<rt>')[0];
        var furigana = $($object).find('rt').html();
        txt = txt.replace('<ruby>'+kanji+'<rt>'+furigana+'</rt></ruby>', '（'+kanji+' '+furigana+'）');
    });
    return txt;
}

function insertText(el) {
    var txt = $(el).val();
    var kanjiTxt = txt.split('（');
    for (var i = 1; i < kanjiTxt.length; i++) {
        var target = '',
            fullWord = kanjiTxt[i].split('）')[0].split(' ');
        if (fullWord.length == 1) {
            fullWord = fullWord[0].split('　');
            target = '（'+fullWord[0]+'　'+fullWord[1]+'）';
        } else {
            target = '（'+fullWord[0]+' '+fullWord[1]+'）';
        }
        txt = txt.replace(target, '<ruby>'+fullWord[0]+'<rt>'+fullWord[1]+'</rt></ruby>');
    }
    var $activeInput = $('.input-text.active');
    if (!$activeInput.length) {
        textData.str = txt;
        textData.array = txt.split('\n\n');
    } else {
        $activeInput.html(txt);
    }
}
