@extends('layouts.bbslayout')

@section('title', 'webプログラム掲示板 記事投稿入力確認ページ')

@include('layouts.bbsheader')

@section('content')
        <table class="conf_table">
                <tr>
                    <th>カテゴリー</th>
                    <td>
                        @if (!empty($item['categoryNameList']))
                            @foreach ($item['categoryNameList'] as $value)
                                {{$value}}<br>
                            @endforeach
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>タイトル</th>
                    <td>{{$item['title']}}</td>
                </tr>
                <tr>
                    <th>内容</th>
                    <td>{{$item['description']}}</td>
                </tr>
                <tr>
                    <th colspan="2" class="send">
                        <form action="{{route('edit')}}{{isset($item['record_id']) ? '?id=' . $item['record_id'] : ''}}" method="post">
                            @csrf
                            @for ($i = 0; $i < count($item['categoryIdList']); $i++)
                                <input type="hidden" value="{{$item['categoryIdList'][$i]}}" name="category_num[{{$i}}]">
                            @endfor
                            <input type="hidden" value="{{$item['title']}}" name="title">
                            <input type="hidden" value="{{$item['description']}}" name="description">
                            <p><input type="submit" class="return" name="return" value="修正"></p>
                        </form>
                        <form action="{{route('done')}}{{isset($item['record_id']) ? '?id=' . $item['record_id'] : ''}}" method="post">
                            @csrf
                            @for ($i = 0; $i < count($item['categoryIdList']); $i++)
                                <input type="hidden" value="{{$item['categoryIdList'][$i]}}" name="category_num[{{$i}}]">
                            @endfor
                            <input type="hidden" value="{{$item['title']}}" name="title">
                            <input type="hidden" value="{{$item['description']}}" name="description">
                            <p><input type="submit" class="conf_proceed" value="登録完了"></p>
                        </form>
                    </th>
                </tr>
        </table>
@endsection

@include('layouts.bbsfooter')