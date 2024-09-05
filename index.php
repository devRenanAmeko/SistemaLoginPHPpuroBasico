<?php

//iniciar sessao
session_start();

//definir uma constante de controle
define('CONTROL', true);

//verifica se existe usuario logado
$usuario_logado = $_SESSION['usuario'] ?? null;

//verifica qual a route na url
if(empty($usuario_logado)){
    $rota = 'login';
}else{
    $rota = $_GET['rota'] ?? 'home';
}

//se o usuario esta logado mas a rota é login, vai redirecionar para home
if(!empty($usuario_logado) && $rota == 'login'){
    $rota = 'home';
}

//analisa a route
$rotas = [
    'login'=> 'login.php',
    'home' => 'home.php',
    'page1' => 'page1.php',
    'page2' => 'page2.php',
    'page3' => 'page3.php',
    'logout' => 'logout.php'
];

if(!key_exists($rota, $rotas)){
    die('Acesso negado');
}

require_once $rotas[$rota];
