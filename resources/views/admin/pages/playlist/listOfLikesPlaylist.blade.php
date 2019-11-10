<div>
    <div class="row mt-5">
        <div class="col-6">
                        <span class="float-left font-weight-bold ml-5">
                            <h3>Playlist Được Yêu Thích Nhất</h3>
                        </span>
        </div>
    </div>
    <div class="ml-5 mr-5 mb-5">
        <div id="like-playlist-slide" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        @for($i = 0; $i < 4; $i++)
                            <div class="col">
                                <a href="{{route('guest.playlists.show',$favoritePlaylists[$i]->id)}}"><img width="90px" height="240px"
                                    src="{{asset('/storage/images/playlist/'.$favoritePlaylists[$i]->image)}}"
                                    class="d-block w-100" alt="Playlist chưa có ảnh">
                                <p class="mb-0">{{$favoritePlaylists[$i]->name}}</p></a>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        @for($i = 4; $i < 8; $i++)
                            <div class="col">
                                <a href="{{route('guest.playlists.show',$favoritePlaylists[$i]->id)}}"><img width="90px" height="240px"
                                    src="{{asset('/storage/images/playlist/'.$favoritePlaylists[$i]->image)}}"
                                    class="d-block w-100" alt="Playlist chưa có ảnh">
                                <p class="mb-0">{{$favoritePlaylists[$i]->name}}</p></a>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#like-playlist-slide" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#like-playlist-slide" role="button" data-slide="next">
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
