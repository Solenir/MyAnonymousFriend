<?php

require_once(__DIR__."/../../../application/controller/ControladorUsuario.php");

if(!isset($_SESSION)){
    session_start();
}

if (isset($_POST['botaoCadastro'])){  // Checa se uma solicitação de cadastro foi solicitada
    // Captura os parâmentros do formulário de cadastro

    $nome  = (isset($_POST['nome'])) ? $_POST['nome'] : '';
    $login   = (isset($_POST['login'])) ? $_POST['login'] : '';
    $senha  = (isset($_POST['senha'])) ? $_POST['senha'] : '';
    $senha2  = (isset($_POST['senha2'])) ? $_POST['senha2'] : '';



   
    if ($nome != '' && $login !='' && $senha !='' && $senha2 != ''  && $senha == $senha2) {  // Checa se os parâmetros do formulário foram setados
        if ((new ControladorUsuario())->cadastrar($nome, $login, $senha)) { // Checa se o cadastro ocorreu com sucesso
            $_SESSION['logado'] = true;
            header("HTTP/1.0 200 OK");

        } else { // Falha interna ao cadastrar o usuário
            header("HTTP/1.0 500 error");
        }
    }else {
        header("HTTP/1.0 400 Bad request");
    }

}
elseif (isset($_POST['botaoEntrar'])) {

    // Captura os parâmentros do formulário de login
    $lembrete = (isset($_POST['lembrete'])) ? $_POST['lembrete'] : '';
    $login   = (isset($_POST['login'])) ? $_POST['login'] : '';
    $senha  = (isset($_POST['senha'])) ? $_POST['senha'] : '';



    if ($login != '' && $senha != '') {  // Checa se os parâmetros do formulário foram setados
        if ((new ControladorUsuario())->fazerLogin($login,$senha)){ // Checa se o login ocorreu com sucesso
            $_SESSION['logado'] = true;


            if ($lembrete == 'SIM') {

                $expira = time() + 60 * 60 * 24 * 30;
                setcookie('Lembrete', base64_encode('SIM'), $expira);
                setcookie('Login', base64_encode($login), $expira);
                setcookie('Senha', base64_encode($senha), $expira);

            } else {

                setcookie('Lembrete');
                setcookie('Login');
                setcookie('Senha');
            }
            header("HTTP/1.0 200 OK");

        }else
            header("HTTP/1.0 401 Unauthorized");


    } else
        header("HTTP/1.0 400 Bad request");
}

?>
