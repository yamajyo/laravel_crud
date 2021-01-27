@extends('main')

@section('m')
    <p>
        ログイン名[{{$userName}}]さんこんちは
        <a href="logout" class="logout">ログアウト</a>
    </p>
    <h1>サイトコレクター管理</h1>
    <table class="managementTable">
        <tr>
            <th class="Choice"><a href="http://dev.my_project.com//list">サイト管理</a></th>
            <th>○○管理</th>
            <th>○○管理</th>
            <th>○○管理</th>
            <th>○○管理</th>
            <th>○○管理</th>
        </tr>
    </table>
    @yield('site')
@endsection