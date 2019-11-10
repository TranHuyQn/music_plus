<div class="col-6 border-right">
    <div class="font-weight-bold ml-5 mb-3">
        <h3>Bài Hát Được Yêu Thích Nhất</h3>
    </div>
    <div class="ml-4">
        @foreach($favoriteSongs as $key => $song)
            <div class="ml-5 mb-3">
                <div class="row">
                    <div class="col-1">
                        <img src="{{asset('/storage/public/upload/images/'.$song->image)}}"
                             style="width: 50px; height: 50px" href="">
                    </div>
                    <div class="col-11">
                        <div class="ml-3">
                            <div><a href="{{route('songs.play', $song->id)}}"></strong>{{$song->name}}</a></div>
                            <div>      @foreach($song->singers as $singer)
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
