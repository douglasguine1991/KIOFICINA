<?php

class HomeController extends Controller
{

    public function index()
    {


        $dados = array();
        $dados['mensagem'] = 'Bem-vindo a Kioficina';

        #region servico
        // Instaciar o modelo Servico
        $servicoModel = new Servico();

        // Obter os 3 servicos
        $servicoAleatorio = $servicoModel->getServicoAleatorio();

        // var_dump($servicoAleatorio);

        $dados['servicos'] = $servicoAleatorio;


        //var_dump($dados);

        #endregion


        #region Depoimento

        // Instaciar o modelo Servico
        $depoimentoModel = new Depoimento();

        // Obter os 3 depoimentos
        $depoimentoAleatorio = $depoimentoModel->getTodosDepoimentos();

        // var_dump($depoimentoAleatorio);

        $dados['depoimentos'] = $depoimentoAleatorio;


        //var_dump($dados);

        #endregion




        #region marca

        // Instaciar o modelo marca
        $marcaModel = new Marcas();

        // Obter os 3 marcas
        $marcaAleatorio = $marcaModel->getmarca();

        //  var_dump($marcaAleatorio);

        $dados['marcas'] = $marcaAleatorio;


        //var_dump($dados);

        #endregion



        #region funcionarios

        // Instaciar o modelo Servico
        $funcionarioModel = new Funcionario();

        // Obter os 3 funcionarios
    

        //var_dump($dados);

        #endregion

        $this->carregarViews('home', $dados);
    }
}
