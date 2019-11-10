<div>
    <div class="row mt-5">
        <div class="col-6">
                        <span class="float-left font-weight-bold ml-5">
                            <h3>Playlist Được Nghe Nhiều</h3>
                        </span>
        </div>
    </div>
    <div class="ml-5 mr-5 mb-5">
        <div id="popular-playlist-slide" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        @foreach($popularPlaylists[0] as $playlist)
                            <div class="col-3">
                                <a href="{{route('guest.playlists.show',$playlist->id)}}"><img width="90px"
                                                                                               height="240px"
                                                                                               src="{{asset('/storage/images/playlist/'.$playlist->image)}}"
                                                                                               class="d-block w-100"
                                                                                               alt="Playlist chưa có ảnh">
                                    <p class="mb-0">{{$playlist->name}}</p></a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        @foreach($popularPlaylists[1] as $playlist)
                            <div class="col-3">
                                <a href="{{route('guest.playlists.show',$playlist->id)}}"><img width="90px"
                                                                                               height="240px"
                                                                                               src="{{asset('/storage/images/playlist/'.$playlist->image)}}"
                                                                                               class="d-block w-100"
                                                                                               alt="Playlist chưa có ảnh">
                                    <p class="mb-0">{{$playlist->name}}</p></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#popular-playlist-slide" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#popular-playlist-slide" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<!-- space -->
<div>
    <hr>
</div>
