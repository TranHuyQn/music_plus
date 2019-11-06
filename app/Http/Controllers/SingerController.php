<?php

namespace App\Http\Controllers;

use App\Http\Requests\SingerValidate;
use App\Model\Singer;
use App\Model\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SingerController extends Controller
{
    public function index()
    {
        $singers = Singer::all()->sortByDesc('created_ad')->take(5);
        return view('singers.index', compact('singers'));
    }

    public function create()
    {
        return view('manager.singers.create');
    }

    public function store(SingerValidate $request)
    {
        if($request->dob >= now('Asia/Ho_Chi_Minh')) {
            return redirect()->back()->with('errorDob','Ngày sinh của ca sĩ không hợp lệ');
        }
        $singer = new Singer();
        $imageName = $singer->id.'singer'.time().'.'.request()->image->getClientOriginalExtension();
        $request->image->storeAs('singer_image',$imageName);
        $singer->image = $imageName;
        $singer->name = $request->name;
        $singer->dob = $request->dob;
        $singer->story = $request->story;
        $singer->save();
        return redirect()->route('singers.create')->with('success','Thêm mới ca sĩ thành công');

    }

    public function show($id)
    {
        $singer = Singer::findOrFail($id);
        return view('manager.singers.show', compact('singer','songs','STT'));

    }

    public function edit($id)
    {
        $singer =  Singer::findOrfail($id);
        return view('manager.singers.edit', compact('singer'));
    }


    public function update(SingerValidate $request, $id)
    {
        $singer = Singer::findOrFail($id);
        $singer->name = $request->name;
        $singer->dob = $request->dob;
        $singer->story = $request->story;
        $singer->save();
        return redirect()->back();
    }

    public function destroy($id)
    {

    }


}
