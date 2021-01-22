@extends('main')

@section('m')
    <h1>ログイン認証</h1>
    <form action="/test" method="post">
        @csrf
        <table>
            <tr>
                <th>メール:</th>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <th>パスワード:</th>
                <td><input type="text" name="password"></td>
            </tr>
        </table>
        <p><input type="submit" value="送信"></p>
    </form>
@endsection