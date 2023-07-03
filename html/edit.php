<?php
// 外部ファイルの読み込み
require('./security.php');
require('./validation.php');

// トークンの生成
create_token();

// データベースに接続
$pdo = new PDO('mysql:charset=UTF8;dbname=sample;host=db;', 'root', 'secret');

// POST のときはデータの更新を実行
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // トークンの確認
    validate_token();
    try {
        // POSTされた情報を変数に格納
        $id = $_POST["id"];
        $username = $_POST["username"];
        $participation_id = $_POST["participation_id"];
        $comment = $_POST["comment"];
        // SQL文
        $sql = "UPDATE questionnaire SET username = :username, participation_id = :participation_id, comment = :comment WHERE id = :id";
        // 実行するSQLの準備
        $stmt = $pdo->prepare($sql);
        // 値をバインド(SQLインジェクション対策)
        $stmt->bindValue(":id", $id);
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
            header('Location: index.php');
        } else {
            try {
                // 投稿内容の取得
                $sql = "SELECT * FROM questionnaire WHERE id = $id";
                $res = $pdo->query($sql);
                $data = $res->fetch();
            } catch (PDOException $e) {
                echo $e->getMessage();
            } finally {
                $pdo = null;
            }
        }
    } catch (PDOException $e) {
        echo $e->getmessage();
    } finally {
        $pdo = null;
    }
} else {
    try {
        // 投稿IDの代入
        $id = $_GET["id"];
        // 投稿内容の取得
        $sql = "SELECT * FROM questionnaire WHERE id = $id";
        $res = $pdo->query($sql);
        $data = $res->fetch();
    } catch (PDOException $e) {
        echo $e->getMessage();
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
    <title>アンケート結果を編集する</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container text-left w-25 mt-5">
        <h1 class="my-3">新人歓迎会参加アンケート</h1>
        <form method="POST" action="./edit.php">
            <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
            <div class="d-flex flex-column mt-3">
                <label for="username">氏名</label>
                <input type="text" name="username" class="form-control <?= $invalid_username ?>" value=<?= h($data["username"]); ?> />
                <div class="invalid-feedback"><?= $username_error ?></div>
            </div>
            <div class="d-flex flex-column mt-3">
                <label for="participation_id">新人歓迎会に参加しますか？:</label>
                <select name="participation_id" class="form-control">
                    <option value="1">参加！</option>
                    <option value="2">不参加で。。。</optiohn>
                    <option value=<?= $data["participation_id"] ?> selected hidden><?php
                                                                                    echo $data["participation_id"] === 1 ? "参加！" : "不参加で。。。";
                                                                                    ?></option>
                </select>
            </div>
            <div class="d-flex flex-column mt-3">
                <label for="comment">コメント:</label>
                <textarea name="comment" class="form-control <?= $invalid_comment ?>"><?= h($data["comment"]); ?></textarea>
                <div class="invalid-feedback"><?= $comment_error ?></div>
            </div>
            <div class="mt-3">
                <a href="/index.php" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn btn-secondary">送信</button>
            </div>
            <input type="hidden" name="id" value="<?= $data["id"]; ?>" />
        </form>
    </div>
</body>

</html>