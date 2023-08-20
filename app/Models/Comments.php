<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\News;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'News_ID',
        'Author',
        'Comment'
    ];

    public function news() {
        return $this->belongsTo(News::class, 'News_ID');
    }
}
