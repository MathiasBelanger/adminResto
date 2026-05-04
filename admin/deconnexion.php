<?php

require("nonContenu.php");

verifierAdmin();

unset($_SESSION["connecte"]);

header("location:index.php");
exit;