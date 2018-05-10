<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phrase extends Model
{
    protected $fillable = ['text', 'language_id', 'count'];

    public function requiredLanguages() {
        return $this->belongsToMany('App\Language')->withTimestamps();
    }

    public function translations() {
        return $this->belongsToMany('App\Phrase', 'phrase_phrase', 'phrase_id', 'phrase1_id')->withPivot('count')->withTimestamps();
    }
}
