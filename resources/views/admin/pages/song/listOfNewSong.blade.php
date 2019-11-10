<div class="col-6 border-right">
    <div class="font-weight-bold ml-5 mb-3">
        <h3>Bài Hát Mới Nhất</h3>
    </div>
    <div class="ml-4">
        @foreach($newSongs as $key => $newSong)
            <div class="ml-5 mb-3">
                <div class="row">
                    <div class="col-1">
                        <img src="{{asset('/storage/public/upload/images/'.$newSong->image)}}"
                             style="width: 50px; height: 50px" href="">
                    </div>
                    <div class="col-11">
                        <div class="ml-3">
                            <div><a href="{{route('songs.play', $newSong->id)}}"></strong>{{$newSong->name}}</a></div>
                            <div>      @foreach($newSong->singers as $singer)
                                    <div>{{$singer->name}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


