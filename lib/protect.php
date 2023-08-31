<?php

if (!function_exists("protect")) {
    function protect($admin)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            die("<script>location.href='entrar.php';</script>");
        }

        if ($admin == 1 && $_SESSION['admin'] != 1) {
            die("<script>location.href='entrar.php';</script>");
        }
    }
}