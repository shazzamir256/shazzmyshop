<?php

session_start();

session_destroy();

echo"<script>window.open('login.php?log_out=You have Successfully Logged out, Please Come Back Soon!','_self')</script>";

?>