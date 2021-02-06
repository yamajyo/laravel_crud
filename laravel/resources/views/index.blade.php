<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="「サイトコレクターでは、様々なサイト（ホームページ）をご紹介させていただいております。ご興味のあるサイトがございましたら、ぜひ各リンクをクリックしてみてください。」">
    <meta name="keywords" content="サイトコレクター,サイト 一覧,サイト 紹介,ホームページ 一覧,ホームページ,ホームページ紹介,ホームページデザイン">
    <title>サイトコレクター</title>
    <link rel="stylesheet" href="{{asset('css/user_style.css')}}" type="text/css">
</head>
<body>
    <div id="wrapper">
        <header>
            <p><a href="index.php"><img src="img/logo.png"></a></p>
        </header>
            <div id="sidebar">
                <div id="menu">
                    <!-- @if (!empty($siteCategoryList)) -->
                        <h2>メニュー 一覧</h2>
                            <ul>
                                @foreach ($siteCategoryList as $value)
                                    <li><a href="">{{$value->name}}</a></li>
                                @endforeach
                            </ul>
                        <h2>サイト種類別統計</h2>
                    <!-- @endif -->
                    <div id ="inquiry">
                        <p><a href="contact.php">お問い合わせ</a></p>
                    </div>
                </div>
            </div>
    </div><!-- wrapper -->
</body>
<div class="totop"><a href="#wrapper"><img src="img/gotop.png"></a></div>
<footer>
    <p><small>Copyright&nbsp;&copy;&nbsp;ホームページコレクション&nbsp;lnc.All Rights Reserved.</small></p> <a href="./">TOPページ</a>
    <a href="http://ebacorp.jp/kaisyagaiyou.html" target="_blank">運営会社</a>
    <a href="http://ebacorp.jp/privacy.html" target="_blank">プライバシーポリシー</a>
</footer>
</html>
