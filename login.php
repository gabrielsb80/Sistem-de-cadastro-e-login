<?php

require __DIR__."/vendor/autoload.php";

use App\Entity\Cliente;
use App\Session\Login;



//Verefica se o método de request utilizado para acessar a página é 'POST'
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //coleta as informações passada pelo input do formulario
    $email = htmlspecialchars($_REQUEST['email']);
    $senha = htmlspecialchars($_REQUEST['senha']);
    
    //verifica se os input passado estão vazio
    if(empty($senha) || empty($email)){
        echo "<script language='javascript' type='text/javascript'>
            alert('Preencha todos os campos');window.location
            .href='index.php';</script>";
        
    }//verifica se não esta vazio e se algum valor foi passado pelos input
    elseif(isset($_POST['email'])&& !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){
        
        //vai verificar se o email passado existe no banco de dados
        $client = Cliente::ValidarEmail($_POST['email']);
        
        
        //Verificar se o email e a senha passada pelo input bate com o Banco de Dados
        if($client instanceof Cliente && password_verify($_POST['senha'], $client->getSenha())){
            Login::login($client);
        }else{
            echo "<script language='javascript' type='text/javascript'>
            alert('Login e/ou senha incorretos');window.location
            .href='index.php';</script>";
        }
        
    
        
        
    }

}











































