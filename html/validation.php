<?php

function usernameError()
{
    if (isset($_POST)) {
        if (empty($_POST['username'])) {
            $usernameError = "氏名は必須項目です。";
        } else if (mb_strlen($_POST['username']) > 20) {
            $usernameError = "氏名は20文字以内で入力して下さい。";
        } else {
            $usernameError = "";
        }
    }
    return $usernameError;
}

function commentError()
{
    if (isset($_POST)) {
        if (mb_strlen($_POST['comment']) > 100) {
            $commentError = "コメントは100文字以内で入力して下さい。";
        } else {
            $commentError = "";
        }
    }
    return $commentError;
}

function usernameIsInvalid()
{
    $usernameError = usernameError();
    if ($usernameError !== "") {
        $isInvalidUsername = "is-invalid";
    } else {
        $isInvalidUsername = "";
    }
    return $isInvalidUsername;
}

function commentIsInvalid()
{
    $commentError = commentError();
    if ($commentError !== "") {
        $isInvalidComment = "is-invalid";
    } else {
        $isInvalidComment = "";
    }
    return $isInvalidComment;
}
