<div class="content one-column">

    <h3>Create Team</h3>

    <form method="post" action="/team/create-team" style="width: 40%">
        <input name="_token" type="hidden" value="{!! csrf_token() !!}"/>

        <div class="form-group">
            <label for="name">Team Name: </label><br/>
            <input type="text" id="name" name="name" min="4" max="25" required/>
        </div>

        <div class="form-group">
            <label for="description">Team Description: </label><br/>
            <textarea id="description" name="description" required></textarea>
        </div>

        <div class="form-group">
            <input type="submit" value="Create"/>
        </div>
    </form>
</div>

@include('elements.sidebar')

