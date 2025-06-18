<table class="table table-hover">

    <thead>
        <button><a href="http://localhost/kioficina/public/cliente/adicionar"> <h2>Cadastrar + clientes</h2> </a></button>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Tipo de Cliente</th>
            <th scope="col">cpf cnpj_cliente</th>
            <th scope="col">Data de Nacimento</th>
            <th scope="col">Email</th>
            <th scope="col">Senha</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Endereço</th>
            <th scope="col">Bairro</th>
            <th scope="col">Cidade</th>
            <th scope="col">Status do Cliente</th>

        </tr>
    </thead>
    <tbody>

    <div class="mb-3">
    <td><a href="http://localhost/kioficina/public/cliente/editar/"><button type="button" class="btn btn-success">Editar</button></a></td>
    </div>

        <?php foreach ($cliente as $linha): ?>

            <tr>
                <td>
                    <?php
                    // Caminho da foto
                    $caminhoBase = "http://localhost/kioficina/public/uploads/cliente/";
                    $caminhoFoto = $_SERVER['DOCUMENT_ROOT'] . "/kioficina/public/uploads/" . $linha['foto_cliente'];
                    $urlFoto = $linha['foto_cliente'] != "" && file_exists($caminhoFoto)
                        ? $caminhoBase . htmlspecialchars($linha['foto_cliente'], ENT_QUOTES, 'UTF-8')
                        : $caminhoBase . "maria_oliveira.jpg";
                    ?>
                    <img src="<?php echo $urlFoto; ?>" alt="Foto do Cliente" style="width: 100px; height: auto;">
                   
                <td><?php echo $linha['nome_cliente'] ?></td>
                <td><?php echo $linha['tipo_cliente'] ?></td>
                <td><?php echo $linha['cpf_cnpj_cliente'] ?></td>
                <td><?php echo $linha['data_nasc_cliente'] ?></td>
                <td><?php echo $linha['email_cliente'] ?></td>
                <td><?php echo $linha['senha_cliente'] ?></td>
                <td><?php echo $linha['alt_foto_cliente'] ?></td>
                <td><?php echo $linha['telefone_cliente'] ?></td>
                <td><?php echo $linha['endereco_cliente'] ?></td>
                <td><?php echo $linha['bairro_cliente'] ?></td>
                <td><?php echo $linha['cidade_cliente'] ?></td>
                <td><?php echo $linha['status_cliente'] ?></td>

                <td>
                    <a href="http://localhost/kioficina/public/cliente/listar"> <!-- Listando os nomes telefones e o email que possui no banco de dados  -->
                </td>
                        <img src="http://localhost/kioficina/public/uploads/pencil.png" alt="Editar" style="width: 20px; height: auto;">
                    </a>
                </td>
                <td>
                    <a href="http://localhost/kioficina/public/cliente/desativar">
                        <img src="http://localhost/kioficina/public/uploads/trash.png" alt="Desativar" style="width: 20px; height: auto;">
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>