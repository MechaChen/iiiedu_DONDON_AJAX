<?php
try{
  require_once("connectBooks.php");
  $sql = 
  "SELECT * 
  FROM member 
  WHERE memId = :memId";
  $member = $pdo->prepare($sql);
  $member->bindValue(':memId', $_REQUEST["memId"]);
  $member->execute();
  
  if( $member->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo '{}';
    
  }else{ //找得到
    //取回一筆資料
    // $memRow = $member->fetch(PDO::FETCH_ASSOC);
    $memRow = $member->fetchObject();

    //送出json字串
    // echo 
    // "<table>
    //   <tr><th>姓名</th><td>{$memRow["memName"]}</td></tr>
    //   <tr><th>帳號</th><td>{$memRow["memId"]}</td></tr>
    //   <tr><th>生日</th><td>{$memRow["birthday"]}</td></tr>
    //   <tr><th>email</th><td>{$memRow["email"]}</td></tr>
    // </table>";
    echo 
    "<table>
      <tr><th>姓名</th><td>{$memRow->memName}</td></tr>
      <tr><th>帳號</th><td>{$memRow->memId}</td></tr>
      <tr><th>生日</th><td>{$memRow->birthday}</td></tr>
      <tr><th>email</th><td>{$memRow->email}</td></tr>
    </table>";
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>