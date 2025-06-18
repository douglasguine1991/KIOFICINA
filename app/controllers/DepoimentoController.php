<?php


class DepoimentoController extends Controller
{
    private $depoimentoModel;
    public function __construct()
    {
 
       if (session_status() == PHP_SESSION_NONE) {
          session_start();
       }
 
       // Instaciar o modelo Servico
       $this->depoimentoModel = new Depoimento();
    }
    public function listar()
    {
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'funcionario') {
            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['conteudo'] = 'dash/depoimento/listar';

        $func = new Funcionario();
        $dadosFunc = $func->buscarFunc($_SESSION['userEmail']);
        $dados['func'] = $dadosFunc;

        $depoimento = new Depoimento();
        $dadosdepoimento = $depoimento->getTodosDepoimentos();
        $dados['conteudo'] = 'dash/depoimento/listar';
        $dados['depoimento'] = $dadosdepoimento;

        $this->carregarViews('dash/dashboard', $dados);
    

    }
    public function adicionar(){

        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }


        $dados = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_cliente              = filter_input(INPUT_POST, 'id_cliente',           FILTER_SANITIZE_NUMBER_INT);
            $descricao_depoimento    = filter_input(INPUT_POST, 'descricao_depoimento', FILTER_SANITIZE_SPECIAL_CHARS);
            $nota_depoimento         = filter_input(INPUT_POST, 'nota_depoimento',      FILTER_SANITIZE_SPECIAL_CHARS);
            $datahora_depoimento     = filter_input(INPUT_POST, 'datahora_depoimento',  FILTER_SANITIZE_SPECIAL_CHARS);
            $status_depoimento       = filter_input(INPUT_POST, 'status_depoimento',    FILTER_SANITIZE_SPECIAL_CHARS);

            if ($descricao_depoimento && $nota_depoimento && $datahora_depoimento) {
                


            $dadosdepoimento = array(
                'id_cliente'                     => $id_cliente,  
                'descricao_depoimento'           => $descricao_depoimento,
                'nota_depoimento'                => $nota_depoimento,
                'datahora_depoimento'            => $datahora_depoimento,
                'status_depoimento'              => $status_depoimento
            );

            $id_cliente = $this->depoimentoModel->addDepoimento($dadosdepoimento);
        }

       }
       
        $func = new Funcionario();
        $dadosFunc = $func->buscarFunc($_SESSION['userEmail']);

        $depoimentoModel = new Cliente();
        $cliente = $depoimentoModel->getListarCliente();
        $dados['clientes'] = $cliente;

        $dados['conteudo'] = 'dash/depoimento/adicionar';
        $dados['func'] = $dadosFunc;

        $this->carregarViews('dash/dashboard', $dados);

    }
    
}