@extends('top')

@php

@endphp
@section('site')
        <table class="site_list" border="1">
                <tr>
                    <th>サイトカテゴリー</th>
                    <td>
                        @if (!empty($item['site']))
                            @foreach ($item['site'] as $value)
                                {{$value}}
                            @endforeach
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>サイト名</th>
                    <td>{{$item['name']}}</td>
                </tr>
                <tr>
                    <th>サイトurl</th>
                    <td>{{$item['url']}}</td>
                </tr>
                <tr>
                    <th>サイト画像名</th>
                    <td>{{$item['img']}}</td>
                </tr>
                <tr>
                    <th>サイト説明</th>
                    <td>{{$item['description']}}</td>
                </tr>
                <tr>
                    <th>表示順</th>
                    <td>{{$item['turn']}}</td>
                </tr>
        </table>
        <form action="/edit" method="post">
            @csrf
            @for ($i = 0; $i < count($item['s']); $i++)
                <input type="hidden" value="{{$item['s'][$i]}}" name="site_category_num[{{$i}}]">
            @endfor
            <input type="hidden" value="{{$item['name']}}" name="name">
            <input type="hidden" value="{{$item['url']}}" name="url">
            <input type="hidden" value="{{$item['img']}}" name="img">
            <input type="hidden" value="{{$item['description']}}" name="description">
            <input type="hidden" value="{{$item['turn']}}" name="turn">
            <p><input type="submit" value="修正"></p>
        </form>
        <form action="/done" method="post">
            @csrf
            @for ($i = 0; $i < count($item['s']); $i++)
                <input type="hidden" value="{{$item['s'][$i]}}" name="site_category_num[{{$i}}]">
            @endfor
            <input type="hidden" value="{{$item['name']}}" name="name">
            <input type="hidden" value="{{$item['url']}}" name="url">
            <input type="hidden" value="{{$item['img']}}" name="img">
            <input type="hidden" value="{{$item['description']}}" name="description">
            <input type="hidden" value="{{$item['turn']}}" name="turn">
            <p><input type="submit" value="登録完了"></p>
        </form>
@endsection