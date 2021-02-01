@extends('top')

@php

@endphp
@section('site')
        <table class="conf_table">
                <tr>
                    <th>サイトカテゴリー</th>
                    <td>
                        @if (!empty($item['siteCategoryNameList']))
                            @foreach ($item['siteCategoryNameList'] as $value)
                                {{$value}}<br>
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
                <tr>
                    <th colspan="2" class="send">
                        <form action="/edit{{isset($item['record_id']) ? '?id=' . $item['record_id'] : ''}}" method="post">
                            @csrf
                            @for ($i = 0; $i < count($item['siteCategoryIdList']); $i++)
                                <input type="hidden" value="{{$item['siteCategoryIdList'][$i]}}" name="site_category_num[{{$i}}]">
                            @endfor
                            <input type="hidden" value="{{$item['name']}}" name="name">
                            <input type="hidden" value="{{$item['url']}}" name="url">
                            <input type="hidden" value="{{$item['img']}}" name="img">
                            <input type="hidden" value="{{$item['description']}}" name="description">
                            <input type="hidden" value="{{$item['turn']}}" name="turn">
                            <p><input type="submit" class="return" value="修正"></p>
                        </form>
                        <form action="/done{{isset($item['record_id']) ? '?id=' . $item['record_id'] : ''}}" method="post">
                            @csrf
                            @for ($i = 0; $i < count($item['siteCategoryIdList']); $i++)
                                <input type="hidden" value="{{$item['siteCategoryIdList'][$i]}}" name="site_category_num[{{$i}}]">
                            @endfor
                            <input type="hidden" value="{{$item['name']}}" name="name">
                            <input type="hidden" value="{{$item['url']}}" name="url">
                            <input type="hidden" value="{{$item['img']}}" name="img">
                            <input type="hidden" value="{{$item['description']}}" name="description">
                            <input type="hidden" value="{{$item['turn']}}" name="turn">
                            <p><input type="submit" class="conf_proceed" value="登録完了"></p>
                        </form>
                    </th>
                </tr>
        </table>
@endsection