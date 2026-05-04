<?php
require("includes/init.php");

verifierAdmin();

unset($_SESSION["connecte"]);

header("location:index.php");
exit();
