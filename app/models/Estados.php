<?php

class Estados extends Model{

    public function getListarEstados(){
        $sql = "SELECT * FROM tbl_douglas_estado ORDER BY nome_uf ASC";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}