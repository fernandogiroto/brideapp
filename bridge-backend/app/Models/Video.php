<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status_id',
        'category_id',
        'parent_video_id',
        'title',
        'path',
        'file_name'
    ];

    protected $appends = ['is_original'];

    /**
     * Accessor to determine if the video is an original (not a reaction).
     *
     * Example of use:
     *
     * $video = Video::find(1);
     *
     * if ($video->is_original) {
     *     echo "This is an original video.";
     * } else {
     *     echo "This is a reaction video.";
     * }
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isOriginal(): Attribute
    {
        return Attribute::make(
            get: fn () => is_null($this->parent_video_id),
        );
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
