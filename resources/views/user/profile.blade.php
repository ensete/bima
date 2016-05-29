<div class="content one-column view-profile">
    <div id="profile-container">
        <img id="monster" src="/images/rank/{{ $user->pet->source }}" title="{{ $user->pet->name }}"/>

        <div id="main-name">
            <div id="svg-text-container">
                @if($user->id != 1)
                    {{ $user->name }}
                @else
                    <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg"                          id="svg-text" width="150" height="55" viewBox="0 0 150 55">                     <defs id="defs3039" />                     <metadata id="metadata3042">                         <rdf:RDF>                             <cc:Work                                     rdf:about="">                                 <dc:format>image/svg+xml</dc:format>                                 <dc:type                                         rdf:resource="http://purl.org/dc/dcmitype/StillImage" />                                 <dc:title></dc:title>                             </cc:Work>                         </rdf:RDF>                     </metadata>                     <g transform="translate(-89.089844,-307.68025)" id="layer1">                         <g id="flowRoot3045" style="font-size:40px;font-style:normal;font-variant:normal;font-weight:bold;font-stretch:normal;line-height:125%;letter-spacing:0px;word-spacing:0px;fill:#000000;fill-opacity:1;stroke:none;font-family:Agency FB;-inkscape-font-specification:Agency FB Bold">                             <path class="svg-text" d="m 241.29687,343.01229 c -1e-5,1.62759 -0.83985,2.44139 -2.51953,2.4414 l -7.77343,0 c -1.67969,-10e-6 -2.51954,-0.81381 -2.51954,-2.4414 l 0,-3.16407 4.31641,0 0,2.36328 4.04297,0 0,-4.08203 -4.58984,0 c -1.25001,0 -2.24285,-0.35156 -2.97852,-1.05468 -0.73568,-0.70313 -1.10352,-1.67318 -1.10352,-2.91016 l 0,-12.07031 c 0,-1.1328 0.31901,-2.02472 0.95704,-2.67578 0.63801,-0.65103 1.51692,-0.97655 2.63671,-0.97657 0.5599,2e-5 2.2526,0.26695 5.07813,0.80078 l 0,-0.72265 4.45312,0 z m -4.45312,-8.47657 0,-12.1289 c -1.4974,-0.15624 -2.42839,-0.23436 -2.79297,-0.23438 -0.96355,2e-5 -1.44532,0.47528 -1.44531,1.42578 l 0,9.45313 c -1e-5,0.98959 0.49478,1.48438 1.48437,1.48437 z m -11.875,3.71094 -4.49219,0 0,-15.99609 -4.19922,0.0781 0,15.91797 -4.47265,0 0,-19.72656 4.47265,0 0,0.72265 c 1.04166,-0.16925 2.07682,-0.33201 3.10547,-0.48828 1.27603,-0.20831 2.32421,-0.31248 3.14453,-0.3125 1.62759,2e-5 2.4414,0.8008 2.44141,2.40235 z m -16.44531,0 -4.45313,0 0,-0.68359 c -1.02865,0.16927 -2.06381,0.33854 -3.10547,0.50781 -1.26302,0.19531 -2.30469,0.29297 -3.125,0.29297 -1.6276,0 -2.4414,-0.8138 -2.4414,-2.44141 l 0,-17.40234 4.43359,0 0,16.01562 4.23828,-0.0977 0,-15.91797 4.45313,0 z m -15.6836,-11.48437 -4.43359,0 0,-4.51172 -3.53516,0.0781 0,15.91797 -4.47265,0 0,-19.72656 4.47265,0 0,0.72265 c 0.92448,-0.16925 1.84244,-0.33852 2.75391,-0.50781 1.10676,-0.19529 2.03124,-0.29295 2.77344,-0.29297 1.62759,2e-5 2.44139,0.8008 2.4414,2.40235 z m -14.55078,-15.03907 -5.03906,0 0,26.52344 -4.55078,0 0,-26.52344 -5.03906,0 0,-4.04297 14.6289,0 z m -25.03906,26.52344 -4.49219,0 0,-15.99609 -4.19922,0.0781 0,15.91797 -4.47265,0 0,-19.72656 4.47265,0 0,0.72265 c 1.04166,-0.16925 2.07682,-0.33201 3.10547,-0.48828 1.27603,-0.20831 2.32421,-0.31248 3.14453,-0.3125 1.62759,2e-5 2.4414,0.8008 2.44141,2.40235 z m -16.38672,0 -4.27734,0 0,-0.68359 c -1.01564,0.15625 -2.03126,0.3125 -3.04688,0.46875 -1.32813,0.19531 -2.33724,0.29297 -3.02734,0.29297 -1.62761,0 -2.44141,-0.80079 -2.44141,-2.40235 l 0,-7.10937 c 0,-1.6276 0.83984,-2.4414 2.51953,-2.44141 l 6.03516,0 0,-4.53125 -4.27734,0 0,2.8125 -4.04297,0 0,-3.69141 c 0,-1.62758 0.83984,-2.44138 2.51953,-2.4414 l 7.55859,0 c 1.65363,2e-5 2.48046,0.81382 2.48047,2.4414 z m -4.23828,-3.55469 0,-5.29297 -4.27734,0 0,5.44922 z m -11.75781,3.55469 -4.45313,0 0,-0.68359 c -1.02865,0.16927 -2.06381,0.33854 -3.10547,0.50781 -1.26302,0.19531 -2.30469,0.29297 -3.125,0.29297 -1.6276,0 -2.4414,-0.8138 -2.4414,-2.44141 l 0,-17.40234 4.43359,0 0,16.01562 4.23828,-0.0977 0,-15.91797 4.45313,0 z m -15.23438,0 -4.9414,0 -3.359379,-10.76172 -3.378906,10.76172 -4.863281,0 0,-0.15625 5.703125,-15.48828 c -3.580732,-9.89581 -5.364584,-14.86976 -5.351563,-14.92188 l 4.882813,0 3.046875,9.96094 3.066406,-9.96094 4.84375,0 0,0.17579 -5.351563,14.6289 z" id="path3070" />                         </g>                     </g>                 </svg>
                @endif
            </div>
        </div>

        <div id="main-top"></div>
        <div id="main-mid">
            <div>
                <div id="sub-container">
                    <div id="sub-top"></div>
                    <div id="sub-mid">
                        <div class="profile-avatar"
                             style="background-image: url(/images/storage/avatars/{{ $user->avatar }})"></div>
                    </div>
                    <div id="sub-bot"></div>
                </div>

                <div id="profile-info">
                    <p id="profile-rank-text"><span>R</span>ank: {{ $user->rank->title }}</p>

                    <div id="profile-rank-deco"></div>
                    <div id="profile-team">
                        <p>Team: {{ isset($user->team->name) ? $user->team->name : "N/A" }}</p>
                        <?php $roles = $user->roles->isEmpty() ? "N/A" : separatedByComma($user->roles->lists('name')) ?>
                        <p class="limit-text" title="{{ $roles }}">Role: {{ $roles }}</p>
                    </div>
                </div>
            </div>

            <div id="profile-btn-container">
                @if ($currentUser['is_owner'])
                    @if ($currentUser['is_leader'])
                        <a href="/manga/add-manga" class="shiny-button profile-btn">Add Manga</a>
                    @endif
                    @if ($currentUser['is_admin'])
                        <a href="/blog/add-blog" class="shiny-button profile-btn">Add Blog</a>
                    @endif
                    @if (!$user->team_id)
                            <a href="/team/create-team" class="shiny-button profile-btn">Create Team</a>
                    @endif
                    <a href="/user/bookmarks" class="shiny-button profile-btn">Bookmarks</a>
                    <a href="/user/edit-profile" class="shiny-button profile-btn">Edit Profile</a>
                @else
                    @if (!$user->team_id && $currentUser['user'])
                        @if ($currentUser['user']->team_id)
                            <a href="/team/invite/{{ $user->id }}" class="shiny-button profile-btn">Invite to Team</a>
                        @endif
                    @endif
                @endif
            </div>

            <div class="info">
                <p><b>Nickname:</b>
                    {{ $user->name }}
                    {!! ($user->gender == 'Female') ? '<i class="fa fa-venus female"></i>' : '' !!}
                    {!! ($user->gender == 'Male') ? '<i class="fa fa-mars male"></i>' : '' !!}
                </p>

                <p><b>Email:</b> {{ $user->email }}</p>

                <p><b>Location:</b> {{ $user->address or 'N/A' }}</p>

                <p><b>Phone:</b> {{ $user->phone or 'N/A' }}</p>

                <p><b>Facebook:</b> {{ $user->facebook or 'N/A' }}</p>

                <p style="margin-bottom: 3px"><b>About:</b></p>

                <div class="limit-text">{{ $user->about or 'N/A' }}</div>
            </div>
            <div id="main-bot"></div>
        </div>

    </div>
</div>

@include('elements/sidebar')

