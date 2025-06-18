<?php 
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(isset($_SESSION['mensagem']) && isset($_SESSION['tipo_msg'])){

        $mensagem = $_SESSION['mensagem'];
        $tipo = $_SESSION['tipo_msg'];

        if($tipo == 'sucesso'){
            echo '<div class="alert alert-success" role="alert">' . $mensagem . '</div>';
        }elseif($tipo == 'erro'){
            echo '<div class="alert alert-danger" role="alert">' . $mensagem . '</div>';
        }

        unset($_SESSION['mensagem']);
        unset($_SESSION['tipo_msg']);
    }
?>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Descrição</th>
            <th scope="col">Preço</th>
            <th scope="col">Tempo</th>
            <th scope="col">Especialidade</th>
            <th scope="col">Editar</th>
            <th scope="col">Desativar</th>
            
        </tr>
    </thead>
    <tbody>
    
    <div class="mb-3">
    <td><a href="http://localhost/kioficina/public/service/adicionar"><button type="button" class="btn btn-success">Adicionar</button></a></td>
    </div>
            
        <?php foreach($listaServico as $linha): ?>

        <tr>
            <th scope="row"><?php echo $linha['id_servico'] ?></th>
            
            <td><img src="<?php
                                        $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/kioficina/public/uploads/" . $linha['foto_galeria'];
                                        if ($linha['foto_galeria'] != "") {
                                            if (file_exists($caminhoArquivo)) {
                                                echo ("http://localhost/kioficina/public/uploads/" . htmlspecialchars($linha['foto_galeria'], ENT_QUOTES, 'UTF-8'));
                                            } else {
                                                echo ("http://localhost/kioficina/public/uploads/galeria/sem-foto-servico.png");
                                            }
                                        } else {

                                            echo ("http://localhost/kioficina/public/uploads/galeria/sem-foto-servico.png");
                                        }


                                        ?>" class="ak-bg" alt="...">

                        </a></td>
            <td><?php echo $linha['nome_servico'] ?></td>
            <td><?php echo $linha['descricao_servico'] ?></td>
            <td><?php echo $linha['preco_base_servico'] ?></td>
            <td><?php echo $linha['tempo_estimado_servico'] ?></td>
            <td><?php echo $linha['id_especialidade'] ?></td>
            <td>
            <a class="btn btn-primary" href="http://localhost/kioficina/public/service/editar/<?php echo $linha['id_servico']; ?>" title="Editar">
               <img src="http://localhost/kioficina/public/uploads/pencil.png" alt="Editar" style="width: 20px; height: auto;">
             </a>
            </td>
            <td>
            <a href="#" class="btn btn-danger" onclick="abrirModalDesativar(<?php echo $linha['id_servico']; ?>)" title="Desativar">
              <img src="http://localhost/kioficina/public/uploads/trash.png" alt="Desativar" style="width: 20px; height: auto;">
                </a>
            </td>
             </tr>
        <?php endforeach; ?>

        

<!-- Modal Desativar servico -->
<div class="modal" tabindex="-1" id="modalDesativar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Desativar Servicos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Tem certeza de que deseja desativar esse serviço?</p>
        <input type="hidden" id="idServicoDesativar" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary"id="btnConfirmar">Desativar</button>
      </div>
    </div>
  </div>
</div>

