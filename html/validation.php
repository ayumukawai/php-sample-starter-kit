<?php

$errors = [];

if (isset($_POST)) {
    if (empty($_POST['username'])) {
        $errors[] = "氏名は必須項目です。";
    } else if (mb_strlen($_POST['username']) > 20) {
        $errors[] = "氏名は20文字以内で入力して下さい。";
    }

    if (mb_strlen($_POST['comment']) > 100) {
        $errors[] = "コメントは100文字以内で入力して下さい。";
    }
}
