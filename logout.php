<?php
@session_start();
session_destroy();
header("Location: ../conteoLocal/login.php");
?>  