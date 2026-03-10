<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeFoto extends Model
{
    use HasFactory;

    protected $table = 'gallery_likefoto';
    protected $primaryKey = 'LikeID';

    protected $fillable = [
        'FotoID',
        'UserID',
        'TanggalLike',
    ];
}