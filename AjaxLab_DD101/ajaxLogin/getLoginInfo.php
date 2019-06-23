<?php
session_start();
if(isset($_SESSION["memId"])) {
    echo $_SESSION["memName"];
} else {
    echo 'notLogin';
}
?>