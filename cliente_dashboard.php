<?php 
session_start();// Inicia ou retoma a sessão do usuário

// Inclui o arquivo de conexão com o banco de dados
require_once "config/conexao.php";

// Inclui o arquivo de conexão com o banco de dados
require_once "config/funcoes.php";

// classe Cliente
require_once "config/Clientes.php";

// Verifica se o usuário NÃO está logado ou se NÃO possui o nível de acesso correto (tipo 2) se for esse o caso o usuario sera mandado para a tela de login
if(!isset($_SESSION['usuario_id']) || $_SESSION["tipo"]!=2){// Redireciona para a página de login
  header("location: login.php");
}

// Cria um objeto da classe cliente
$cliente = new Cliente;

// Busca os dados do cliente usando o ID do usuário logado
if(!$cliente->buscarPorId($_SESSION["usuario_id"])){
  // Se não encontar o cliente, encerra a execução
  die("Cliente não encontrado");
}

// Consulta SQL para buscar as colicitações do cliente
// Também busca os serviços vinculados a cada solicitação
$sql = "SELECT s.id,s.status,s.data_cad, GROUP_CONCAT(se.nome SEPARADOR
'.'AS servicos from solicitacoes s 
INNER JOIN servico_solicitacao ss ON ss.solicitacoes_id 
WHERE s.cliente_id=?
GROUP BY s.id, s.status, s.data_cad
        ORDER BY s.data_cad DESC";

// Prepara a consulta
$stmt = $pdo->prepare($sql);

// Execute
$stmt->execute([$cliente["id"]]);

// Busca todas as colicitações encontradas no banco
$solicitacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

include "include/header.php";
include "include/menu.php";
?>


<main class="container mt-5">
  <h2>Bem-vindo, <strong><?=  $_SESSION['nome'] ?></strong></h2>
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
            <!-- Percorre todas as solicitações retornadas do banco -->
             <?php foreach($solicitacoes as $s):?>
              <tr>

              <!-- Exibe o ID da solicitação -->
               <td><?= $s["id"] ?>?></td>

              </tr>
        
          <td>
          
          // Divide a lista de serviços em um array
          <?php $lista = explode(", ", $s["servicos"]);
          // Pecorre cada serviço da solicitação
          foreach($lista as $nomeServico){
            
            // htmlspecialchars evita execução de código HTML/JS malicioso
            echo '<span class="badge bg-primary me-1 mb-1">'.
            htmlspecialchars($nomeServico).'</span>';
          }


          ?>

          </td>

          <!-- Exibe o status em formatos de texto usando função -->
            <?php statusTexto($s["status"])?>

          <td>

            <!-- Formata a data para o padrão brasileiro -->
             <?= date("d/m/Y H:i", strtotime($s["data_cad"])) ?>?>

          </td>

          <td>

            <!-- Link para ver os detalhes da solicitação -->
             <a href="cliente_detalhes.php?id=?= $s["id"] ?>"</a>

          </td>


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
