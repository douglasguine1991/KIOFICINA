<table class="table table-hover">

    <thead>
        <button><a href="http://localhost/kioficina/public/depoimento/adicionar"> Adicionar Depoimento</a></button>
        <tr>

            <th scope="col"></th>
            <th scope="col">Nome</th>
            <th scope="col">Depoimento</th>
            <th scope="col">Hora do Depoimento</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($depoimento as $linha): ?>

            <tr>
                <td> <!-- Listando os nome telefones e o email que posui no banco de dados  -->
                <td><?php echo $linha['nome_cliente'] ?></td>
                <td><?php echo $linha['descricao_depoimento'] ?></td>
                <td><?php echo $linha['datahora_depoimento'] ?></td>
                <td>
                    <a href="http://localhost/kioficina/public/depoimento/listar"> <!-- Listando os nome telefones e o email que posui no banco de dados  -->
                </td>
                <img src="http://localhost/kioficina/public/uploads/pencil.png" alt="Editar" style="width: 20px; height: auto;">
                </a>
                </td>
                <td>
                    <a href="http://localhost/kioficina/public/depoimento/desativar">
                        <img src="http://localhost/kioficina/public/uploads/trash.png" alt="Desativar" style="width: 20px; height: auto;">
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>