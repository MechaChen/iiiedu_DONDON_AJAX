<?php
try{
  require_once("../connectBooks.php");
  $sql =
  "SELECT *
  FROM member
  WHERE memId = :memId
  ";
  $member = $pdo->prepare($sql);
  $member->bindValue(':memId', $_REQUEST["memId"]);
  $member->execute();
  
  if( $member->rowCount() == 0 ){//找不到
    echo "not found~";
  } else {//如果找得資料,將會員資料送出
    $memRow = $member->fetch(PDO::FETCH_ASSOC);

    //將各欄位內容串接起來
    echo "
    <table border='1'>
      <tr>
        <th>名稱</th>
        <td>{$memRow["memName"]}</td>
      </tr>
      <tr>
        <th>帳號</th>
        <td>{$memRow["memId"]}</td>
      </tr>
      <tr>
        <th>密碼</th>
        <td>{$memRow["memPsw"]}</td>
        </tr>
      <tr>
        <th>信箱</th>
        <td>{$memRow["email"]}</td>
      </tr>
    </table>
    ";
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>