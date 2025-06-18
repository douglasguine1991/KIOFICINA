<?php

class Cliente extends Model
{


    public function buscarCliente($email)
    {

        $sql = "SELECT * FROM tbl_douglas_cliente WHERE email_cliente = :email AND status_cliente = 'Ativo'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Contar a quantidade de clientes 
    public function getContarCliente()
    {

        $sql = "SELECT COUNT(*) AS total_clientes FROM tbl_douglas_cliente";
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getidCliente()
    {
        $sql = "SELECT * FROM tbl_douglas_cliente ORDER BY id_cliente ASC";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getListarCliente()
    {
        $sql = "SELECT * FROM tbl_douglas_cliente;";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);


        // Adicionar no banco de dados os que for cadastro do cliente 
    }


    public function addCliente($dados)
    {
        $sql = "INSERT INTO tbl_douglas_cliente (
                nome_cliente, 
                tipo_cliente, 
                cpf_cnpj_cliente,  
                data_nasc_cliente, 
                email_cliente, 
                senha_cliente,
                foto_cliente, 
                alt_foto_cliente, 
                telefone_cliente,  
                endereco_cliente, 
                bairro_cliente, 
                cidade_cliente, 
                id_uf, 
                status_cliente
            ) VALUES (
                :nome_cliente, 
                :tipo_cliente, 
                :cpf_cnpj_cliente,  
                :data_nasc_cliente, 
                :email_cliente, 
                :senha_cliente,
                :foto_cliente, 
                :alt_foto_cliente, 
                :telefone_cliente,  
                :endereco_cliente, 
                :bairro_cliente, 
                :cidade_cliente, 
                :id_uf, 
                :status_cliente
            )";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_cliente', $dados['nome_cliente']);
        $stmt->bindValue(':tipo_cliente', $dados['tipo_cliente']);
        $stmt->bindValue(':cpf_cnpj_cliente', $dados['cpf_cnpj_cliente']);
        $stmt->bindValue(':data_nasc_cliente', $dados['data_nasc_cliente']);
        $stmt->bindValue(':email_cliente', $dados['email_cliente']);
        $stmt->bindValue(':senha_cliente', $dados['senha_cliente']);
        $stmt->bindValue(':foto_cliente', $dados['foto_cliente']);
        $stmt->bindValue(':alt_foto_cliente', $dados['nome_cliente']);
        $stmt->bindValue(':telefone_cliente', $dados['telefone_cliente']);
        $stmt->bindValue(':endereco_cliente', $dados['endereco_cliente']);
        $stmt->bindValue(':bairro_cliente', $dados['bairro_cliente']);
        $stmt->bindValue(':cidade_cliente', $dados['cidade_cliente']);
        $stmt->bindValue(':id_uf', $dados['id_uf']);
        $stmt->bindValue(':status_cliente', $dados['status_cliente']);

        $stmt->execute();
    }

    // Método para buscar os dados de Cliente de acordo com o ID
    public function getClienteById($id)
    {
        $sql = "SELECT c.*, e.nome_uf, e.sigla_uf 
                FROM tbl_douglas_cliente c
                INNER JOIN tbl_douglas_estado e ON c.id_uf = e.id_uf
                WHERE c.id_cliente = :id_cliente
                LIMIT 1;";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    // Aqui e para adicionar a foto 
    public function atualizarCliente($id_cliente, $foto)
    {
        $sql = "UPDATE tbl_douglas_cliente SET foto_cliente = :foto_cliente WHERE id_cliente = :id_cliente";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':foto_cliente', $foto);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->execute();
    }

    public function salvarTokenRecuperacao($id, $token, $expira)
    {
        $sql = "UPDATE tbl_douglas_cliente SET token_recuperacao = :token, token_expira = :expira WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->bindValue(':expira', $expira);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function getClientePorToken($token)
    {
        $sql = "SELECT * FROM tbl_douglas_cliente WHERE token_recuperacao = :token";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarSenha($id, $novaSenha)
    {
        $sql = "UPDATE tbl_douglas_cliente SET senha_cliente = :novaSenha WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':novaSenha', $novaSenha);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function limparTokenRecuperacao($id)
    {
        $sql = "UPDATE tbl_douglas_cliente SET token_recuperacao = NULL, token_expira = NULL WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
