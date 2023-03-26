<?php
session_start();
function nactiTridu($nazevTridy) {
    if (str_ends_with($nazevTridy, "Kontroler")) {
        require "kontrolery/$nazevTridy.php";
    }
    else {
        require "modely/$nazevTridy.php";
    }
}

spl_autoload_register("nactiTridu");

Db::pripoj("localhost", "postgres", "admin", "ukol_wea");