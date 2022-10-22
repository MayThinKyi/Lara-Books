<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Storage;
class CategoryController extends Controller
{
    //Category List Page
    public function list(){
        $categories=Category::when(request('searchKey'),function($query){
            $searchKey=request('searchKey');
            $query->where('category_name','like','%'.$searchKey.'%');
        })->orderBy('created_at','desc')->paginate(4);
        return view('admin.categoryList',compact('categories'));
    }
    //Creae Category Page
    public function createCategoryPage(){
        return view('admin.categoryCreatePage');
    }
    //Create Category
    public function createCategory(Request $request){
       
      $this->checkCategoryValidation($request);
      $data=$this->getCategoryData($request);
     
      Category::create($data);
      return redirect()->route('category#list');
    }
    //Private FUnction checkCategoryValidation
    private function checkCategoryValidation($request){
        Validator::make($request->all(),[
           
            'categoryName'=>'required'
        ])->validate();
    }
    //getCategoryData
    Private function getCategoryData($request){
        return [
           
            'category_name'=>$request->categoryName
        ];
    }
    //Edit Category Page
    public function editCategoryPage($id){
       
      $category=Category::where('id',$id)->first();
     
        
        return view('admin.editCategoryPage',compact('category'));
    }
    //Update Category
    public function updateCategory(Request $request){
    
       $this->updateCategoryValidation($request);
       $data=$this->getCategoryData($request);
      
       Category::where('id',$request->categoryId)->update($data);
       return redirect()->route('category#list')->with(['updateSuccess'=>'Category Updated Successfully!']);
    }
    //updateCategoryValidation Function
    private function updateCategoryValidation($request){
        Validator::make($request->all(),[
        'categoryName'=>'required|unique:categories,category_name,'.$request->categoryId
])->validate();
    }
    //deleteCategory
    public function deleteCategory($id){
        Category::where('id',$id)->delete();
       return redirect()->route('category#list')->with(['deleteSuccess'=>'Category Deleted Successfully!']);
    }

}
