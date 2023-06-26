<?php

try {
    // データベースに接続
    $pdo = new PDO('mysql:charset=UTF8;dbname=sample;host=db;', 'root', 'secret');
    // 投稿IDの取得
    $id = $_GET["id"];
    // SQL文
    $sql = "DELETE FROM questionnaire WHERE id = $id";
    // SQLの実行
    $pdo->query($sql);
    // ホーム画面にリダイレクト
    header('Location: http://' . $_SERVER['HTTP_HOST']);
} catch (PDOException $e) {
    echo $e->getMessage();
} finally {
    $pdo = null;
}
