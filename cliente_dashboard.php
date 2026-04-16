<?php 

session_start();// Inicia ou retoma a sessão do usuário

/* Verifica se o usuário NÃO está logado ou se NÃO
possui o nível de acesso correto (tipo 2) se for esse
o caso o usuario sera mandado para a tela de login */
if(!isset($_SESSION['usuario_id'])|| $_SESSION["tipo"]!=2)// Redireciona para a página de login
  header("location: login.php");

  include "include/header.php";
  include "include/menu.php";

?>


<main class="container mt-5">
  <h2>Bem-vindo,</h2>
  <p><a href="logout.php" class="btn btn-danger btn-sm">Sair</a></p>
  <a href="cliente_perfil.php" class="btn btn-warning btn-sm">Meu Perfil</a>
  <h4 class="mt-4">Minhas Solicitações</h4>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
   
          <td></td>
         
          <td></td>
          <td></td>
          <td>
            <a href="cliente_detalhes.php?id=" class="btn btn-primary btn-sm">Detalhes</a>
          </td>
        </tr>
    </tbody>
  </table>
</main>

<?php 

  include "include/footer.php";

?>

