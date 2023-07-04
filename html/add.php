<?php
// 外部ファイルの読み込み
require('./security.php');
require('./validation.php');

// トークンの生成
create_token();

// 変数の初期化
$username = "";
$participation_id = 1;
$comment = "";

// POST のときはデータの投稿を実行
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // トークンの確認
  validate_token();
  try {
    // データベースに接続
    $pdo = new PDO('mysql:charset=UTF8;dbname=sample;host=db;', 'root', 'secret');
    // POSTされた情報を変数に格納
    $username = $_POST["username"];
    $participation_id = (int)$_POST["participation_id"];
    $comment = $_POST["comment"];
    // SQL文
    $sql = "INSERT INTO questionnaire (username, participation_id, comment) VALUES (:username, :participation_id, :comment)";
    // 実行するSQLの準備
    $stmt = $pdo->prepare($sql);
    // 値をバインド(SQLインジェクション対策)
    $stmt->bindValue(":username", $username);
    $stmt->bindValue(":participation_id", $participation_id);
    $stmt->bindValue(":comment", $comment);

    // バリデーションチェック
    $username_error = username_error();
    $comment_error = comment_error();
    $invalid_username = username_invalid();
    $invalid_comment = comment_invalid();

    if ($username_error === "" && $comment_error === "") {
      // SQLの実行
      $stmt->execute();

      // ホーム画面にリダイレクト
      header('Location: http://localhost:8080/index.php');
    } else {
      $pdo = null;
    }
  } catch (PDOException $e) {
    echo $e->getmessage();
    exit();
  } finally {
    $pdo = null;
  }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アンケート入力</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="validation.js" defer></script>
</head>

<body>
  <div class="container text-left w-25 mt-5">
    <h1 class="my-3">新人歓迎会参加アンケート</h1>
    <form method="POST" action="./add.php" id="form">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>" />
      <div class="d-flex flex-column mt-3">
        <label for="username">氏名</label>
        <input type="text" name="username" class="form-control <?= $invalid_username ?>" value="<?= h($username); ?>" placeholder="20文字以内で入力してください。" />
        <div class="invalid-feedback"><?= $username_error ?></div>
      </div>
      <div class="d-flex flex-column mt-3">
        <label for="participation_id">新人歓迎会に参加しますか？:</label>
        <select name="participation_id" class="form-control">
          <option value="1" <?php if ($participation_id === 1) {
                              echo "selected";
                            } ?>>参加！</option>
          <option value="2" <?php if ($participation_id === 2) {
                              echo "selected";
                            } ?>>不参加で。。。</option>
        </select>
      </div>
      <div class="d-flex flex-column mt-3">
        <label for="comment">コメント:</label>
        <textarea name="comment" class="form-control <?= $invalid_comment ?>" placeholder="100文字以内で任意のコメントを入力できます。"><?= h($comment); ?></textarea>
        <div class="invalid-feedback"><?= $comment_error ?></div>
      </div>
      <div class="mt-3">
        <a href="/index.php" class="btn btn-secondary">戻る</a>
        <button type="submit" class="btn btn-secondary" id="submit">送信</button>
      </div>
    </form>
  </div>
</body>

</html>