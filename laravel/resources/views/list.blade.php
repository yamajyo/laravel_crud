@extends('top')

@section('site')
        <table class="site_list" border="1">
            <tr>
                <th>サイトid</th>
                <th>サイト名</th>
                <th>サイトurl</th>
                <th><button onclick="location.href='edit'">新規作成</button></th>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->url}}</td>
                        <td>
                            <button onclick="location.href='/edit?id={{$item->id}}'">編集</button>
                            <button>削除</button>
                        </td>
                    </tr>
                @endforeach
            </tr>
        </table>
@endsection