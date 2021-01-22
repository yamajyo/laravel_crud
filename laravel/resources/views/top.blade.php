@extends('main')

@section('m')
    <p>
        ログイン名[{{$userName}}]さんこんちは
        <a href="logout" class="logout">ログアウト</a>
    </p>
    <h1>サイトコレクター管理</h1>
    <table>
        <tr>
            <th class="Choice"><a href="silt_list">サイト管理</a></th>
            <th>○○管理</th>
            <th>○○管理</th>
            <th>○○管理</th>
            <th>○○管理</th>
            <th>○○管理</th>
        </tr>
    </table>
@endsection