function slide(el1, el2) {
    $('#blur-overlay').addClass("enabled");
    $('body').addClass("no-scroll");
    $(el1).addClass("slide");
    $(el2).addClass("slide");
}

function triggerLogin() {
    slide('#ghost-container', '#login-container');
    $('#login-username').focus();
}

function triggerRegister() {
    slide('#supreme-container', '#register-container');
    $('#register-username').focus();
}

function disableOverlay() {
    $('#blur-overlay').attr('class', 'hidden');
    $('#ghost-container').removeClass();
    $('#supreme-container').removeClass();
    $('#login-container').removeClass();
    $('#register-container').removeClass();
    $('body').removeClass();
}

function readURL(input, selector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(selector).attr('style', 'background-image: url('+e.target.result+')');
        };

        reader.readAsDataURL(input.files[0]);
    }
}

//type: ns-error, ns-success
function jellyNoti(type, messages) {
    var container = $('#notify-container');
    container.html("");

    $.each(messages , function(i, val) {
        var str = '';
        str += '<div class="ns-effect-jelly '+type+' ns-show">';
        str += '<div class="ns-box-inner">';
        str += "<p>"+val+"</p></div></div>";
        container.append(str);
    });
}

function bookmark(manga_id, token) {
    var bookmark = $('#bookmark-icon');
    var data = {
        'manga_id': manga_id,
        '_token': token
    };
    if(bookmark.hasClass('active')) {
        data['action'] = 0;
    } else {
        data['action'] = 1;
    }

    var request = $.ajax({
        type: "POST",
        url: "/manga/bookmark",
        data: data,
        beforeSend: function() {
            if(data['action'] == 1) {
                bookmark.addClass('active');
            } else {
                bookmark.removeClass('active');
            }
        }
    });

    request.done(function(response) {
        if(response == 0) {
            jellyNoti('ns-error', ['Login first to bookmark the manga :(']);
        }
    });
}

$(document).ready(function() {
    var url = $(location).attr('href').split("/");
    $('.'+url[3]+'-header').addClass('active');

    $("#cover_image").change(function(){
        readURL(this, '#demo-cover');
    });

    $("#banner_image").change(function(){
        readURL(this, '#demo-banner');
    });

    var readMode = $('.read-mode');
    var limit = readMode.data('limit');
    var chapterUrl = '/'+url[1]+'/'+url[2]+'/'+url[3]+'/'+url[4]+'/';
    readMode.val(limit);
    readMode.on('change', function() {
        limit = $(this).val();
        chapterUrl += url[5];
        if (limit != 0) {
            chapterUrl += '/'+limit+'-1';
        }
        window.location = chapterUrl;
    });

    $('.chapter-list').on('change', function() {
        var chapterNumber = $(this).val();
        chapterUrl += 'chapter-'+chapterNumber;
        if (limit != 0) {
            chapterUrl += '/'+limit+'-1';
        }
        window.location = chapterUrl;
    });

    //ajax register
    $('#register-form').on('submit', function(e) {
        e.preventDefault();

        var msg = $('#register-msg');
        var data = {
            _token: $('#register-token').val(),
            username: $('#register-username').val(),
            password: $('#register-pass').val(),
            password_confirmation: $('#register-confirm-pass').val(),
            email: $('#register-email').val()
        };

        var request = $.ajax({
            type: "POST",
            url: "/user/register",
            data: data,
            dataType: "json",
            beforeSend: function() {
                msg.css('top', '-50px');
                msg.html('<img src="/images/fish-loader.gif">');
            }
        });

        request.done(function(data) {
            jellyNoti('ns-success', ['Success. You can now login with your account.']);
            $('#register-form')[0].reset();
            msg.css('top', '-40px');
            msg.html(data['success']);
        });

        request.fail(function(data) {
            var errors = data.responseJSON;
            jellyNoti('ns-error', errors);
            msg.css('top', '-40px');
            msg.html(":(");
        });
    });

    //ajax remove bookmark
    $('.table').on('click', '.remove-bookmark', function() {
        var data = {
            _token: $('#bookmark-token').val(),
            id: $(this).data('bookmark-id')
        };

        var request = $.ajax({
            type: "POST",
            url: "/user/remove_bookmark",
            data: data,
            context: this,
            beforeSend: function() {
                $(this).closest('tr').fadeOut();
            }
        });

        request.done(function(data) {
            if (data == 1) {
                jellyNoti('ns-success', ['Removed from your list']);
            } else {
                jellyNoti('ns-error', ['Give us time to process your request']);
            }
        });
    });

    $('#poke').on('click', function() {
        jellyNoti('ns-success', ["Ooouch! We'll upload soon."]);
    });
});

$(document).on('click', ".ns-effect-jelly", function() {
    $(this).fadeOut();
});

$(document).on('click', '#md-close', function() {
    $('body').removeClass();
    $('#md-container').removeClass('md-show');
});

$(document).on('copy', '.div-text', function (e) {
    var rt = $('rt');
    e.preventDefault();
    rt.css('visibility', 'hidden');
    e.originalEvent.clipboardData.setData('text', window.getSelection().toString());
    rt.css('visibility', 'visible');
});
