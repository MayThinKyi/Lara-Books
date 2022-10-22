<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryController extends Controller
{
    //list
    public function list(){
        return view('admin.library.libraryList');
    }
}
