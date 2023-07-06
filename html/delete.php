<?php
// 外部ファイルの読み込み
require('./security.php');

// トークンの確認
validate_token();

try {
    // データベースに接続
    $pdo = new PDO('mysql:charset=UTF8;dbname=sample;host=db;', 'root', 'secret');
    // 投稿IDの代入
    $id = $_SERVER['REQUEST_URI'];
    $id = preg_replace("/[^0-9]/", "", $id);
    $id = (int)$id;
    // SQL文
    $sql = "DELETE FROM questionnaire WHERE id = $id";
    // SQLの実行
    $pdo->query($sql);
    // ホーム画面にリダイレクト
    header('Location: http://localhost:8080/index.php');
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
} finally {
    $pdo = null;
}
