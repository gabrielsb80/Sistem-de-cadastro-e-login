<?php

require __DIR__."/vendor/autoload.php";

use App\Entity\Cliente;
use App\Session\Login;

$userLogado = Login::getUserLogado();

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header('location: painel.php?status=error');
    exit;
}
//CONSULTA O CLIENTE
$ConsultaCliente = Cliente::getCliente($_GET['id']);

//VALIDAÇÃO DO CLIENTE
if(!$ConsultaCliente instanceof Cliente){
    header('location: painel.php?status=error');
    exit;
}


if(isset($_POST['nome'],$_POST['email'])){
    $client = new Cliente;
    $client->setNome($_POST['nome']);
    $client->setEmail($_POST['email']);
    $client->atualizar($userLogado['id']);

    Login::logout();
}





?>
<?php include __DIR__."/includes/header.php"; ?>
<section class="bg-danger mt-5 jumbotron">
    
    <h1>Editar Informações</h1>
   
    <form method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value=<?=$userLogado['email']?> class="form-control col-5">
        </div>

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" value=<?=$userLogado['nome']?> class="form-control col-5">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
            <a href="painel.php">
                <button type="button" class="btn btn-success ml-5">Voltar</button>
            </a>
        </div>
        
    </form>
</section>



<?php include __DIR__."/includes/footer.php";?>
