<?php

class SobreController extends Controller{

    public function index(){


    $dados = array();
    $dados['titulo'] = 'Sobre nós - kioficina';



  #region Depoimento

        // Instaciar o modelo Servico
        $depoimentoModel = new depoimento();

        // Obter os 3 depoimentos
        $depoimentoAleatorio = $depoimentoModel->getdepoimentoAleatorio();

        // var_dump($depoimentoAleatorio);

        $dados['depoimentos'] = $depoimentoAleatorio;


        //var_dump($dados);

        #endregion




        #region marca

        // Instaciar o modelo marca
        $marcaModel = new marcas();

        // Obter os 3 marcas
        $marcaAleatorio = $marcaModel->getmarca();

        //  var_dump($marcaAleatorio);

        $dados['marcas'] = $marcaAleatorio;


        //var_dump($dados);

        #endregion







        #region funcionarios
        // Instaciar o modelo Servico
        $funcionarioModel = new funcionario();

        // Obter os 3 funcionarios
        $funcionarioAleatorio = $funcionarioModel->getFuncionarioAleatorio(3);

        // var_dump($funcionarioAleatorio);

        $dados['funcionarios'] = $funcionarioAleatorio;


        //var_dump($dados);

        #endregion









    $this->carregarViews('sobre',$dados);

    }
}