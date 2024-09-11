<?php
defined('CONTROL') or die('Acesso negado');

//verifica se o formulario foi enviado
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    //verifica se usuario e senha foram enviados
    $usuario = $_POST['usuario'] ?? null;
    $senha = $_POST['senha'] ?? null;
    $erro = null;

    if(empty($usuario) || empty($senha)){
        $erro = "Usuario e Senha sao obrigatorios";
    }

    //verifica se usuario ou senha sao validos
    if(empty($erro)){

        $usuarios = require_once __DIR__ . '/../inc/usuarios.php';

        foreach($usuarios as $user){
            if($user['usuario'] == $usuario && password_verify($senha, $user['senha'])){

                //efetua login
                $_SESSION['usuario'] = $usuario;

                //voltar a pagina inicial
                header('location: index.php?rota=home');

            }
        }

        //login invalido
        $erro = "Usuario e/ou senha invalidos";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <form action="index.php?rota=login" method="post">
        <h3>Login</h3>
        <div>
            <label for="usuario">Usuario</label>
            <input type="email" name="usuario" id="usuario">
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
        </div>
        <div>
            <button type="submit">Entrar</button>
        </div>
    </form>

    <?php if(!empty($erro)) : ?>
       <p style="color: red"><?= $erro ?></p> 
    <?php endif;?>

</body>
</html>