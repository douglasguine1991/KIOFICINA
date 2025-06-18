<?php

class ErroController extends Controller{

    public function index(){


    $dados = array();
    $dados['titulo'] = 'Erro - Kioficina';

   
    $this->carregarViews('erro',$dados);

    }
}