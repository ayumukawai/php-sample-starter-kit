window.addEventListener("DOMContentLoaded", () => {
  const submit = document.getElementById("submitbtn");
  const userName = document.getElementById("username");
  const comment = document.getElementById("comment");
  const userNameFeedBack = document.getElementById("ufeedback");
  const commentFeedBack = document.getElementById("cfeedback");

  submit.addEventListener("click", (e) => {
    userNameError(userName.value);
    commentError(comment.value);
    if (
      userNameError(userName.value) ||
      commentError(comment.value)
    ) {
      e.preventDefault();
    }
  });

  userName.addEventListener("input", () => {
    if (userName.classList.contains("is-invalid")) {
      userName.classList.remove("is-invalid");
    }
  });

  comment.addEventListener("input", () => {
    if (comment.classList.contains("is-invalid")) {
      comment.classList.remove("is-invalid");
    }
  });

  function userNameError(string) {
    if (string === "") {
      userName.classList.add("is-invalid");
      userNameFeedBack.textContent = "氏名は必須項目です";
      return true;
    } else if (string.length > 20) {
      userName.classList.add("is-invalid");
      userNameFeedBack.textContent = "氏名は20文字以内で入力してください。";
      return true;
    }else{
      return false;
    }
  }

  function commentError(string) {
    if (string.length > 100) {
      comment.classList.add("is-invalid");
      commentFeedBack.textContent = "コメントは100文字以内で入力してください。";
      return true;
    }else {
      return false;
    }
  }
});
