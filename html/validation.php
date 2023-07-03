<?php

function username_error()
{
    if (isset($_POST)) {
        if (empty($_POST['username'])) {
            $username_error = "氏名は必須項目です。";
        } else if (mb_strlen($_POST['username']) > 20) {
            $username_error = "氏名は20文字以内で入力して下さい。";
        } else {
            $username_error = "";
        }
    }
    return $username_error;
}

function comment_error()
{
    if (isset($_POST)) {
        if (mb_strlen($_POST['comment']) > 100) {
            $comment_error = "コメントは100文字以内で入力して下さい。";
        } else {
            $comment_error = "";
        }
    }
    return $comment_error;
}

function username_invalid()
{
    $username_error = username_error();
    if ($username_error !== "") {
        $invalid_username = "is-invalid";
    } else {
        $invalid_username = "";
    }
    return $invalid_username;
}

function comment_invalid()
{
    $comment_error = comment_error();
    if ($comment_error !== "") {
        $invalid_comment = "is-invalid";
    } else {
        $invalid_comment = "";
    }
    return $invalid_comment;
}
