<?php

namespace App\Http\Controllers;

use App\Language;
use App\Manga;
use App\MangaChapter;
use App\Genre;
use App\MangaImage;
use App\Bookmark;
use App\TextField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Intervention\Image\ImageManager;


class MangaController extends Controller
{

    public function index() {
        $data = [];
        $data['title'] = "Manga List";
        $data['content'] = "manga.list";
        $data['mangas'] = Manga::alphabetManga()->paginate(config('app.pagination'));
        return view('index', $data);
    }

    public function view_manga($cleanUrl) {
        $manga = Manga::with(['genres',
            'chapters' => function($query) {
                $query->orderBy('chapter_number', 'desc');
        }])->where('clean_url', $cleanUrl)->firstOrFail();

        $memberData = memberAuthentication($manga->team_id);

        $is_bookmarked = '';
        if ($memberData['user']) {
            $bookmark = Bookmark::where([
                'user_id' => $memberData['user']->id,
                'manga_id' => $manga->id
            ])->exists();
            if ($bookmark) {
                $is_bookmarked = 'active';
            }
        }

        $data = [];
        $data['title'] = $manga->name;
        $data['content'] = "manga.view_manga";
        $data['manga'] = $manga;
        $data['member_data'] = $memberData;
        $data['is_bookmarked'] = $is_bookmarked;
        return view('index', $data);
    }

    public function view_chapter($cleanUrl, $chapterNumber, $limit = 0, $page = 1) {
        $manga = Manga::where('clean_url', $cleanUrl)->select(['id', 'name', 'clean_url', 'views'])->firstOrFail();
        $chapter = $manga->chapters()->with([
            'images' => function($query) use ($page, $limit) {
                $query->orderBy('order');
                if ($limit) {
                    $pages = ceil($query->count() / $limit);
                    if ($page > $pages) {
                        $page = $pages;
                    }
                    $offset = ($page - 1) * $limit;
                    $query->skip($offset)->take($limit);
                }
            },
            'images.texts'
        ])->selectChapter($chapterNumber, 0)->firstOrFail();

        $manga->views += 1;
        $manga->save();

        $languages = [
            Language::find(1),
            Language::find(2),
        ];

        $toolbar = view('manga.toolbar', [
            'manga' => $manga,
            'chapter' => $chapter,
            'pagination' => $this->pagination($manga, $chapterNumber, $chapter, $limit, $page)
        ])->render();

        $data = [];
        $data['title'] = ' Ch.' . $chapter->chapter_number . ' - ' . $manga->name;
        $data['content'] = 'manga.view_chapter';
        $data['manga'] = $manga;
        $data['chapter'] = $chapter;
        $data['languages'] = $languages;
        $data['toolbar'] = $toolbar;
        $data['customCss'] = true;
        $data['js'] = ['jquery-ui.min.js', 'TweenMax.min.js', 'ripple-config.min.js'];

        return view('index', $data);
    }

    private function pagination($manga, $chapterNumber, $chapter, $limit, $page) {
        $nextChapter = $chapterNumber + 1;
        $prevChapter = $chapterNumber - 1;

        $pagination['limit'] = $limit;
        $pagination['currentChap'] = $chapterNumber;
        $pagination['prevChap'] = $manga->chapters()->selectChapter($prevChapter)->exists();
        $pagination['nextChap'] = $manga->chapters()->selectChapter($nextChapter)->exists();
        $pagination['prev'] = false;
        $pagination['next'] = false;

        $pages = 1;
        if ($limit) {
            $pages = ceil($chapter->images()->count() / $limit);
        }
        if ($page > $pages) {
            $page = $pages;
        }
        if ($page == 1 && $pages > 1) {
            $pagination['next'] = $page + 1;
        } elseif ($page == $pages) {
            $pagination['prev'] = $page - 1;
        } elseif ($page > 1 && $page < $pages) {
            $pagination['prev'] = $page - 1;
            $pagination['next'] = $page + 1;
        }
        if ($page == 1 && $pagination['prevChap']) {
            $pagination['prevChap'] = $prevChapter;
        } else {
            $pagination['prevChap'] = false;
        }
        if ($page == $pages && $pagination['nextChap']) {
            $pagination['nextChap'] = $nextChapter;
        } else {
            $pagination['nextChap'] = false;
        }

        return $pagination;
    }

