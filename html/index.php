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
    <div class="container text-left w-50 mt-5">
        <h1 class="my-3">新人歓迎会参加アンケート結果</h1>

        <div class="d-flex flex-row border-bottom my-3">
            <div class="px-5">ID</div>
            <div class="px-5">氏名</div>
            <div class="px-5">参加するかどうか</div>
            <div class="px-5">コメント</div>
        </div>
        <div class="d-flex flex-row my-1">
            <div class="px-5">1</div>
            <div class="px-5">川井歩</div>
            <div class="px-5">参加</div>
            <div class="px-5">楽しみにしております。</div>
        </div>
        <div class="d-flex flex-row my-1">
            <div class="px-5">2</div>
            <div class="px-5">海色カイ</div>
            <div class="px-5">不参加</div>
            <div class="px-5">仕事が忙しいです。</div>
        </div>
        <div class="d-flex flex-row my-1">
            <div class="px-5">3</div>
            <div class="px-5">空色そら</div>
            <div class="px-5">参加</div>
            <div class="px-5"></div>
        </div>

        <a href="/add.php" class="btn btn-secondary my-2">アンケートに回答する</a>
    </div>
</body>

</html>