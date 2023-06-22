<?php
require('./functions.php');

createToken();

// データベースへの接続
$link = mysqli_connect('db', 'root', 'secret', 'sample');
if ($link == null) {
    die("データベースの接続に失敗しました。");
}

// POST のときはデータの更新を実行
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    validateToken();

    // 投稿IDの代入
    $post_id = $_POST["id"];

    // データの更新

    $update = "UPDATE questionnaire SET username = '" . $_POST['username'] . "', participation_id = " . $_POST['participation_id'] . ", comment = '" .  $_POST['comment']  . "' WHERE id = $post_id;";
    mysqli_query($link, $update);

    // ホーム画面にリダイレクト
    header('Location: http://' . $_SERVER['HTTP_HOST']);
} else {
    // 投稿IDの代入
    $get_id = $_GET["id"];

    // 投稿内容の取得
    $sql = "SELECT * FROM questionnaire WHERE id = $get_id;";
    $res = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($res);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケート結果を編集する</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container text-left w-25 mt-5">
        <h1 class="my-3">新人歓迎会参加アンケート</h1>
        <form method="POST" action="./edit.php">
            <div class="d-flex flex-column mt-3">
                <label for="username">氏名</label>
                <input type="text" name="username" value=<?= h($row["username"]); ?> />
            </div>
            <div class="d-flex flex-column mt-3">
                <label for="participation_id">新人歓迎会に参加しますか？:</label>
                <select name="participation_id">
                    <option value="1">参加！</option>
                    <option value="2">不参加で。。。</optiohn>
                    <option value=<?= $row["participation_id"] ?> selected hidden><?php
                                                                                    if ($row["participation_id"] === "1") {
                                                                                        echo "参加！";
                                                                                    } else {
                                                                                        echo "不参加で。。。";
                                                                                    }
                                                                                    ?></option>
                </select>
            </div>
            <div class="d-flex flex-column mt-3">
                <label for="comment">コメント:</label>
                <textarea name="comment"><?= h($row["comment"]); ?></textarea>
            </div>
            <div class="mt-3">
                <a href="/index.php" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn btn-secondary">送信</button>
            </div>
            <input type="hidden" name="id" value="<?= $row["id"]; ?>" />
        </form>
    </div>
</body>

</html>