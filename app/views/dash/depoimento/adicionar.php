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
        input, textarea, select {
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

    <h1>Adicionar Depoimento</h1>
    <form method="POST" action="http://localhost/kioficina/public/depoimento/adicionar" enctype="multipart/form-data">

        <label for="estado_cliente"></label>
    <select id="estado_cliente" name="id_cliente">
      <option value="">-- Selecione --</option>
      <?php foreach ($cliente as $linha): ?>
        <option value="<?php echo $linha['id_cliente']; ?>">
          <?php echo $linha['nome_cliente']; ?>
        </option>
      <?php endforeach; ?>
    </select>

        <label for="descricao_depoimento">Depoimento</label>
        <textarea id="descricao_depoimento" name="descricao_depoimento" rows="5" required></textarea>

        <label for="nota_depoimento">Nota do Depoimento</label>
        <select id="nota_depoimento" name="nota_depoimento" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>

        <label for="datahora_depoimento">Dat e Hor do Depoimento</label>
        <input type="datetime-local" id="datahora_depoimento" name="datahora_depoimento" required>

        <label for="status_depoimento">Status</label>
    <select id="status_depoimento" name="status_depoimento" required>
      <option value="Aprovado">Aprovado</option>
      <option value="Desaprovado">Desaprovado</option>
    </select>

        <button type="submit">Adicionar Depoimento</button>
    </form>

