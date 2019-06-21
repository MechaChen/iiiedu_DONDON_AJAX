<?php
try{
  require_once("connectBooks.php");
  $sql = "select * from member where memId=:memId";

  //如果找得資料，取回資料，送出xml文件
  
}catch(PDOException $e){
  echo $e->getMessage();
}
?>