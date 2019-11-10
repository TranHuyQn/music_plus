<?php

namespace App\Http\Middleware;

use App\Model\Playlist;
use Closure;
use Illuminate\Support\Facades\Auth;

class EditPlaylistMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = Auth::user()->id;
        $playlistId = $request->id;
        $playlist = Playlist::where(['user_id' => $userId, 'id' => $playlistId])->first();
        if ($playlist != null) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
