<?php

// データベースへの接続
$link = mysqli_connect('db', 'root', 'secret', 'sample');
if ($link == null) {
    die("データベースの接続に失敗しました。");
}

// 投稿IDの取得
$id = $_GET["id"];

// データの削除
$sql = "DELETE FROM questionnaire WHERE id = $id;";

mysqli_query($link, $sql);

// ホーム画面にリダイレクト
header('Location: http://' . $_SERVER['HTTP_HOST']);
