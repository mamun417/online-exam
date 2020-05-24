<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static create(array $all)
 */
class Video extends Model
{
    protected $fillable = ['subject_id', 'name', 'embed_code', 'thumbnail'];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    protected $appends = ['video_id'];

    public function getVideoIdAttribute()
    {
        return $this->youtubeId($this->embed_code);
    }

    function youtubeID($url){
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return $match[1];
            }
            else
                return false;
        }

        return $url;
    }
}
