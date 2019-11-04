@extends('pages.index')
@section('content')
    <div  class="container pt-5">
        <div class="row">
            <div class="col-md-9">
                @if (Auth::guest())
                    @else
                    <a class="btn btn-primary" href="{{ route('songs.create') }}">Tải lên</a>
                @endif
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th colspan="7" style="text-align: center">DANH SÁCH BÀI HÁT</th>
                    </tr>
                    </thead>
                </table>
                <table class="table">
                    <tbody>
                    @foreach($songs as $song)
                        <tr>
                            <td><img height="50" width="50" src="{{asset('/storage/public/upload/images/'.$song->image)}}"></td>
                            <td style="text-align: left"><a href="{{route('songs.play', $song->id)}}" style="color: black;">{{$song->name}}</a></td>
                            <td> @foreach($song->singers as $singer)  {{$singer->name.""}}<br>@endforeach</td>
                            <td> @foreach($song->artists as $artist)  {{$artist->name.""}}<br>@endforeach</td>
                            <td>
                                <a  type="button" class="btn btn-primary" href="{{ route('songs.edit', $song->id) }}">Sửa</a>
                                    <a  type="button" class="btn btn-primary" href="{{route('songs.destroy', $song->id)}}"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa')">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('pages.newsong')
        </div>
        <div class="row">
            @include('pages.album')
            @include('pages.topic')
        </div>
        <div class="row">
            @include('pages.mv')
            @include('pages.media')
        </div>
    </div>
@endsection