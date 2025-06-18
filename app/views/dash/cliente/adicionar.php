<style>
  body {
    font-family: Arial, sans-serif;
    margin: 20px;
  }

  form {
    max-width: 400px;
    margin: auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  input,
  textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  button {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button:hover {
    background-color: #0056b3;
  }
</style>
</head>

<body>
  <h1>Adicionar Cliente</h1>
  <form method="POST" action="http://localhost/kioficina/public/cliente/adicionar" enctype="multipart/form-data">
    <label for="nome_cliente">Nome</label>
    <input type="text" id="nome_cliente" name="nome_cliente" required>

    <label for="tipo_cliente">Tipo de Cliente</label>

    <select id="tipo_cliente" name="tipo_cliente" required>
      <option value="ativo">Pessoa Fisica</option>
      <option value="inativo">Pessoa Jurítica</option>
    </select>
    <br>
    <br>
    <label for="cpf_cnpj_cliente">CPF/CNPJ</label>
    <input type="text" id="cpf_cnpj_cliente" name="cpf_cnpj_cliente" required>

    <label for="data_nasc_cliente">Data de Nascimento</label>
    <input type="date" id="data_nasc_cliente" name="data_nasc_cliente" required>

    <label for="email_cliente">Email</label>
    <input type="email" id="email_cliente" name="email_cliente" required>

    <label for="senha_cliente">Senha</label>
    <input type="password" id="senha_cliente" name="senha_cliente" required>

    <img id="preview-img" style="cursor:pointer; height:250px;width: 250px;" title="Clique na imagem para selecionar uma foto do cliente" src="http://localhost/kioficina/public/uploads/cliente/sem-foto-cliente.png" alt="">
    <input type="file" name="foto_cliente" id="foto_cliente" style="display: none;" accept="image/*">


    <label for="alt_foto_cliente">Descrição da Foto</label>
    <input type="text" id="alt_foto_cliente" name="alt_foto_cliente">

    <label for="telefone_cliente">Telefone</label>
    <input type="tel" id="telefone_cliente" name="telefone_cliente" required>

    <label for="endereco_cliente">Endereço</label>
    <input type="text" id="endereco_cliente" name="endereco_cliente" required>

    <label for="bairro_cliente">Bairro</label>
    <input type="text" id="bairro_cliente" name="bairro_cliente" required>

    <label for="cidade_cliente">Cidade</label>
    <input type="text" id="cidade_cliente" name="cidade_cliente" required>

    <label for="estado_cliente">Estados</label>
    <select id="estado_cliente" name="id_uf">
      <option value="">-- Selecione --</option>
      <?php foreach ($estados as $linha): ?>
        <option value="<?php echo $linha['id_uf']; ?>">
          <?php echo $linha['nome_uf']; ?>
        </option>
      <?php endforeach; ?>
    </select>

    <br>
    <br><br>

    <label for="status_cliente">Status</label>
    <select id="status_cliente" name="status_cliente">
      <option value="ativo">Ativo</option>
      <option value="inativo">Inativo</option>
    </select>
    <br>
    <br>

    <button type="submit">Adicionar</button>
  </form>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const visualizarImg = document.getElementById('preview-img');
      const arquivo = document.getElementById('foto_cliente');

      visualizarImg.addEventListener('click', function() {
        arquivo.click()
      })

      arquivo.addEventListener('change', function() {
        if (arquivo.files && arquivo.files[0]) {
          let render = new FileReader();
          render.onload = function(e) {
            visualizarImg.src = e.target.result
          }

          render.readAsDataURL(arquivo.files[0]);

        }

      })
    })
  </script>