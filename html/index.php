<?php
// 外部ファイルの読み込み
require('./security.php');

try {
    // データベースに接続
    $pdo = new PDO('mysql:charset=UTF8;dbname=sample;host=db;', 'root', 'secret');
    // SQL文
    $sql = "SELECT * FROM questionnaire";
    // SQLの実行
    $res = $pdo->query($sql);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
} finally {
    $pdo = null;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケート結果一覧</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container text-left w-75 mt-5">
        <h1 class="my-3">新人歓迎会参加アンケート結果</h1>
        <div class="row border-bottom border-2 border-dark my-3">
            <p class="h6 col">ID</p>
            <p class="h6 col">氏名</p>
            <p class="h6 col">参加するかどうか</p>
            <p class="h6 col">コメント</p>
            <div class="col"></div>
        </div>
        <?php foreach ($res as $result) : ?>
            <div class="row border-bottom border-1 border-sedondary py-2">
                <div class="col"><?= h($result["id"]); ?></div>
                <div class="col"><?= h($result["username"]); ?></div>
                <div class="col"><?php
                                    echo $result["participation_id"] === 1 ? "参加！" : "不参加で。。。";
                                    ?></div>
                <div class="col"><?= h($result["comment"]); ?></div>
                <div class="col">
                    <a href="/edit.php?id=<?= $result["id"]; ?>">編集</a>
                    <a href="/delete.php?id=<?= $result["id"]; ?>">削除</a>
                </div>
            </div>
        <?php endforeach ?>
        <a href="/add.php" class="btn btn-secondary my-2">アンケートに回答する</a>
    </div>
</body>

</html>