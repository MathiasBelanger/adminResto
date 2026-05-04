<?php

session_start();

require("bdd.php");
function verifierAdmin()
{
    if (!isset($_SESSION["connecte"]) || $_SESSION["connecte"] != true) {
        header(("location: connexion.php"));
        exit();
    }
}
