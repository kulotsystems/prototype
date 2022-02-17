<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Models\Group;

use App\Models\File;

use App\Models\Room;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function displayStudentDashboard() {
        //$groups   = Group::all();
        // $files = File::all();
        $groups = Auth::user()->groups;
        $files    = Auth::user()->files;
        return view('/dashboard', compact('groups', 'files'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function searchRoom(Request $request) {
        $term = $request->input('search_room');
        $filterData = Room::where('rname','LIKE','%'.$term.'%')
            ->get();
        return view('student.classroom', compact('filterData'));
    }

    public function joinRoom(Request $request) {

        $enroll = new enroll;

        $key = $request->input('mykey');
        $findKey = Room::where('rkey','LIKE','%'.$key.'%')
            ->get();

        if($findKey == true){
            //$rooms = Auth::user()->rooms;
            $enroll->room_id = $findKey->id;
            $enroll->user_id = $request->input('user_id');
            $enroll->save();
            dd($enroll->room_id);
//            return back()
//                ->with('success','You Successfully Join.');
        }

    }
}
