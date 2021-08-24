<?php

  $mensagem = '';
  if(isset($_GET['status'])) {
    switch ($_GET['status']) {
      case 'success':
        $mensagem = '<div class="alert alert-success">Ação executada com sucesso</div>';
        break;

        case 'error':
          $mensagem = '<div class="alert alert-danger">Ação não executada</div>';
          break;
    }
  }

  $resultados = '';
  foreach($vagas as $vaga) {
    $resultados .= '<tr>
                      <td>'.$vaga->id.'</td>
                      <td>'.$vaga->titulo.'</td>
                      <td>'.$vaga->descricao.'</td>
                      <td>'.($vaga->ativo == 's'? 'Ativo' : 'Inativo').'</td>
                      <td>'.date('d/m/Y à\s H:i:s',strtotime($vaga->data)).'</td>
                      <td>
                        <a class="btn btn-primary" href="editar.php?id='.$vaga->id.'">
                          Editar
                        </a>
                        <a class="btn btn-danger" href="excluir.php?id='.$vaga->id.'">
                          Excluir
                        </a>
                      </td>
                    </tr>';
  }

  $resultados = strlen($resultados) ? $resultados : '<tr>
                                                      <td colspan="6" class="text-center">Nenhuma vaga encontrada.<td>
                                                    </tr>';

?>

<main>

<?=$mensagem?>

  <section>
    <a class="btn btn-success" href="cadastrar.php">
      Cadastrar Vaga
    </a>
  </section>

  <section>
    <table class="table bg-light mt-3">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Descrição</th>
          <th>Status</th>
          <th>Data</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?=$resultados?>
      </tbody>

    </table>
  </section>

</main>