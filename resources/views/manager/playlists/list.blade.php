@extends ('layouts.masterSideBar')
@section('content')
    <div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @if (Session::has('success'))
            <p class="alert alert-success">{{Session::get('success')}}</p>
        @endif
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th colspan="3" style="text-align: center">DANH SÁCH PLAYLIST
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                            data-target="#addNewPlaylist">
                        THÊM MỚI PLAYLIST
                    </button>
                </th>
            </tr>
            <tr>
                <td>STT</td>
                <td>TÊN PLAYLIST</td>
                <td>CHỈNH SỬA</td>
            </tr>
            </thead>
            <tbody>
            @foreach($playlists as $key => $playlist)
                <tr class="p-2">
                    <td>{{$STT++}}</td>
                    <td style="text-align: left"><a
                            href="{{ route('playlists.show', $playlist->id) }}">{{$playlist->name}}</a>
                    </td>
                    <td><span title="sửa" style="cursor: pointer" data-toggle="modal"
                              data-target="#updatePlaylist{{$playlist->id}}"><i
                                class="fa fa-edit"></i></span>&emsp;
                        <a title="xóa" href="{{ route('playlist.destroyAll', $playlist->id) }}"
                           onclick="return confirm('ban chac chan xoa?')"><i
                                class="fa fa-trash"></i></a></td>
                </tr>
                <!-- Modal Update Playlist-->
                <div class="modal fade" id="updatePlaylist{{$playlist->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">CẬP NHẬT PLAYLIST</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('playlists.update', $playlist->id)}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    Tên Playlist:
                                    <input type="text" class="form-control" name="name"
                                           value="{{$playlist->name}}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Hủy
                                    </button>
                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal Create Playlist-->
    <div class="modal fade" id="addNewPlaylist" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">THÊM MỚI PLAYLIST</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('playlists.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        Tên Playlist:
                        <input type="text" class="form-control" name="name">
                        Ảnh Playlist:
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
