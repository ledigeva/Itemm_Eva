<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Zend\Barcode\Barcode;
use Zend\Barcode\Renderer\Image;
use Zend\Barcode\Renderer\ImageRenderer;

class Post extends Model
{
    /*
    protected $table="post";
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];*/

protected $fillable = [
   'title',
    'slug',
   'content',
   'text'
];



    use HasFactory;
}
