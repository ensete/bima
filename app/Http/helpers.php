<?php

function userAuthentication() {
    $user = 0;
    if (Auth::check()) {
        $user = Auth::user();
    }
    return $user;
}

function memberAuthentication($team_id, $redirect = false) {
    $data = [
        'is_member' => 0,
        'is_leader' => 0,
        'user' => 0
    ];
    if (Auth::check()) {
        $data['user'] = Auth::user();
        if ($data['user']->team_id == $team_id) {
            $data['is_member'] = 1;
        }
        if ($data['user']->id == $team_id) {
            $data['is_leader'] = 1;
        }
    }

    if($redirect == true && !$data['is_member']) {
        abort(403);
    }

    return $data;
}

function profileAuthentication($user_id, $team) {
    $data = [
        'is_owner' => 0,
        'is_admin' => 0,
        'is_leader' => 0,
        'user' => 0
    ];
    if (Auth::check()) {
        $data['user'] = Auth::user();
        if ($data['user']->id == $user_id) {
            $data['is_owner'] = 1;
            if ($team && $team->id == $user_id) {
                $data['is_leader'] = 1;
            }
        }
        if ($data['user']->id == 1) {
            $data['is_admin'] = 1;
        }
    }
    return $data;
}

function adminAuthentication($redirect = false) {
    $data = [
        'is_admin' => 0,
        'user' => 0
    ];

    if (Auth::check()) {
        $data['user'] = Auth::user();
        if ($data['user']->is_admin == 1) {
            $data['is_admin'] = 1;
        }
    }

    if ($redirect && !$data['is_admin']) {
        abort(403);
    }

    return $data;
}

function separatedByComma($data) {
    $str = "";
    foreach ($data as $el) {
        $str .= ", $el";
    }
    return substr($str, 2);
}

function generateCleanUrl($title) {
    $cleanUrl = str_replace(' ', '-', $title);
    $cleanUrl = preg_replace('/[^A-Za-z0-9\-]/', '', $cleanUrl);
    return preg_replace('/-+/', '-', $cleanUrl);
}

function checkGenre($genre_id, $genres) {
    $is_check = '';
    if ($genres) {
        if (in_array($genre_id, $genres)) {
            $is_check = 'checked';
        }
    }
    return $is_check;
}

function renderText($text, $typing) {
    $class = '';
    if ($typing == 2) {
        $class = ' vertical-style';
    }
    //waiting for fire-fox to fix this fucking silly hyphen bug
    return '<div class="div-text bubble'.$class.'" style="'.$text->style.'">'.str_replace('-', '-<wbr>', $text->content).'</div>';
}

function chapterPagination($pagination, $cleanUrl) {
    $data = [
        'prev' => 'left',
        'next' => 'right'
    ];

    $html = '';
    foreach ($data as $navigate => $position) {
        $page = 1;
        $chapter = $pagination['currentChap'];
        $is_exist = true;
        if ($pagination[$navigate]) {
            $page = $pagination[$navigate];
        } elseif($pagination[$navigate.'Chap']) {
            $chapter = $pagination[$navigate.'Chap'];
        } else {
            $is_exist = false;
        }
        if ($is_exist) {
            $limit = '';
            if ($pagination['limit']) {
                $limit = $pagination['limit'].'-'.$page;
            }
            $html .= '<a href="/manga/'.$cleanUrl.'/chapter-'.$chapter.'/'.$limit.'">';
            $html .= '<div class="btn-control '.$position.'"><i class="fa fa-angle-'.$position.'"></i></div></a>';
        }
    }

    return $html;
}
