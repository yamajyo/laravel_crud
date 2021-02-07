@extends('layouts.bbslayout')

@section('title', 'webプログラム掲示板 投稿一覧ページ')

@include('layouts.bbsheader')

@section('content')
<div class="table-responsive">
    <div class="menu">
        <p>カテゴリーメニュー</p>
        <select name="" onchange="location.href=value;">
            <option value="{{route('index')}}">全表示</option>
            @foreach ($categoryList as $value)
                <option value="{{route('index')}}?postId={{$value->id}}"><a href="">{{$value->category_name}}</a></option>
            @endforeach
        </select>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>作成日時</th>
            <th>
                <a href="{{route('index')}}?column=title&sort=asc{{(!empty($postId) ? '&postId=' . $postId : '')}}" class="sortLink">&utrif;</a>
                <a href="{{route('index')}}?column=title&sort=desc{{!empty($postId) ? '&postId=' . $postId : ''}}" class="sortLink">&dtrif;</a>
                タイトル
            </th>
            <th>内容</th>
            <th><a href="{{route('edit')}}">新規作成</a></th>
        </tr>
        </thead>
        <tbody id="tbl">
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->created_at}}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description}}</td>
                <td class="text-nowrap">
                    <form action="/delete?id={{$item->id}}" method="post">
                        @csrf
                        <p>
                            <input type="submit" class="btn btn-info btn-sm" formaction="{{route('edit')}}?id={{$item->id}}" value="編集">
                            <input type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当に削除しますか？')" name="delete" value="削除">
                        </p>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@include('layouts.bbsfooter')
