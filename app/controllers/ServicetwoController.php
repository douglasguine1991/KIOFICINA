<?php

class ServicetwoController extends Controller
{

    public function index()
    {


        $dados = array();
        $dados['titulo'] = 'kioficina';

        #region servico
        // Instaciar o modelo Servico
        $servicoModel = new Servico();

      
        $servicoCompleto = $servicoModel->getServico();

        // var_dump( $servicoCompleto);

        $dados['servicos'] =  $servicoCompleto;

        #endregion


        $this->carregarViews('servicestwo', $dados);
    }
}
