@extends('layouts.masterSideBar')
@section('style')
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/icon.min.css" rel="stylesheet">
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>
    <link rel="stylesheet" href="{{asset('css/player.css')}}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection
@section('content')
    @include('includes.facebookSDK')
    <div class="col-md-12">
        <audio class="audio" preload="none"></audio>
        <div class="player paused">
            <div id="project-container">
                <div id="overlay"></div>
                <div id="content">
                    <h2 class="title"></h2>
                    <h3></h3>
                    <div class="time">
                        <span class="current-time">0:00</span>/
                        <span class="duration">0:00</span>
                    </div>
                    <div class="process">
                        <input class="process-bar" type="range" step="0.1" min="0">
                    </div>
                    <div id="controls">
                        <div class="button loop-btn"><i class="fa fa-refresh" aria-hidden="true"></i></div>
                        <div class="button prev-btn"><i class="fa fa-step-backward" aria-hidden="true"></i>
                        </div>
                        <div class="button"><i class="fa fa-play play-btn fa-fw" aria-hidden="true"></i>
                        </div>
                        <div class="button next-btn"><i class="fa fa-step-forward" aria-hidden="true"></i>
                        </div>
                        <div class="button random-btn"><i class="fa fa-random" aria-hidden="true"></i></div>
                        <div class="button"><i class="fa fa-volume-up mute-btn" aria-hidden="true"></i>
                        </div>
                        <div class="button"><input class="volume-bar" type="range" step="0.1" min="0"
                                                   max="1"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="social-plugin col-md-12">
            <div>
                <div class="row">
                    <div class="col-md-2">
                        @include('includes.like', ['like_item' => 'playlist-'.$playlist->id])
                    </div>
                    <div class="col-md-2">
                        <span><i class="headphone icon"></i>{{$playlist->listen_count}}</span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div id="plwrap">
            <ul id="plList"></ul>
        </div>
        <hr>
    </div>
    <div class="col-md-12 comment-facebook">
        @include('includes.commentfb', ['commentItem'=> 'playlist-'.$playlist->id])
    </div>
@endsection
@section('script')
    <script>
        var tracks = <?php echo $playlist->songs ?>;
        console.log(tracks)
    </script>
    <script src="{{ asset('js/player.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
@endsection
