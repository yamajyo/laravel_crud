<!-- ログインフォームのbladeテンプレート -->
@extends('base')

@section('main')
    <main>
        <h1 class="login">ログイン認証</h1>
                @if($errors->has('mail'))
                    <p class="error">{{$errors->first('mail')}}</ｐ>
                @endif
                @if(isset($dbErrorMessage))
                    <p class="error">{{$dbErrorMessage}}</ｐ>
                @endif
        <form action="/test" method="post">
            <!-- ブレードテンプレートでは@csrf（シーサーフディレクティブ）を記述しなければエラーになるので注意 -->
            @csrf
            <table class="login_table">
                <tr>
                    <th>メール:</th>
                    <td><input type="text" name="mail"></td>
                </tr>
                <tr>
                    <th>パスワード:</th>
                    <td><input type="text" name="password"></td>
                </tr>
            </table>
            <p><input type="submit" class="login_submit" value="認証"></p>
        </form>
    </main>
@endsection