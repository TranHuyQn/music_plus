@extends ('layouts.app')
@section('content')
    <div style="width: 30%; margin-left: 35%;: ">
        <table border="1" class="table table-bordered text-center">
            <thead class="thead-light">
            <tr>
                <th colspan="2" style="text-align: center">DANH SÁCH CA SĨ</th>
            </tr>
            <tr>
                <td>STT</td>
                <td>TÊN CA SĨ</td>
            </tr>
            </thead>
            <tbody>
            @foreach($singers as $key => $singer)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><a href="{{route('singers.show', $singer->id)}}">{{$singer->name}}</a>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a class="btn btn-group bg-primary" href="{{route('singers.create')}}">THÊM CA SĨ</a>
    </div>
@endsection