    public function add_manga() {
        $user = adminAuthentication(true);

        $data = [];
        $data['title'] = "Add Manga";
        $data['content'] = "manga.manga_form";
        $data['user'] = $user['user'];
        $data['genres']= Genre::select('id', 'name')->get();
        $data['current_genres']= old('genres');
        return view('index', $data);
    }

    public function store_manga(Request $request) {
        $validation = $this->manga_rules();
        $this->validate($request, $validation['rules'], $validation['messages']);

        try {
            $data = $request->only('team_id', 'name', 'author', 'other_name', 'status', 'summary');
            $data['clean_url'] = generateCleanUrl($request->name);
            $manga = Manga::create($data);
            $manga->genres()->sync($request->genres);

            $this->createMangaAppearance("covers", $request->file('cover_image'), $manga->id, 300, 400);
            $this->createMangaAppearance("banners", $request->file('banner_image'), $manga->id, 920, 300);

            return redirect('/manga/' . $data['clean_url'])->with('success', 'Success');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit_manga($manga_id) {
        adminAuthentication(true);

        $manga = Manga::findOrFail($manga_id);

        $data['title'] = "Edit Manga";
        $data['content'] = "manga.manga_form";
        $data['manga'] = $manga;
        $data['genres']= Genre::select('id', 'name')->get();
        $data['current_genres']= $manga->genres->lists('id')->toArray();
        return view('index', $data);
    }

    public function update_manga(Request $request, $manga_id) {
        $validation = $this->manga_rules('unique:manga,name,'.$manga_id, 'image');
        $this->validate($request, $validation['rules'], $validation['messages']);

        try {
            $data = $request->only('name', 'author', 'other_name', 'status', 'summary');
            $data['clean_url'] = generateCleanUrl($request->name);
            $manga = Manga::find($manga_id);
            $manga->update($data);
            $manga->genres()->sync($request->genres);

            if ($cover = $request->file('cover_image')) {
                $this->createMangaAppearance("covers", $cover, $manga->id, 300, 400);
            }
            if ($banner = $request->file('banner_image')) {
                $this->createMangaAppearance("banners", $banner, $manga->id, 920, 300);
            }

            return redirect('/manga/' . $data['clean_url'])->with('success', 'Success');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function add_chapter($manga_id) {
        adminAuthentication(true);

        $manga = Manga::findOrFail($manga_id);

        $data = [];
        $data['title'] = "Add Chapter";
        $data['content'] = "manga.chapter_form";
        $data['manga'] = $manga;
        $data['is_active'] = '';
        return view('index', $data);
    }

    public function store_chapter(Request $request, $manga_id) {
        $manga = Manga::findOrFail($manga_id);

        try {
            DB::transaction(function () use ($manga_id, $request) {
                $chapter = new MangaChapter();
                $chapter->manga_id = $manga_id;
                $chapter_id = $this->saveChapter($request, $chapter);
                $this->createMangaImage($request->html_image, $chapter_id);
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Error: ".$e->getMessage()." in line ".$e->getLine().". Please contact admin for this problem");
        }

        return redirect("manga/$manga->clean_url")->with('success', 'Created');
    }

    public function edit_chapter($chapter_id) {
        adminAuthentication(true);

        $chapter = MangaChapter::findOrFail($chapter_id);

        $data = [];
        $data['title'] = "Edit Chapter";
        $data['content'] = "manga.chapter_form";
        $data['chapter'] = $chapter;
        $data['manga'] = $chapter->manga;
        $data['is_active'] = $chapter->active ? 'checked' : '';
        return view('index', $data);
    }

    public function update_chapter(Request $request, $chapter_id) {
        $chapter = MangaChapter::findOrFail($chapter_id);

        try {
            DB::transaction(function () use ($request, $chapter) {
                $chapter_id = $this->saveChapter($request, $chapter);

                if ($str = $request->html_image) {
                    $oldImages = MangaImage::where('chapter_id', $chapter_id)->select('id', 'order')->get();
                    MangaImage::where('chapter_id', $chapter_id)->delete();
                    $newImages = $this->createMangaImage($str, $chapter_id);
                    foreach ($oldImages as $image) {
                        if (isset($newImages[$image->order])) {
                            TextField::where('image_id', $image->id)->update(array('image_id' => $newImages[$image->order]));
                        }
                    }
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Error: ".$e->getMessage()." in line ".$e->getLine().". Please contact admin for this problem");
        }

        return redirect('manga/'.$chapter->manga->clean_url)->with('success', 'Edited');
    }

    public function edit_images($chapter_id, $order) {
        $chapter = MangaChapter::findOrFail($chapter_id);
        memberAuthentication($chapter->manga->team_id, true);
        $totalImg = $chapter->images()->count();
        $image = $chapter->images()->where('order', $order)->firstOrFail();
        $texts = $image->texts;
        $allLanguages = Language::all();

        $proceed['is_next'] = $chapter->images()->where('order', $order + 1)->exists();
        $proceed['is_prev'] = $chapter->images()->where('order', $order - 1)->exists();

        $data = [];
        $data['title'] = 'Edit Images';
        $data['content'] = 'manga.edit_images';
        $data['image'] = $image;
        $data['totalImg'] = $totalImg;
        $data['texts'] = $texts;
        $data['languages'] = $allLanguages;
        $data['proceed'] = $proceed;
        $data['js'] = ['jquery-ui.min.js', 'edit-image.js'];
        return view('index', $data);
    }

    public function store_texts(Request $request) {
        $text_id = [];
        foreach ($request['data'] as $text) {
            $id = $text['text_id'];
            unset($text['text_id']);
            if ($id < 0) {
                TextField::where('id', str_replace('-', '', $id))->delete();
            } elseif ($id > 0) {
                TextField::where('id', $id)->update($text);
            } else {
                $text = TextField::create($text);
                $text_id[] = $text->id;
            }
        }
        return response()->json($text_id);
    }

    public function bookmark(Request $request) {
        $user = userAuthentication();
        if($user) {
            $data = [
                'user_id' => $user->id,
                'manga_id' => $request->manga_id
            ];
            if($request->action == 1) {
                Bookmark::create($data);
            } else {
                Bookmark::where($data)->delete();
            }
            return 1;
        }
        return 0;
    }

    public function random() {
        $manga = Manga::orderByRaw("RAND()")->first();
        return redirect("/manga/$manga->clean_url");
    }

    private function saveChapter($request, $chapter) {
        $chapter->chapter_number = $request->number;
        $chapter->description = $request->name;
        $chapter->active = $request->exists('active') ? 1 : 0;
        $chapter->save();
        return $chapter->id;
    }

    private function createMangaAppearance($type, $file, $manga_id, $min, $max) {
        $manager = new ImageManager();
        $cover = $manager->make($file)->fit($min, $max);
        $cover->save("images/storage/manga/$type/$manga_id.jpg");
    }

    private function createMangaImage($html, $chapter_id) {
        preg_match_all('#href="([^\s]+)"#', $html, $fullPaths);
        $newImages = [];
        foreach ($fullPaths[1] as $fullPath) {
            $order = explode('.', explode('s1600/', $fullPath)[1])[0];
            $image = MangaImage::create([
                'chapter_id' => $chapter_id,
                'link' => $fullPath,
                'order' => $order
            ]);
            $newImages[$order] = $image->id;
        }
        return $newImages;
    }

    private function manga_rules($name = 'unique:manga', $image = 'required|image') {
        $validation['rules']  =  [
            'name'    => 'required|'.$name.'|max:100',
            'team_id'    => 'required',
            'cover_image' => $image,
            'banner_image' => $image,
            'author' => 'required|max:50',
            'other_name' => 'max:255',
            'status' => 'required',
            'genres' => 'required',
            'summary' => 'required',
        ];
        $validation['messages'] = [
            'required'    => 'The :attribute must be in presence.',
            'max' => 'The :attribute contains :max characters at most.',
            'image' => "Cover and banner for your manga must be an image",
            'unique' => 'Duplicate entry'
        ];
        return $validation;
    }
}