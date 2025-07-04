<?php

class Servico extends Model
{


    //Método para pegar somente 3 servicos de forma aleatoria

    public function getServicoAleatorio($limite = 3)
    {


        $sql = "select s.id_servico, s.nome_servico, s.descricao_servico, g.foto_galeria, g.alt_galeria from tbl_douglas_servico as s
        inner join tbl_douglas_galeria as g 
        on g.id_servico = s.id_servico
        where status_servico = 'Ativo'   order by rand()limit :limite";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getServico()
    {

        $sql = "SELECT s.*, g.foto_galeria, g.alt_galeria, e.nome_especialidade from tbl_douglas_servico as s
                inner join tbl_douglas_galeria as g 
                on g.id_servico = s.id_servico
                inner join tbl_douglas_especialidade as e
                on s.id_especialidade = e.id_especialidade
                where status_servico = 'Ativo' AND g.status_galeria = 'Ativo'";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    //metodo para carregar servico pelo link

    public function getServicoPorLink($link)
    {

        $sql = " select tbl_douglas_servico.*,tbl_douglas_galeria.*from tbl_douglas_servico inner join tbl_douglas_galeria on tbl_douglas_servico.id_servico = tbl_douglas_galeria.id_galeria where status_servico = 'Ativo' and link_servico = :link;";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':link', $link);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     //Método para Pegar 4 Especialidade de servicos de forma aleatória
     public function getEspecialidadeAleatorio($limite = 4)
     {
  
         $sql = "SELECT * FROM tbl_douglas_especialidade ORDER BY RAND() LIMIT :limite";
         $stmt = $this->db->prepare($sql);
         $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
  
  
     // Método para o DASHBOARD - Listar todos os serviços com galeria e especialidade
    public function getListarServicos()
    {

        $sql = "SELECT 
                    srv.*,
                    gal.foto_galeria,
                    esp.nome_especialidade
                FROM 
                    tbl_douglas_servico AS srv
                INNER JOIN 
                    tbl_douglas_galeria AS gal ON srv.id_servico = gal.id_servico
                INNER JOIN 
                    tbl_douglas_especialidade AS esp ON srv.id_especialidade = esp.id_especialidade
                WHERE 
                    srv.status_servico = 'ativo'";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // 5 METODO DASHBOARD ADICIONAR SERVICO 

    public function addServico($dados)
    {

        $sql = "INSERT INTO tbl_douglas_servico (  
        nome_servico,
        descricao_servico,
        preco_base_servico,
        tempo_estimado_servico,
        id_especialidade,
        status_servico,
        link_servico) 

        VALUES(
        :nome_servico,
        :descricao_servico,
        :preco_base_servico,
        :tempo_estimado_servico,
        :id_especialidade,
        :status_servico,
        :link_servico
        
        )";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_servico', $dados['nome_servico']);
        $stmt->bindValue(':descricao_servico', $dados['descricao_servico']);
        $stmt->bindValue(':preco_base_servico', $dados['preco_base_servico']);
        $stmt->bindValue(':tempo_estimado_servico', $dados['tempo_estimado_servico']);
        $stmt->bindValue(':id_especialidade', $dados['id_especialidade']);
        $stmt->bindValue(':status_servico', $dados['status_servico']);
        $stmt->bindValue(':link_servico', $dados['link_servico']);

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    
     // Atualizar servico 
     public function atualizarServico($id, $dados)
     {
         $sql = "UPDATE tbl_douglas_servico 
                 SET nome_servico = :nome_servico, 
                     descricao_servico = :descricao_servico, 
                     preco_base_servico = :preco_base_servico, 
                     tempo_estimado_servico = :tempo_estimado_servico, 
                     id_especialidade = :id_especialidade, 
                     status_servico = :status_servico, 
                     link_servico = :link_servico
                 WHERE id_servico = :id_servico";
 
 
         $stmt = $this->db->prepare($sql);
         $stmt->bindValue(':nome_servico', $dados['nome_servico'], PDO::PARAM_STR);
         $stmt->bindValue(':descricao_servico', $dados['descricao_servico'], PDO::PARAM_STR);
         $stmt->bindValue(':preco_base_servico', $dados['preco_base_servico'], PDO::PARAM_STR);
         $stmt->bindValue(':tempo_estimado_servico', $dados['tempo_estimado_servico'], PDO::PARAM_STR);
         $stmt->bindValue(':id_especialidade', $dados['id_especialidade'], PDO::PARAM_INT);
         $stmt->bindValue(':status_servico', $dados['status_servico'], PDO::PARAM_STR);
         $stmt->bindValue(':link_servico', $dados['link_servico'], PDO::PARAM_STR);
         $stmt->bindValue(':id_servico', $id, PDO::PARAM_INT);
 
         $resultado = $stmt->execute();
         return $resultado;
     }
 
 
     // Atualizar foto galeria 
 
     public function atualizarFotoGaleria($id, $arquivo, $nome_servico)
     {
         // Verifica se já existe uma entrada na galeria para o serviço
         $sqlVerificar = "SELECT id_galeria FROM tbl_douglas_galeria WHERE id_servico = :id";
         $stmtVerificar = $this->db->prepare($sqlVerificar);
         $stmtVerificar->bindValue(':id', $id, PDO::PARAM_INT);
         $stmtVerificar->execute();
         $galeria = $stmtVerificar->fetch(PDO::FETCH_ASSOC);
     
         if ($galeria) {

             // Atualiza se já existir
             $sql = "UPDATE tbl_douglas_galeria SET 
                         foto_galeria = :foto_galeria,
                         alt_galeria = :alt_galeria,
                         status_galeria = :status_galeria
                     WHERE id_galeria = :id_galeria";  // Remove a vírgula extra!
     
             $stmt = $this->db->prepare($sql);
             $stmt->bindValue(':foto_galeria', $arquivo);
             $stmt->bindValue(':alt_galeria', $nome_servico);
             $stmt->bindValue(':status_galeria', 'Ativo');
             $stmt->bindValue(':id_galeria', $galeria['id_galeria']);  // Corrigido!
     
             return $stmt->execute();
         } else {

             // Insere se não existir
             $sql = "INSERT INTO tbl_douglas_galeria (
                         foto_galeria, 
                         alt_galeria, 
                         status_galeria, 
                         id_servico
                     ) VALUES (
                         :foto_galeria, 
                         :alt_galeria, 
                         :status_galeria, 
                         :id_servico
                     )";
     
             $stmt = $this->db->prepare($sql);
             $stmt->bindValue(':foto_galeria', $arquivo);
             $stmt->bindValue(':alt_galeria', $nome_servico);
             $stmt->bindValue(':status_galeria', 'Ativo');  // Corrigido (adicionado ":")
             $stmt->bindValue(':id_servico', $id);
     
             return $stmt->execute();
         }
     }
     


    // 6 Método para add FOTO GALERIA 

    public function addFotoGaleria($id_servico, $arquivo, $nome_servico)
    {
        $sql = "INSERT INTO tbl_douglas_galeria (foto_galeria,
                                         alt_galeria,
                                         status_galeria,
                                         id_servico)
                                         
                                         VALUES (:foto_galeria,
                                                 :alt_galeria,
                                                 :status_galeria,
                                                 :id_servico)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':foto_galeria', $arquivo);
        $stmt->bindValue(':alt_galeria', $nome_servico);
        $stmt->bindValue('status_galeria', 'Ativo');
        $stmt->bindValue(':id_servico', $id_servico);

        return $stmt->execute();
    }

    // 7 Verifica o link 

    public function existeEsseServico($link)
    {

        $sql = " SELECT count(*) AS total FROM tbl_douglas_servico WHERE link_servico =:link ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':link', $link);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado['total'] > 0;
    }

    public function getServicoById($id)
    {
        $sql = "SELECT s.*, g.foto_galeria, e.nome_especialidade FROM tbl_douglas_servico s
        LEFT JOIN tbl_douglas_galeria g ON s.id_servico = g.id_servico
        INNER JOIN tbl_douglas_especialidade e ON s.id_especialidade = e.id_especialidade
        WHERE s.id_servico = :id_servico limit 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_servico', $id, PDO::PARAM_INT);
        $stmt->execute();
 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obterOuCriarEspecialidade($nome)
    {
        $sql = 'INSERT INTO tbl_douglas_especialidade (nome_especialidade)
                VALUES (:nome)';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    

    /** Desativar Servico */

   public function desativarServico($id){

    $sql = "UPDATE tbl_douglas_servico SET status_servico = 'inativo' WHERE id_servico = :id_servico";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id_servico', $id, PDO::PARAM_INT);
    return $stmt->execute();

    
}

}
