<?php

namespace App\Http\Middleware;

use App\Model\Song;
use Closure;
use Illuminate\Support\Facades\Auth;

class EditSongMiddleware
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
        $songId = $request->id;
        $song = Song::where(['user_id' => $userId, 'id' => $songId])->first();
        if ($song != null) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
