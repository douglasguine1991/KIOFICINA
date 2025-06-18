<?php


class ClienteController extends Controller
{
   private $clienteModel;
   public function __construct()
   {

      if (session_status() == PHP_SESSION_NONE) {
         session_start();
      }

      // Instaciar o modelo Servico
      $this->clienteModel = new Cliente();
   }
   
   public function listar()
   {
      if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'funcionario') {
         header('Location:' . BASE_URL);
         exit;
      }
      $dados = array();
      $dados['conteudo'] = 'dash/cliente/listar';

      $func = new Funcionario();
      $dadosFunc = $func->buscarFunc($_SESSION['userEmail']);
      $dados['func'] = $dadosFunc;

      $cliente = new Cliente();
      $dadosCliente = $cliente->getListarCliente();
      $dados['conteudo'] = 'dash/cliente/listar';
      $dados['cliente'] = $dadosCliente;

      $this->carregarViews('dash/dashboard', $dados);
   }


   public function adicionar()
   {

      if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'funcionario') {
         header('Location:' . BASE_URL);
         exit;
      }


      $dados = array();


      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

         // TBL_Cliente
         // var_dump("chegue aqui");


         $nome_cliente       = filter_input(INPUT_POST, 'nome_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
         $tipo_cliente       = filter_input(INPUT_POST, 'tipo_cliente', FILTER_SANITIZE_NUMBER_FLOAT);
         $cpf_cnpj_cliente   = filter_input(INPUT_POST, 'cpf_cnpj_cliente', FILTER_SANITIZE_NUMBER_FLOAT);
         $data_nasc_cliente  = filter_input(INPUT_POST, 'data_nasc_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
         $email_cliente      = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
         $senha_cliente      = filter_input(INPUT_POST, 'senha_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
         $foto_cliente       = filter_input(INPUT_POST, 'foto_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
         $alt_foto_cliente   = filter_input(INPUT_POST, 'alt_foto_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
         $telefone_cliente   = filter_input(INPUT_POST, 'telefone_cliente', FILTER_SANITIZE_NUMBER_FLOAT);
         $endereco_cliente   = filter_input(INPUT_POST, 'endereco_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
         $bairro_cliente     = filter_input(INPUT_POST, 'bairro_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
         $cidade_cliente     = filter_input(INPUT_POST, 'cidade_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
         $id_uf              = filter_input(INPUT_POST, 'id_uf', FILTER_SANITIZE_NUMBER_INT);
         $status_cliente     = filter_input(INPUT_POST, 'status_cliente', FILTER_SANITIZE_SPECIAL_CHARS);

         
         if ($nome_cliente && $telefone_cliente && $email_cliente) {



            $dadosCliente = array(
               'nome_cliente'        => $nome_cliente,
               'tipo_cliente'        => $tipo_cliente,
               'cpf_cnpj_cliente'    => $cpf_cnpj_cliente,
               'data_nasc_cliente'   => $data_nasc_cliente,
               'email_cliente'       => $email_cliente,
               'senha_cliente'       => $senha_cliente,
               'foto_cliente'        => $nome_cliente,
               'alt_foto_cliente'    => $alt_foto_cliente,
               'telefone_cliente'    => $telefone_cliente,
               'endereco_cliente'    => $endereco_cliente,
               'bairro_cliente'      => $bairro_cliente,
               'cidade_cliente'      => $cidade_cliente,
               'id_uf'               => $id_uf,
               'status_cliente'      => $status_cliente,
            );

            $id_cliente = $this->clienteModel->addCliente($dadosCliente);

            if ($id_cliente) {
               if (isset($_FILES['foto_cliente']) && $_FILES['foto_cliente']['error'] === 0) {
                  $foto = $this->uploadFoto($_FILES['foto_cliente']);
               }
            }
         }
      }

      $dados = array();
      $func = new Funcionario();
      $dadosFunc = $func->buscarFunc($_SESSION['userEmail']);

      $estados = new Estados();
      $dados['estados'] = $estados->getListarEstados();

      $dados['listaCliente'] = $this->clienteModel->getListarCliente();

      $dados['conteudo'] = 'dash/cliente/adicionar';
      $dados['func'] = $dadosFunc;

      $this->carregarViews('dash/dashboard', $dados);
   }

   


   // Método Editar
   public function editar($id = null)
   {
       if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'funcionario') {
           header('Location:' . BASE_URL);
           exit;
       }

       if ($id === null) {
           header('Location: http://localhost/kioficina/public/cliente/listar');
           exit;
       }

       $dados = array();

       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
           $nome_cliente         = filter_input(INPUT_POST, 'nome_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
           $tipo_cliente         = filter_input(INPUT_POST, 'tipo_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
           $cpf_cnpj_cliente     = filter_input(INPUT_POST, 'cpf_cnpj_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
           $data_nasc_cliente    = filter_input(INPUT_POST, 'data_nasc_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
           $email_cliente        = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);
           $senha_cliente        = filter_input(INPUT_POST, 'senha_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
           $telefone_cliente     = filter_input(INPUT_POST, 'telefone_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
           $endereco_cliente     = filter_input(INPUT_POST, 'endereco_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
           $bairro_cliente       = filter_input(INPUT_POST, 'bairro_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
           $cidade_cliente       = filter_input(INPUT_POST, 'cidade_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
           $id_uf                = filter_input(INPUT_POST, 'id_uf', FILTER_SANITIZE_NUMBER_INT);
           $status_cliente       = filter_input(INPUT_POST, 'status_cliente', FILTER_SANITIZE_SPECIAL_CHARS);

           // Verifica e faz upload da foto
           if (isset($_FILES['foto_cliente']) && $_FILES['foto_cliente']['error'] == 0) {
               $foto_cliente = $this->uploadFoto($_FILES['foto_cliente']);
               $alt_foto_cliente = pathinfo($_FILES['foto_cliente']['name'], PATHINFO_FILENAME);
           } else {
               $foto_cliente = null;
               $alt_foto_cliente = null;
           }

           // Verifica se os campos obrigatórios estão preenchidos
           if ($nome_cliente && $email_cliente && !empty($telefone_cliente)) {
               $dadosCliente = array(
                   'nome_cliente'       => $nome_cliente,
                   'tipo_cliente'       => $tipo_cliente,
                   'cpf_cnpj_cliente'   => $cpf_cnpj_cliente,
                   'data_nasc_cliente'  => $data_nasc_cliente,
                   'email_cliente'      => $email_cliente,
                   'senha_cliente'      => password_hash($senha_cliente, PASSWORD_BCRYPT),
                   'telefone_cliente'   => $telefone_cliente,
                   'endereco_cliente'   => $endereco_cliente,
                   'bairro_cliente'     => $bairro_cliente,
                   'cidade_cliente'     => $cidade_cliente,
                   'id_uf'              => $id_uf,
                   'status_cliente'     => $status_cliente,
               );

               // Atualiza a foto apenas se uma nova foi enviada
               if ($foto_cliente) {
                   $dadosCliente['foto_cliente'] = $foto_cliente;
                   $dadosCliente['alt_foto_cliente'] = $alt_foto_cliente;
               }

               // Atualiza os dados no banco
               $atualizado = $this->clienteModel->atualizarCliente($id, $dadosCliente);

               if ($atualizado) {
                   $_SESSION['mensagem'] = "Cliente atualizado com sucesso!";
                   $_SESSION['tipo-msg'] = "Sucesso";
                   header('location: http://localhost/kioficina/public/cliente/listar');
                   exit;
               } else {
                   $dados['mensagem'] = "Erro ao atualizar o cliente";
                   $dados['tipo-msg'] = "Erro";
               }
           } else {
               $dados['mensagem'] = "Preencha todos os campos obrigatórios!";
               $dados['tipo-msg'] = "Erro";
           }
       }

       // Buscar cliente existente
       $cliente = $this->clienteModel->getClienteById($id);
       $dados['cliente'] = $cliente;

       // Buscar Funcionário
       $func = new Funcionario();
       $dadosFunc = $func->buscarFunc($_SESSION['userEmail']);

       // Buscar Estados
       $estado = new Estados();
       $dados['estados'] = $estado->getListarEstados();

       $dados['conteudo'] = 'dash/cliente/editar';
       $dados['func'] = $dadosFunc;

       $this->carregarViews('dash/dashboard', $dados);
   }


// Upload Foto

       private function uploadFoto($file)
       {
          $dir = '../public/uploads/';
    
          if (!file_exists($dir)) {
             mkdir($dir, 0755, true);
          }
    
          $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
          $nome_arquivo = 'cliente/' . uniqid() . '.' . $ext;
    
    
          if (move_uploaded_file($file['tmp_name'], $dir . $nome_arquivo)) {
             return $nome_arquivo;
          }
          return false;
       }



} 
