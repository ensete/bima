<div class="content one-column">

    <h3>{{ $title }}</h3>

    <form method="post" action="" enctype="multipart/form-data">
        <input name="_token" type="hidden" value="{!! csrf_token() !!}"/>
        <input name="user_id" type="hidden" value="{{ $user->id }}"/>

        <div class="form-group">
            <label for="blog_banner">Blog Banner (preferably 920x300): </label><br/>
            <input type="file" id="blog_banner" name="blog_banner" accept="image/*"/>
        </div>

        <div class="form-group">
            <label for="title">Title: </label><br/>
            <input type="text" id="title" name="title" value="{{ @$blog->title }}" required/>
        </div>

        <div class="form-group">
            <label for="content">Content: </label><br/>
                <textarea id="content" name="content" required>
                    {{ @$blog->content }}
                </textarea>
        </div>

        <input type="submit" value="Save"/>
    </form>
</div>

@include('elements.sidebar')

<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
