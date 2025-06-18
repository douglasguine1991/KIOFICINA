<?php

class Depoimentocliente extends Model{

public function getDepoimentoCliente(){     
    $sql = "SELECT * FROM tbl_douglas_cliente ORDER BY nome_cliente ASC";
    $stmt = $this->db->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

 }
}