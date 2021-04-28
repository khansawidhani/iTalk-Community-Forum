<?php
session_start();
session_destroy();
header("location:/OnlineForum/index.php");
?>