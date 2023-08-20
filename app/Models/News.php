<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comments;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'Title',
        'Post',
        'Author',
        'ImageName',
        'FileName',
    ];

    protected $table = 'tbl_news';

    public function comments() {
        return $this->hasMany(Comments::class, 'id');
    }
}
