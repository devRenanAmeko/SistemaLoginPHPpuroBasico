<?php
defined('CONTROL') or die('Acesso negado');

//efetuar logout
session_destroy();

//voltar para pagina inicial
header('location: index.php?rota=login');