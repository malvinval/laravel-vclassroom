<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassroomRegistrar;
use App\Models\Forum;
use App\Models\ForumComment;
use App\Models\ForumTeacherFileAttachment;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view("home"); 
    }
    
    public function classrooms() {
        
        $classrooms = ClassroomRegistrar::search(request("search"))->where("registrar_id", auth()->user()->id)->get();

    
        return view("classrooms", compact("classrooms"));
    }

    public function classroom(Classroom $classroom) {
        
        // user validation

        $validateRegistrar = ClassroomRegistrar::where("access_code", $classroom->access_code)->where("registrar_id", auth()->user()->id)->count();
        // $validateCreator = Classroom::where("access_code", $classroom->access_code)->where("creator_id", auth()->user()->id)->count();
        
        if($validateRegistrar == 0) {
            abort(403);
        }
        
        // show forums data

        $forums = Forum::where("classroom_access_code", $classroom->access_code)->latest()->get();

        // show forum teacher file attachment data

        $files = ForumTeacherFileAttachment::all();

        return view("classroom", [
            "classroomName" => $classroom->name,
            "classroomDescription" => $classroom->description,
            "forums" => $forums,
            "files" => $files
        ]);
    }

    public function test() {
        return view('classroom.join');
    }

    public function reply($id) {
        
        $comment = ForumComment::find($id);
        // dd($comment);
        
        return view('reply.create', [
            "comment" => $comment,
            // "specified_forum" => $specified_forum
        ]);
    }
}
