@extends('top')

@section('site')
    <form action="/conf{{isset($item['record_id']) ? '?id=' . $item['record_id'] : ''}}" method="post">
        @csrf
        <table class="edit_form" border="1">
            <tr>
                <th>サイトカテゴリー:</th>
                <td>
                    @for ($i = 0; $i < 5; $i++)
                        <select name="site_category[]" class="site_category_list">
                            <option value="">------</option>
                            @foreach ($site_category_list as $value)
                                <option value="{{$value->id}}" {{isset($item['site_category_num'][$i]) && $item['site_category_num'][$i] == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                            @endforeach
                        </select>
                    @endfor
                </td>
            </tr>
            <tr>
                <th>サイト名:</th>
                <td><input type="text" name="name" value="{{isset($item['name']) ? $item['name'] : ''}}"></td>
            </tr>
            <tr>
                <th>サイトURL:</th>
                <td><input type="text" name="url" value="{{isset($item['url']) ? $item['url'] : ''}}"></td>
            </tr>
            <tr>
                <th>サイト画像名:</th>
                <td><input type="text" name="img" value="{{isset($item['img']) ? $item['img'] : ''}}"></td>
            </tr>
            <tr>
                <th>サイト説明:</th>
                <td>
                    <textarea name="description" id="" cols="30" rows="10" value="{{isset($item['description']) ? $item['description'] : ''}}">{{isset($item['description']) ? $item['description'] : ''}}</textarea>
                </td>
            </tr>
            <tr>
                <th>表示順:</th>
                <td><input type="text" name="turn" value="{{isset($item['turn']) ? $item['turn'] : ''}}"></td>
            </tr>
        </table>
        <p><input type="submit" value="確認画面へ" class="proceed"></p>
    </form>
@endsection