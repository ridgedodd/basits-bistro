<?php
session_start();
session_destroy();
header('location:index.php?loggedOut=1');
?>