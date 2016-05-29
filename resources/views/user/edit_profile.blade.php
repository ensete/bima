<div class="content one-column">

    <h3>Edit Profile</h3>

    <form method="post" action="/user/edit-profile" class="form">
        <input name="_token" type="hidden" value="{!! csrf_token() !!}"/>
        <input name="user_id" type="hidden" value="{{ $user->id }}"/>

        <div class="form-group">
            <label for="name">Nickname: </label><br/>
            <input type="text" id="name" name="name" value="{{ $user->name }}" maxlength="20" required/>
        </div>

        <div class="form-group">
            <label for="gender">Gender: </label><br/>
            <select id="gender" name="gender">
                <option {{ ($user->gender == 'Female') ? 'selected' : '' }}>Female</option>
                <option {{ ($user->gender == 'Male') ? 'selected' : '' }}>Male</option>
            </select>
        </div>

        <div class="form-group">
            <label for="phone">Phone: </label><br/>
            <input type="text" id="phone" name="phone" value="{{ $user->phone }}" maxlength="20"/>
        </div>

        <div class="form-group">
            <label for="address">Location: </label><br/>
            <input type="text" id="address" name="address" value="{{ $user->address }}" maxlength="40"/>
        </div>

        <div class="form-group">
            <label for="facebook">Facebook: </label><br/>
            <input type="text" id="facebook" name="facebook" value="{{ $user->facebook }}" maxlength="40"/>
        </div>

        <div class="form-group">
            <label for="about">About: </label><br/>
            <textarea id="about" name="about" maxlength="255" rows="6">{{ $user->about }}</textarea>
        </div>

        <input type="submit" value="Save Changes"/>
    </form>
</div>

@include('elements.sidebar')
