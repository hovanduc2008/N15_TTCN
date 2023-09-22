<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'ISBN',
        'added_by',
        'title',
        'slug',
        'image',
        'thumbnail',
        'price',
        'quantity',
        'author_id',
        'category_id',
        'description',
        'publication_date',
        'content',
        'meta_title',
        'meta_description',
        'deleted_at',
        'status'
    ];

    

}
