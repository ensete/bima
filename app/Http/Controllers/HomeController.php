<?php

namespace App\Http\Controllers;

use App\Manga;

class HomeController extends Controller {

    public function index() {
        $data = [];
        $data['title'] = "Home";
        $data['content'] = "home.content";
        $data['latest_manga'] = Manga::latestManga(6);
        $data['popular_manga'] = Manga::popularManga(4);
        return view('index', $data);
    }
}
