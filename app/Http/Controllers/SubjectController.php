<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Category;
use Storage;
class SubjectController extends Controller
{
    //List page
    public function list(){
        $subjects=Subject::when(request('searchKey'),function($query){
            $searchKey=request('searchKey');
            $query->where('subject_name','like','%'.$searchKey.'%');
        })->orderBy('created_at','desc')->paginate(4);
        return view('admin.subject.list',compact('subjects'));
    }
    //Create PAge
    public function createPage(){
        $grades=Grade::orderBy('created_at','desc')->get();
        $categories=Category::orderBy('created_at','desc')->get();
        return view('admin.subject.createPage',compact('grades','categories'));
    }
    //Create Subject
    public function createSubject(Request $request){
       $this->createSubjectValidationCheck($request);
       $subjectData=$this->getSubjectData($request);
       $fileName=uniqid().$request->file('subjectImage')->getClientOriginalName();
        $request->file('subjectImage')->storeAs('public',$fileName);
        $subjectData['subject_image']=$fileName;
        Subject::create($subjectData);
        return redirect()->route('subject#list');
    }
    //Subject Edit Page
    public function editPage($id){
        $subject=Subject::where('id',$id)->first();
       $grades=Grade::orderBy('created_at','desc')->get();
        $categories=Category::orderBy('created_at','desc')->get();
        return view('admin.subject.editPage',compact('subject','categories','grades'));
    }
    //Subject Update Page
    public function updateSubject(Request $request){

      $this->checkUpdateSubjectValidationCheck($request);
      $updatedSubjectData=$this->getSubjectData($request);
       if($request->hasFile('subjectImage')){
        $oldFileName=Subject::select('subject_image')->where('id',$request->subjectId)->get()->toArray();
        $oldFileName=$oldFileName[0]['subject_image'];
        $fileName=uniqid().$request->file('subjectImage')->getClientOriginalName();
        $request->file('subjectImage')->storeAs('public',$fileName);
        $updatedSubjectData['subject_image']=$fileName;
        Storage::delete('public/'.$oldFileName);
    }
      Subject::where('id',$request->subjectId)->update($updatedSubjectData);
      return redirect()->route('subject#list')->with(['updateSuccess'=>'Subject Updated Successfully!']);
    }
    //Subject Delete
    public function delete($id){
        Subject::where('id',$id)->delete();
        return redirect()->route('subject#list')->with(['deleteSuccess'=>'Subject Deleted Successfully!']);
    }
    /*
    //updateSubjectData
    private function updateSubjectData($request){
        return [
            'subject_name'=>$request->subjectName,
            'subject_category'=>$request->subjectCategory,
            'subject_grade'=>$request->subjectGrade
        ];
    }
    */
    //checkUpdateSubjectValidationCheck
    private function checkUpdateSubjectValidationCheck($request){
        Validator::make($request->all(),[
            'subjectName'=>'required',
            'subjectCategory'=>'required',
            'subjectGrade'=>'required'
        ])->validate();
    }

    //createSubjectValidationCheck
    private function createSubjectValidationCheck($request){
        Validator::make($request->all(),[
            'subjectName'=>'required',
            'subjectImage'=>'required',
            'subjectCategory'=>'required',
            'subjectGrade'=>'required'
        ])->validate();
    }
    //getSubjectData
    private function getSubjectData($request){
        return [
            'subject_name'=>$request->subjectName,
            'subject_category'=>$request->subjectCategory,
            'subject_grade'=>$request->subjectGrade
        ];
    }
}
