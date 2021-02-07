@extends('layouts.bbslayout')

@section('title', 'webプログラム掲示板 記事投稿入力ページ')

@include('layouts.bbsheader')

@section('content')
    <form action="{{route('conf')}}{{isset($item['record_id']) ? '?id=' . $item['record_id'] : ''}}" method="post">
        @csrf
        <table class="edit_form" border="1">
            <tr>
                <th>カテゴリー:</th>
                <td>
                    @for ($i = 0; $i < 5; $i++)
                        <select name="category[]" class="site_category_list">
                            <option value="">------</option>
                            @foreach ($categoryList as $value)
                                <option value="{{$value->id}}" {{isset($item['category_num'][$i]) && $item['category_num'][$i] == $value->id ? 'selected' : ''}}>{{$value->category_name}}</option>
                            @endforeach
                        </select>
                    @endfor
                </td>
            </tr>
            <tr>
                <th>タイトル:</th>
                <td><input type="text" name="title" value="{{isset($item['title']) ? $item['title'] : ''}}"></td>
            </tr>
            <tr>
            <tr>
                <th>内容:</th>
                <td>
                    <textarea name="description" id="" cols="30" rows="10" value="{{isset($item['description']) ? $item['description'] : ''}}">{{isset($item['description']) ? $item['description'] : ''}}</textarea>
                </td>
            </tr>
        </table>
        <p><input type="submit" value="確認画面へ" class="proceed"></p>
    </form>
@endsection

@include('layouts.bbsfooter')