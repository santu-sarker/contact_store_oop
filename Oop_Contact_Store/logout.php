<?php
session_start();
session_destroy();
setcookie("id", "", time() - (86400 * 2), "/");
setcookie("name", "", time() - (86400 * 2), "/");
header("location: ./login.php");
