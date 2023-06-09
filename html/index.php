<?php

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
        <div class="row my-1">
            <div class="col">1</div>
            <div class="col">川井歩</div>
            <div class="col">参加</div>
            <div class="col">楽しみにしております。</div>
            <div class="col">
                <a href="/edit.php">編集</a>
                <a href="/delete.php">削除</a>
            </div>
        </div>
        <div class="row my-1">
            <div class="col">2</div>
            <div class="col">海色カイ</div>
            <div class="col">不参加</div>
            <div class="col">仕事が忙しいです。</div>
            <div class="col">
                <a href="/edit.php">編集</a>
                <a href="/delete.php">削除</a>
            </div>
        </div>
        <div class="row my-1">
            <div class="col">3</div>
            <div class="col">空色そら</div>
            <div class="col">参加</div>
            <div class="col"></div>
            <div class="col">
                <a href="/edit.php">編集</a>
                <a href="/delete.php">削除</a>
            </div>
        </div>

        <a href="/add.php" class="btn btn-secondary my-2">アンケートに回答する</a>
    </div>
</body>

</html>