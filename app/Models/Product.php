<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['book_name','book_image','book_pdf','book_description','view_count','book_category','book_grade','book_subject'];
}
