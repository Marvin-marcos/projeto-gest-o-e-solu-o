<?php

session_start();
session_destroy(); // Destroi a sessão para efetuar o logout
header('Location: ../cadastro/Login.php'); // Redireciona para a página


?>