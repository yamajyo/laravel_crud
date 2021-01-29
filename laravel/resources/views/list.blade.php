@extends('top')

@section('site')
        <table class="site_list" border="1">
            <tr>
                <th>ID</th>
                <th>サイト名</th>
                <th>画像</th>
                <th>登録日時</th>
                <th>更新日時</th>
                <th><button onclick="location.href='edit'">新規作成</button></th>
            </tr>
            @foreach($items as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td><img src="img/{{$item->img}}" alt=""></td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        <button onclick="location.href='/edit?id={{$item->id}}'">編集</button>
                        <button onclick="location.href='/delete?id={{$item->id}}'">削除</button>
                    </td>
                </tr>
            @endforeach
        </table>
@endsection