<?php

namespace App\Http\Controllers;

use App\Models\Group;

use App\Models\File;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    public function membersCreate(Request $request) {

        $memdata = new group;
        $memdata->user_id = $request->input('user_id');
        $memdata->group_name = $request->input('gname');
        $memdata->member1 = $request->input('member1');
        $memdata->member2 = $request->input('member2');
        $memdata->member3 = $request->input('member3');
        $memdata->member4 = $request->input('member4');
        $memdata->section = $request->input('yearnsection');
        $memdata->save();

        return redirect()->back()->with('status', 'Group Member Added Successfully');
    }

    public function fileUpload(Request $req) {

        $req->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
        ]);
        $fileModel = new File;
        $fileModel->user_id = $req->input('user_id');
        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();
            return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
        }
    }

    public function displayStudentDashboard() {
        $groups = Group::all();
        $files = File::all();
        return view('/dashboard', compact('groups', 'files'));
    }
}