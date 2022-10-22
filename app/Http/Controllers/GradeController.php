<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Category;

class GradeController extends Controller
{
    //Grade List Page
    public function list(){
        $grades=Grade::when(request('searchKey'),function($query){
            $searchKey=request('searchKey');
            $query->where('grade_name','like','%'.$searchKey.'%');
        })-> select('grades.*','categories.category_name')
        ->leftJoin('categories','grades.grade_category','categories.id')
        ->orderBy('grades.created_at','desc')->paginate(4);


        return view("admin.grade.gradeList",compact('grades'));
    }
    //Create Grade Page
    public function createPage(){
        $categories=Category::orderBy('created_at','desc')->get();
        return view('admin.grade.createGrade',compact('categories'));
    }
    //createGrade
    public function createGrade(Request $request){
         $this->checkGradeValidation($request);
      $data=$this->getGradeData($request);

      Grade::create($data);
      return redirect()->route('grade#list');
    }
    //Grade Edit Page
    public function editPage($id){

        $categories=Category::orderBy('created_at','desc')->get();
        $grade=Grade::where('id',$id)->first();

        return view('admin.grade.editPage',compact('grade','categories'));
    }
    //Grade Update
    public function updateGrade(Request $request){
       $this->checkGradeUpdateValidation($request);
       $updatedData=$this->getGradeUpdateData($request);
       Grade::where('id',$request->gradeId)->update($updatedData);
       return redirect()->route('grade#list')->with(['updateSuccess'=>'Grade Updated Successfully!']);
    }
    //Grade Delete
    public function deleteGrade($id){
        Grade::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Grade Deleted Successfully!']);
    }
    //Private FUnction checkCategoryValidation
    private function checkGradeValidation($request){
        Validator::make($request->all(),[

            'gradeName'=>'required',
             'gradeCategory'=>'required'
        ])->validate();
    }
    //getCategoryData
    Private function getGradeData($request){
        return [

            'grade_name'=>$request->gradeName,
              'grade_category'=>$request->gradeCategory
        ];
    }
    //checkGradeValidation
    private function checkGradeUpdateValidation($request){
        Validator::make($request->all(),[
            'gradeName'=>'required|unique:grades,grade_name,'.$request->gradeId,
            'gradeCategory'=>'required'
        ])->validate();
    }
    //getGradeUpdateData
    private function getGradeUpdateData($request){
        return [
            'grade_name'=>$request->gradeName,
            'grade_category'=>$request->gradeCategory
        ];
    }
}
