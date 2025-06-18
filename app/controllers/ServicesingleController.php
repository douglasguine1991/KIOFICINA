<?php

class ServicesingleController extends Controller
{

    public function index()
    {


        $dados = array();
        $dados['titulo'] = 'kioficina';

      
        #endregion


        $this->carregarViews('servicesingle', $dados);
    }

    public function detalhe($link)
    {

        $dados = array();
        var_dump($link);

        $servicoModel = new Servico();

        $detalhesServico = $servicoModel->getServicoPorLink($link);

        if ($detalhesServico) {
           $dados['titulo'] = $detalhesServico['nome_servico'];
           $dados['detalhe'] = $detalhesServico;
           $this->carregarViews("detalhe-servico",$dados);
        } else {
            $dados['titulo'] = 'Servico não localizado';
            $this->carregarViews("erro",$dados);
        }
    }


}
