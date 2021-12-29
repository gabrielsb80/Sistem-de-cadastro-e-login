<?php 
$mensagem = '';
if(isset($_GET['status'])){
    switch ($_GET['status']) {
      case 'success':
        $mensagem = '<div class="alert alert-success">Cadastrado com sucesso!</div>';
        break;

      case 'error':
        $mensagem = '<div class="alert alert-danger">Cadastro não realizado!</div>';
        break;
    }
  }

?>

<section class="bg-danger mt-5 jumbotron">
    <h1>Login</h1>
    <?=$mensagem?>
    <form  action="login.php" method="post" >
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" placeholder="email" class="form-control col-5">
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="senha" placeholder="senha" class="form-control col-5">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Entrar</button>
        
            
        </div>
        <a href="cadastro.php" class="text-white mt-3">
                
                <p>Não está cadastrado?<strong>Cadastre Aqui!</strong></p>
            </a>
    </form>
</section>