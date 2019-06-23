function $id(id) {
  return document.getElementById(id);
}

function showLoginForm() {
  //檢查登入bar面版上 spanLogin 的字是登入或登出
  //如果是登入，就顯示登入用的燈箱(lightBox)
  //如果是登出
  //將登入bar面版上，登入者資料清空
  //spanLogin的字改成登入
  //將頁面上的使用者資料清掉
  if ($id("spanLogin").innerHTML == "登入") {
    $id("lightBox").style.display = "block";
  } else {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          $id("memName").innerHTML = "&nbsp";
          $id("spanLogin").innerHTML = "登入";
        }
      }
    };
    const url = `ajaxLogout.php`;
    xhr.open("get", url, true);
    xhr.send(null);
  }
} //showLoginForm

function sendForm() {
  //=====使用Ajax 回server端,取回登入者姓名, 放到頁面上
  const xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        if (xhr.responseText != "error") {
          //將登入表單上的資料清空，並隱藏起來
          $id("lightBox").style.display = "none";
          $id("memId").value = "";
          $id("memPsw").value = "";
          $id("memName").innerText = xhr.responseText;
          $id("spanLogin").innerText = "登出";
        } else {
          alert("帳密錯誤");
        }
      }
    }
  };

  const url = `ajaxLogin.php?memId=${$id("memId").value}&memPsw=${
    $id("memPsw").value
  }`;
  xhr.open("get", url, true);

  xhr.send(null);
}

function cancelLogin() {
  //將登入表單上的資料清空，並將燈箱隱藏起來
  $id("lightBox").style.display = "none";
  $id("memId").value = "";
  $id("memPsw").value = "";
}

function init() {
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        if (xhr.responseText != "notLogin") {
          $id("memName").innerHTML = xhr.responseText;
          $id("spanLogin").innerHTML = "登出";
        } else {
          $id("memName").innerHTML = "&nbsp;";
        }
      }
    }
  };

  const url = "getLoginInfo.php";
  xhr.open("get", url, true);

  xhr.send(null);

  //===設定spanLogin.onclick 事件處理程序是 showLoginForm
  $id("spanLogin").onclick = showLoginForm;

  //===設定btnLogin.onclick 事件處理程序是 sendForm
  $id("btnLogin").onclick = sendForm;

  //===設定btnLoginCancel.onclick 事件處理程序是 cancelLogin
  $id("btnLoginCancel").onclick = cancelLogin;
} //window.onload

window.onload = init;
