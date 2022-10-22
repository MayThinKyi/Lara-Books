<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Category;
use Storage;
class ProductController extends Controller
{
    //Product List (Book List) Page
    public function list(){
        $products=Product::when(request('searchKey'),function($query){
            $searchKey=request('searchKey');
            $query->where('book_name','like','%'.$searchKey.'%');
        })->select('products.*','categories.category_name as book_category','grades.grade_name as book_grade','subjects.subject_name as book_subject')
                ->leftJoin('categories','products.book_category','categories.id')
                ->leftJoin('grades','products.book_grade','grades.id')
                ->leftJoin('subjects','products.book_subject','subjects.id')
                ->orderBy('created_at','desc')->paginate(4);
        return view('admin.product.list',compact('products'));
    }
    //Product Create Page
    public function createPage(){
        $categories=Category::orderBy('created_at','desc')->get();
        $grades=Grade::orderBy('created_at','desc')->orderBy('created_at','desc')->get();
        $subjects=Subject::select('subjects.*','grades.grade_name')
                        ->leftJoin('grades','subjects.subject_grade','grades.id')
                        ->orderBy('created_at','desc')->get();
        return view('admin.product.createPage',compact('categories','grades','subjects'));
    }
    //Product Create Page
    public function createBook(Request $request){
         $this->checkBookCreateValidationCheck($request);
                $imgFileName=uniqid().$request->file('bookImage')->getClientOriginalName();
            $pdfFileName=uniqid().$request->file('bookPdf')->getClientOriginalName();
              $request->file('bookImage')->storeAs('public',$imgFileName);
                $request->file('bookPdf')->storeAs('public',$pdfFileName);
            $bookData=$this->getBookData($request);
             if($request->bookDescription!=null){
                $bookData['book_description']=$request->bookDescription;
             }
               $bookData['book_image']=$imgFileName;
               $bookData['book_pdf']=$pdfFileName;
               $bookData['view_count']=0;
               Product::create($bookData);
               return redirect()->route('product#list');


    }
    //Book Delete
    public function deleteBook($id){
        $toDeletePdfFile=Product::select('book_pdf')->where('id',$id)->first()->toArray()['book_pdf'];
        storage::delete('public/'.$toDeletePdfFile);
        Product::where('id',$id)->delete();

        return redirect()->route('product#list');
    }
    //getBookData
    private function getBookData($request){
        return [
            'book_name'=>$request->bookName,

            'book_category'=>$request->bookCategory,
             'book_grade'=>$request->bookGrade,
              'book_subject'=>$request->bookSubject
        ];
    }
    //checkBookCreateValidationCheck
    private function checkBookCreateValidationCheck($request){
        Validator::make($request->all(),[
            'bookName'=>'required',
            'bookCategory'=>'required',
            'bookGrade'=>'required',
            'bookSubject'=>'required',

            'bookImage'=>'required|mimes:jpeg,jpg,png,gif,tiff,psd,pdf,eps,ai,indd,raw',
            'bookPdf'=>'required|mimes:pdf',
        ])->validate();
    }
}
