<?php

class ServiceController extends Controller
{

    private $servicoModel;
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->servicoModel = new Servico();
    }

    // FRONT-END: carregar a lista de serviços
    public function index()
    {

        $dados = array();
        $dados['titulo'] = 'kioficina';


        $this->carregarViews('services', $dados);
    }

    // FRONT-END: Carregar o detalhe do serviços
    public function detalhe($link)
    {

        $dados = array();
        // var_dump($link);

        $servicoModel = new Servico();

        $detalhesServico = $servicoModel->getServicoPorLink($link);

        if ($detalhesServico) {
            $dados['titulo'] = $detalhesServico['nome_servico'];
            $dados['detalhe'] = $detalhesServico;
            $this->carregarViews("detalhe-servico", $dados);
        } else {
            $dados['titulo'] = 'Servico não localizado';
            $this->carregarViews("erro", $dados);
        }
    }


    // ####################
    // BACK-END - DASHBOARD
    #######################//

    // 1- Método para listar todos os serviços
    public function listar()
    {

        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'funcionario') {


            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['listaServico'] = $this->servicoModel->getServico();
        //var_dump($dados['listarServico']);
        $dados['conteudo'] = 'dash/servico/listar';


        $func = new Funcionario();
        $dadosFunc = $func->buscarFunc($_SESSION['userEmail']);
        //var_dump($dadosFunc);
        $dados['dadosFunc'] = $dadosFunc;

        $this->carregarViews('dash/dashboard', $dados);
    }

    // 2- Método para adicionar serviços
    public function adicionar()
    {

        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            // TBL SERVICO
            $nome_servico                   = filter_input(INPUT_POST, 'nome_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_servico              = filter_input(INPUT_POST, 'descricao_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco_base_servico             = filter_input(INPUT_POST, 'preco_base_servico', FILTER_SANITIZE_NUMBER_FLOAT);
            $tempo_estimado_servico         = filter_input(INPUT_POST, 'tempo_estimado_servico');
            $id_especialidade               = filter_input(INPUT_POST, 'id_especialidade', FILTER_SANITIZE_NUMBER_INT);
            $status_servico                 = filter_input(INPUT_POST, 'status_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $nova_especialidade             = filter_input(INPUT_POST, 'nova_especialidade', FILTER_SANITIZE_SPECIAL_CHARS);



            // TBL ESPECIALIDADE

            // $nome_especialiade


            if ($nome_servico && $descricao_servico && $preco_base_servico !== false) {

                //1 Verificar a especialidade 
                if (empty($id_especialidade) && !empty($nova_especialidade)) {

                    // Criar e obter especialidade

                    $id_especialidade = $this->servicoModel->obterOuCriarEspecialidade($nova_especialidade);
                }

                if (empty($id_especialidade)) {
                    $dados['mensagem'] = "É necesssario escolher ou criar uma especialidade!";
                    $dados['tipo-msg'] = "erro";
                    $this->carregarViews('dash/servico/adicionar', $dados);
                    return;
                }


                // 2 Link do Servico 

                $link_servico = $this->gerarLinkServico($nome_servico);

                // 3 Preparar Dados 

                $dadosServico = array(

                    'nome_servico'              => $nome_servico,
                    'descricao_servico'         => $descricao_servico,
                    'preco_base_servico'        => $preco_base_servico,
                    'tempo_estimado_servico'    => $tempo_estimado_servico,
                    'id_especialidade'          => $id_especialidade, //Esse id_especialidade pode vim da lista ou de uma nova
                    'status_servico'            => $status_servico,
                    'link_servico'              => $link_servico
                );

                // 4 Inserir Servico 


                $id_servico = $this->servicoModel->addServico($dadosServico);


                if ($id_servico) {
                    if (isset($_FILES['foto_galeria']) && $_FILES['foto_galeria']['error'] == 0) {

                        $arquivo = $this->uploadFoto($_FILES['foto_galeria'], $link_servico);


                        if ($arquivo) {
                            //Inserir na galeria

                            $this->servicoModel->addFotoGaleria($id_servico, $arquivo, $nome_servico);
                        } else {
                            //Definir uma mensagem informando que não pode ser salva
                        }
                    }


                    // Mensagem de SUCESSO 
                    $_SESSION['mensagem'] = "Serviço adicionado com Sucesso";
                    $_SESSION['tipo-msg'] = "sucesso";
                    header('Location: http://localhost/kioficina/public/servico/listar');
                    exit;
                } else {
                    $dados['mensagem'] = "Erro ao adicionar o serviço";
                    $dados['tipo-msg'] = "erro";
                }
            } else {
                $dados['mensagem'] = "Preencha todos os campos obrigatórios";
                $dados['tipo-msg'] = "erro";
            }
        }


        // Buscar Funcionarios 
        $func = new Funcionario();
        $dadosFunc = $func->buscarFunc($_SESSION['userEmail']);


        // Buscar Especialidades 
        $especialidades = new Especialidades();
        $dados['especialidades'] = $especialidades->getTodasEspecialidades();

        $dados['conteudo'] = 'dash/servico/adicionar';

        $this->carregarViews('dash/dashboard', $dados);
    }




    // 3- Método para editar
    public function editar($id = null)
    {

        //var_dump($id);

        $dados = array();

        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'funcionario') {
            header('Location:http://localhost/kioficina/public/');
            exit;
        }

        /* se não houve id na URL, redirecionar para página erro (listar) */
        if ($id === null) {
            header('Location:http://localhost/kioficina/public/service/listar');
            exit;
        }

        /* caso seja POST, processar via FORM */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome_servico = filter_input(INPUT_POST, 'nome_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_servico = filter_input(INPUT_POST, 'descricao_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco_base_servico = filter_input(INPUT_POST, 'preco_base_servico', FILTER_SANITIZE_NUMBER_FLOAT);
            $tempo_estimado_servico = filter_input(INPUT_POST, 'tempo_estimado_servico');
            $alt_foto_servico = $nome_servico;
            $id_especialidade = filter_input(INPUT_POST, 'id_especialidade', FILTER_SANITIZE_NUMBER_INT);
            $status_servico = filter_input(INPUT_POST, 'status_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $nova_especialidade = filter_input(INPUT_POST, 'nova_especialidade', FILTER_SANITIZE_SPECIAL_CHARS);


            // $nome_especialidade

            if ($nome_servico && $descricao_servico && $preco_base_servico !== false) {
                if (empty($id_especialidade) && !empty($nova_especialidade)) {
                    $id_especialidade = $this->servicoModel->obterOuCriarEspecialidade($nova_especialidade);
                }

                if (empty($id_especialidade)) {
                    $dados['mensagem'] = 'É necessário escolher ou criar uma especialidade!';
                    $dados['tipo_msg'] = 'erro';
                    // $this->carregarViews('dash/servico/adicionar', $dados);
                    header('location: http://localhost/kioficina/public/service/editar/' . $id_especialidade);
                    exit;
                    // return;
                }

                $link_servico = $this->gerarLinkServico($nome_servico);

                $dadosServico = array(
                    'nome_servico' => $nome_servico,
                    'descricao_servico' => $descricao_servico,
                    'preco_base_servico' => $preco_base_servico,
                    'tempo_estimado_servico' => $tempo_estimado_servico,
                    'alt_foto_servico' => $nome_servico,
                    'id_especialidade' => $id_especialidade,
                    'status_servico' => $status_servico,
                    'link_servico' => $link_servico
                );


                $id_servico = $this->servicoModel->atualizarServico($id, $dadosServico);


                if ($id_servico) {

                    if (isset($_FILES['foto_galeria']) && $_FILES['foto_galeria']['error'] == 0) {
                        $arquivo = $this->uploadFoto($_FILES['foto_galeria'], $link_servico);
                        if ($arquivo) {
                            $this->servicoModel->atualizarFotoGaleria($id, $arquivo, $nome_servico);
                        } else {
                        }
                    }

                    $_SESSION['mensagem'] = 'Serviço atualizado com Sucesso!';
                    $_SESSION['tipo_msg'] = 'sucesso';
                    header('location: http://localhost/kioficina/public/service/listar');
                    exit;
                } else {
                    $dados['mensagem'] = 'Erro ao atualizar o serviço';
                    $dados['tipo_msg'] = 'erro';
                }
            } else {
                $dados['mensagem'] = 'Preencha todos os campos obrigatórios';
                $dados['tipo_msg'] = 'erro';
            }
        }

        $servico = $this->servicoModel->getServicoById($id);
        $dados['servico'] = $servico;
        // var_dump($dados['servico']);

        $func = new Funcionario();
        $dadosFunc = $func->buscarFunc($_SESSION['userEmail']);

        $especialidades = new Especialidades();
        $dados['especialidades'] = $especialidades->getTodasEspecialidades();
        $dados['conteudo'] = 'dash/servico/editar';
        $dados['func'] = $dadosFunc;

        $this->carregarViews('dash/dashboard', $dados);
    }



    // 4- Método para desativar o serviço
    public function desativar($id = null)
    {

        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'funcionario') {
            http_response_code(400);
            echo json_encode(["Sucesso" => false, "Mensagem" => "Acesso Negado."]);
            exit;
        }

        if ($id === null) {
            http_response_code(400);
            echo json_encode(["Sucesso" => false, "Mensagem" => "ID Invalido."]);
            exit;
        }

        $resultado = $this->servicoModel->desativarServico($id);
        header('Content-Type: application/json');
        if ($resultado) {
            $_SESSION['mensagem'] = "Serviço Desativado com SUCESSO!";
            $_SESSION['tipo-msg'] = 'sucesso';

            echo json_encode(['sucesso' => true]);
        } else {
            $_SESSION['mensagem'] = "Falha ao Desativar o Serviço!";
            $_SESSION['tipo-msg'] = 'erro';

            echo json_encode(['sucesso' => false, 'mensagem' => "Falha ao Desativar o Serviço"]);
        }
    }




    private function uploadFoto($file, $link_servico)
    {
        $dir = '../public/uploads/servico/';
        if (!file_exists(($dir))) {
            mkdir($dir, 0755, true);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nome_arquivo = $link_servico . '.' . $ext;

        if (move_uploaded_file($file['tmp_name'], $dir . $nome_arquivo)) {
            //public/uploads/servico/foto.png
            return 'servico/' . $nome_arquivo;
        }

        return false;
    }

    public function gerarLinkServico($nome_servico)
    {
        $semAcento = iconv('UTF-8', 'ASCII//TRANSLIT', $nome_servico);

        /* substitui */
        $link = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '-', $semAcento)));

        // var_dump($link);

        $contador = 1;
        $link_original = $link;
        while ($this->servicoModel->existeEsseServico($link)) {
            $link = $link_original . '-' . $contador;
            // troca-de-bateria-1
            $contador++;
        }

        // var_dump($link);
        return $link;
    }
}
