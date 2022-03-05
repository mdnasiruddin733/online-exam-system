<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $departments=Department::latest()->get();
        return view("admin.departments.index",compact('departments'));
    }

    public function create(){
        return view("admin.departments.create");
    }

    public function store(Request $req){
        $this->validate($req,[
            "name"=>"required|string|max:24",
            "image"=>"nullable|image|max:2048"
        ]);
        $department=new Department();
        $department->name=$req->name;
        if($req->image){
            $department->image=upload($req->image,"departments");
        }else{
            $department->image="img/department.png";
        }
        $department->save();
        return redirect(route("admin.department.index"))->with([
          "type"=>"success",
          "message"=>"Department created successfully"
      ]);
    }

    public function edit($id){
        $department=Department::findOrFail($id);
        return view("admin.departments.edit",compact('department'));
    }

    public function update(Request $req){
        $this->validate($req,[
            "id"=>"required|exists:departments,id",
            "name"=>"required|string|max:24",
            "image"=>"nullable|image|max:2048"
        ]);
        $department=Department::findOrFail($req->id);
        
        if($req->image){
            if($department->image!=="img/department.png"){
                 $department->image=upload($req->image,"departments",$department->image);
            }else{
                $department->image=upload($req->image,"departments");
            }
           
        }
       
        $department->save();
        return redirect(route("admin.department.index"))->with([
          "type"=>"success",
          "message"=>"Department updated successfully"
      ]);

    }

    public function delete($id){
        $department=Department::findOrFail($id);
        if($department->image!=="img/department.png" && file_exists($department->image)){
            unlink($department->image);
        }
        $department->delete();
        return redirect(route("admin.department.index"))->with([
          "type"=>"success",
          "message"=>"Department deleted successfully"
      ]);
    }
}
