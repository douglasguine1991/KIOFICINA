<?php

class Marcas extends Model
{



    public function getMarca()
    {


        $sql = "select * from tbl_douglas_marca;";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
