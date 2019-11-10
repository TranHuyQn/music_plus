<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormAddPlaylist;
use App\Http\Requests\FormPlaylist;
use App\Model\Comment;
use App\Model\CommentList;
use App\Model\Playlist;
use App\Model\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PlaylistController extends Controller
{

    public function index()
    {
        $STT = 1;
        $songs = Song::all();
        $userId = Auth::user()->id;
        $playlists = Playlist::where('user_id', $userId)->get();
        return view('manager.playlists.list', compact('playlists', 'STT', 'songs'));
    }

    public function show($playlistId)
    {
        $STT = 1;
        $songs = Song::all();
        $playlist = Playlist::find($playlistId);
        return view('manager.playlists.show', compact('playlist', 'STT', 'songs'));
    }

    public function guestShow($playlistId)
    {
        $STT = 1;
        $songs = Song::all();
        $playlist = Playlist::find($playlistId);
        return view('admin.pages.playlist.show', compact('playlist', 'STT', 'songs'));
    }


    public function playAll($playlistId)
    {
        $playlistKey = 'song_' . $playlistId;
        if (!Session::has($playlistKey)) {
            Playlist::where('id', $playlistId)->increment('listen_count');
            Session::put($playlistKey, 1);
        }
        $STT = 1;
        $songs = Song::all()->sortByDesc('created_at')->take(5);
        $user = Auth::user();
        $playlist = Playlist::find($playlistId);
        return view('playlists.playAll', compact('playlist', 'songs', 'STT', 'user'));
    }


    public function showHotPlaylist($id)
    {
        $STT = 1;
        $hotPlaylists = Playlist::all()->sortByDesc('create_at')->take(5);
        $hotPlaylist = Playlist::findOrFail($id);
        return view('manager.playlists.hot-playlist', compact('STT', 'hotPlaylists', 'hotPlaylist'));

    }

    public function showListPlaylist()
    {
        $STT = 1;
        $songs = Song::all();
        $userId = Auth::user()->id;
        $playlists = Playlist::where('user_id', $userId)->get();
        return view('manager.playlists.list', compact('playlists', 'STT', 'songs'));

    }


    public function store(FormPlaylist $request)
    {
        $user = Auth::user();
        $playlist = new Playlist();
        if ($request->hasFile('image')) {
            $imageName = 'playlist' . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('images/playlist', $imageName);
            $playlist->image = $imageName;
            $playlist->name = $request->name;
            $playlist->user_id = $user->id;
            $playlist->save();
            return redirect()->back()->with('success', 'Tạo mới playlist thành công.');
        }
    }

    public function destroy($playlistId, $songId)
    {
        $playlist = Playlist::find($playlistId);
        $playlist->songs()->detach($songId);
        return redirect()->route('playlists.show', $playlist->id);
    }

    public function destroyAll($id)
    {
        $playlist = Playlist::find($id);
        $playlist->delete();
        return redirect()->back();
    }


    public function countPlaylist()
    {
        $playlist = Playlist::all();
        $countByName = $playlist->count($playlist->name);
        return view('manager.playlists.hot-playlist', compact('playlist', 'countByName'));
    }

    public function searchByName(Request $request)
    {
        $STT = 1;
        $playlists = Playlist::where('name', 'LIKE', '%' . $request->keySearch . '%')->get();
        return view('manager.playlists.search', compact('playlists', 'STT'));

    }


    public function update(FormPlaylist $request, $id)
    {
        $playlist = Playlist::find($id);
        $playlist->name = $request->name;
        $playlist->save();
        return redirect()->back()->with('success', 'Cập nhật playlist thành công.');
    }

    public function addSong(FormAddPlaylist $request, $id)
    {
        $songIds = explode(',', $request->songIds);
        $playlist = Playlist::find($id);
        foreach ($songIds as $songId) {
            $playlist->songs()->attach($songId);
        }
        return redirect()->back()->with('success','Thêm bài hát thành công.');
    }

    public function guestIndex()
    {
        $STT = 1;
        $songs = Song::all();
        $playlists = Playlist::all();
        return view('playlists.index', compact('playlists', 'STT', 'songs'));
    }
}
