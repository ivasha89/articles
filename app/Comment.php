<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $appends = [
        'date'
    ];

    /**
     * Get the article associated with the given comment
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article() {
        return $this->belongsTo(Article::class);
    }

    public function getDateAttribute(){
        return date('H:i:s d.m.Y', strtotime($this->created_at));
    }
}
