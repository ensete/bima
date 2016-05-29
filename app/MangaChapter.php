<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MangaChapter extends Model
{
    protected $guarded = [];

    public function manga() {
        return $this->belongsTo('App\Manga');
    }

    public function images() {
        return $this->hasMany('App\MangaImage', 'chapter_id');
    }

    public function scopeSelectChapter($query, $chapter_number, $active = 1) {
        $where['chapter_number'] = $chapter_number;
        if ($active == 1) {
            $where['active'] = $active;
        }
        return $query->where($where);
    }
}
