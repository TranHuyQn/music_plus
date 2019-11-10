@extends('layouts.masterSideBar')
@section('style')
    <link rel="stylesheet" href="{{asset('css/token-input.css')}}">
    <link rel="stylesheet" href="{{asset('css/token-input-facebook.css')}}">
@endsection
@section('content')
    @error('songIds')
    <div style="width: 50%; margin-left: 25%" class="alert alert-danger">{{ $message }}</div>
    @enderror
    @if (Session::has('success'))
        <p class="alert alert-success">{{Session::get('success')}}</p>
    @endif
    <table border="1" class="table table-bordered text-center" style="width: 100%; ">
        <thead class="thead-light">
        <tr>
            <th colspan="3" style="text-align: center">{{strtoupper($playlist->name)}}</th>
            <th colspan="2" style="text-align: center"><a
                    href="{{ route('playlists.playAll', $playlist->id) }}">{{'Nghe tất cả  '}}<i
                        class="fa fa-play-circle"></i></a></th>
        </tr>
        <tr>
            <td>STT</td>
            <td>TÊN BÀI HÁT</td>
            <td>TÊN CA SĨ</td>
            <td>TÊN NHẠC SĨ</td>
            @if(Auth::user())
                <td>CHỈNH SỬA</td>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($playlist->songs as $song)
            <tr>
                <td>{{$STT++}}</td>
                <td style="text-align: left"><a href="{{route('songs.play', $song->id)}}"
                                                style="color: black;">{{$song->name}}</a></td>
                <td> @foreach($song->singers as $singer)  {{$singer->name.""}}<br>@endforeach</td>
                <td> @foreach($song->artists as $artist)  {{$artist->name.""}}<br>@endforeach</td>
                @if(Auth::user())
                    <td>
                        <a class="btn btn-danger" href="{{ route('playlists.destroy', ['playlistId' => $playlist->id, 'songId' => $song->id]) }}"
                           onclick="return confirm('Bạn chắc chắn muốn xóa?')"><i
                                class="fa fa-trash"></i></a></td>
                @endif
            </tr>
        @endforeach
        @if(Auth::user())
            <tr>
                <td colspan="5">
                    <span id="show-form" style="cursor: pointer">Thêm bài hát</span>
                </td>
            </tr>
        @endif
        </tbody>
    </table>
    <div id="form" style="display: none">
        <form action="{{route('playlists.addSong', $playlist->id)}}" method="post">
            @csrf
            <input type="text" name="songIds" id="list_song">
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/jquery.tokeninput.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#show-form').click(function () {
                $('#form').show();
            });

            $("#list_song").tokenInput("{{asset('api/songs?q=song')}}", {
                hintText: 'Nhập tên bài hát',
                noResultsText: "Không tìm thấy bài hát. ",
                searchingText: 'Đang tìm kiếm...',
                theme: 'facebook',
                preventDuplicates: true,
                prePopulate: '',
            });
        });
    </script>
@endsection
