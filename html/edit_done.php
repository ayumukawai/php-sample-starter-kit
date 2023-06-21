<?php

// POST のときはデータの更新を実行
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // データベースへの接続
    $link = mysqli_connect('db', 'root', 'secret', 'sample');
    if ($link == null) {
        die("データベースの接続に失敗しました。");
    }

    $id = $_POST["id"];

    // データの更新
    $sql = "UPDATE questionnaire SET username = '" . $_POST['username'] . "', participation_id = " . $_POST['participation_id'] . ", comment = '" . $_POST['comment'] . "'  WHERE id = $id;";

    mysqli_query($link, $sql);

    // ホーム画面にリダイレクト
    header('Location: http://' . $_SERVER['HTTP_HOST']);
}
