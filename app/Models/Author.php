<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_by',
        'name',
        'biography',
        'image',
        'thumbnail',
        'status',
        'email',
        'phone_number',
        'address',
        'gender',
        'date_of_birth',
        'deleted_at',
    ];
}
