<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    protected $table = 'manga';
    protected $guarded = [];
    private $select = "manga.id, manga.name, manga.clean_url, DATE_FORMAT(manga.created_at, '%b %d, %Y') as date, manga.summary, manga.views";

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function team() {
        return $this->belongsTo('App\Team');
    }
    
    public function genres() {
        return $this->belongsToMany('App\Genre', 'manga_genres', 'manga_id', 'genre_id');
    }
    
    public function chapters() {
        return $this->hasMany('App\MangaChapter');
    }

    public function languages() {
        return $this->belongsToMany('App\Language', 'manga_languages', 'manga_id', 'language_id');
    }

    public function latestChapter() {
        return $this->hasOne('App\MangaChapter')->where('active', 1)->latest();
    }

    private function filterManga($query) {
        return $query->selectRaw($this->select)->with([
            'latestChapter' => function($query) {
                $query->selectRaw("manga_id, chapter_number, DATE_FORMAT(updated_at, '%b %d, %Y') as date")->where('active', 1);
            },
            'genres' => function($query) {
                $query->select('name');
        }]);
    }

    public function scopeLatestManga($query, $limit = 4) {
        return $this->filterManga($query)
            ->join('manga_chapters', 'manga.id', '=', 'manga_chapters.manga_id')
            ->groupBy('manga.id')
            ->orderBy('manga_chapters.created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function scopePopularManga($query, $limit = 4) {
        $query = $this->filterManga($query);
        return $query->orderBy('views', 'desc')->limit($limit)->get();
    }

    public function scopeNewestManga($query, $limit = 4) {
        $query = $this->filterManga($query);
        return $query->orderBy('date', 'DESC')->limit($limit)->get();
    }

    public function scopeAlphabetManga($query) {
        $query = $this->filterManga($query);
        return $query->orderBy('name');
    }

}