<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'News_ID',
        'EventType',
        'Role',
        'Message',
        'RequestData',
        'ResponseData',
        'ExceptionMessage',
        'Status',
    ];

    protected $table = 'logs';
}
