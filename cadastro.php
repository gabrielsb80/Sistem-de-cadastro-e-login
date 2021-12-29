<?php

require __DIR__."/vendor/autoload.php";

use App\Entity\Cliente;


$mensagem = '';

//Verefica se o método de request utilizado para acessar a página é 'POST'
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //coleta as informações passada pelo input do formulario
    $name = htmlspecialchars($_REQUEST['nome']);
    $email = htmlspecialchars($_REQUEST['email']);
    $senha = htmlspecialchars($_REQUEST['senha']);
    
    //verifica se os input passado estão vazio
    if(empty($name) || empty($senha) || empty($email)){
        $mensagem = '<div class="alert alert-danger">Preencha todos os campos</div>';
        
    }//verifica se não esta vazio e se algum valor foi passado pelos input
    elseif(isset($_POST['email'])&& !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){
        
        //vai verificar se o email passado existe no banco de dados
        $client = Cliente::ValidarEmail($_POST['email']);

        if($client instanceof Cliente){
            
            echo "<script language='javascript' type='text/javascript'>
            alert('email digitado ja está em uso');window.location
            .href='cadastro.php';</script>";
        }
        //Cadastrar as informações no Banco de Dados
        $client = new Cliente;
        $client->setNome($_POST['nome']);
        $client->setEmail($_POST['email']);
        $client->setSenha(password_hash($_POST['senha'],PASSWORD_DEFAULT));
        $client->cadastrar();

        //Redereciona para a tela de login
        header('location: index.php?status=success');
        exit;
        
    }

}   

?>

<?php include __DIR__."/includes/header.php"; ?>
<section class="bg-danger mt-5 jumbotron">
    
    <h1>Cadastro</h1>
    <?=$mensagem?>
    <form method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" placeholder="email" class="form-control col-5">
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="senha" placeholder="senha" class="form-control col-5">
        </div>

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" placeholder="nome" class="form-control col-5">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success" id="btn-cadastrar">Cadastrar</button>
            <a href="index.php">
                <button type="button" class="btn btn-success ml-5">Voltar</button>
            </a>
        </div>
        
    </form>
</section>



<?php include __DIR__."/includes/footer.php";?>