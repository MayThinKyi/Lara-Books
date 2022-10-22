<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Product;

class UserController extends Controller
{
    //Home Page
    public function home(){
        $categories=Category::get();
        return view('user.home',compact('categories'));
    }
    //Grade Page
    public function gradePage($id){
        $categoryId=$id;
        $grades=Grade::where('grade_category',$id)->get();
        return view('user.grade',compact('grades','categoryId'));
    }
    //Grade
    public function grade($categoryId,$gradeId){
        $categoryId=$categoryId;
        $gradeId=$gradeId;

        $subjects=Subject::where('subject_category',$categoryId)->where('subject_grade',$gradeId)->get();
        return view('user.subject',compact('subjects','categoryId','gradeId'));
    }
    //book
    public function bookPage($categoryId,$gradeId,$subjectId){

        $book=Product::select('products.*','categories.category_name as book_category','grades.grade_name as book_grade','subjects.subject_name as book_subject')
                        ->leftJoin('categories','products.book_category','categories.id')
                        ->leftJoin('grades','products.book_grade','grades.id')
                        ->leftJoin('subjects','products.book_subject','subjects.id')
                        ->where('book_category',$categoryId)->where('book_grade',$gradeId)->where('book_subject',$subjectId)->first();

       return view('user.bookRead',compact('book'));
    }
    //Book View Count Function
    public function viewCount(Request $request){
        $bookId=$request->bookId;
       $viewCount=$request->viewCount;
       Product::where('id',$bookId)->update(['view_count'=>$viewCount+1]);
       return back();

    }
    //Library
    public function library(){
        return view('user.library');
    }
}

