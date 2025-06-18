<?php

class Veiculo extends Model{

    public function getVeiculoIdCliente($id){
        $sql = "SELECT v.*, m.* FROM tbl_douglas_veiculo v INNER JOIN tbl_douglas_modelo m ON v.id_modelo = m.id_modelo WHERE v.id_cliente = :id_cliente";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function servicoExecutadoPorIdCliente($id)
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
}