<!-- list画面のbladeテンプレート -->
@extends('top')

@section('site')
        <table class="site_list" border="1">
            <tr>
                <th>
                    <a href="/list?column=id&sort=asc" class="sortLink">&utrif;</a>ID
                    <a href="/list?column=id&sort=desc" class="sortLink">&dtrif;</a>
                </th>
                <th>
                    <a href="/list?column=name&sort=asc" class="sortLink">&utrif;</a>サイト名
                    <a href="/list?column=name&sort=desc" class="sortLink">&dtrif;</a>
                </th>
                <th>画像</th>
                <th>登録日時</th>
                <th>
                    <a href="/list?column=updated_at&sort=asc" class="sortLink">&utrif;</a>更新日時
                    <a href="/list?column=updated_at&sort=desc" class="sortLink">&dtrif;</a>
                </th>
                <th><button onclick="location.href='edit'" class="register">新規作成</button></th>
            </tr>
            @foreach($items as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td><img src="img/{{isset($item->img) ? $item->img : 'noImage.png'}}" alt=""></td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        <form action="/delete?id={{$item->id}}" method="post">
                            @csrf
                            <p>
                                <input type="submit" class="edit" formaction="/edit?id={{$item->id}}" value="編集">
                                <input type="submit" class="delete" onclick="return confirm('本当に削除しますか？')" name="delete" value="削除">
                            </p>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
@endsection