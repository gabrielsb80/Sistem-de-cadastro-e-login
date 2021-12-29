<?php

require __DIR__."/vendor/autoload.php";

include __DIR__."/includes/header.php";

use App\Session\Login;

Login::requireLogin();

$userLogado = Login::getUserLogado();

?>


<div class="jumbotron bg-warning mt-4 text-dark">
              <h1 class="text-center">Painel de Controle</h1>
              <h3 class="mt-4">Bem Vindo,<?=$userLogado['nome']?></h3>
              <hr class="border-light">
              <p>Bem vindo ao painel de controle, aqui você pode </br>visualizar suas informações e edita-las quando quiser</p>
                
                
</div>

<a href="logout.php" class="btn btn-danger">sair</a>

<section>
      <table class="table bg-light mt-4 text-dark">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <tr>
           <td><?=$userLogado['id']?></td>
           <td><?=$userLogado['nome']?></td>
           <td><?=$userLogado['email']?></td>
           <td>
            <a href="editar.php?id=<?=$userLogado['id']?>">
              <button type="button" class="btn btn-primary">Editar</button> 
            </a>
             

             
           </td>
          </tr>
        </tbody>
      </table>
    </section>














<?php 

    include __DIR__."/includes/footer.php";
?>