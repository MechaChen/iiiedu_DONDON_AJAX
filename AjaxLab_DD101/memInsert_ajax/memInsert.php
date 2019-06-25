<?php 
$jsonStr = $_REQUEST["jsonStr"];
$memRow = json_decode($jsonStr);

try {
    require_once('connectBooks.php');
    $sql = 
    'INSERT INTO member(`no`, `memName`, `memId`, `memPsw`, `email`, `sex`, `birthday`, `tel`)
                 VALUES(null, :memName, :memId, :memPsw, :email, :sex, :birthday, :tel )
    ';
    $member = $pdo->prepare($sql);
    $member->bindValue(':memName', $memRow->memName);
    $member->bindValue(':memId', $memRow->memId);
    $member->bindValue(':memPsw', $memRow->memPsw);
    $member->bindValue(':email', $memRow->email);
    $member->bindValue(':sex', $memRow->sex);
    $member->bindValue(':birthday', $memRow->birthday);
    $member->bindValue(':tel', $memRow->tel);
    $member->execute();

    echo 'success';
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>