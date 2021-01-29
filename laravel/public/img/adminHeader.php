<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <title>サイトコレクター管理画面</title>
    </head>
    <body class="content">
        <header>
            <p>ログイン名[<?=$_SESSION['user_name']?>]さん、ご機嫌いかがですか？<a href="logout.php" class="logoutLink">ログアウトする</a></p>
            <table class="adminTable">
                <tr>
                    <th class="active"><label><a href="top.php">top</a></label></th>
                    <th><label><a href="site_list.php">サイト管理</a></label></th>
                    <th>〇〇管理</th>
                    <th>〇〇管理</th>
                    <th>〇〇管理</th>
                    <th>〇〇管理</th>
                </tr>
            </table>
        </header>
        