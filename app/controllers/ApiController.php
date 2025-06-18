<?php

class ApiController extends Controller {

private $servicoModel;
private $clienteModel;
private $veiculoModel;
private $agendamentoModel;

public function __construct()
{

    $this->servicoModel = new Servico();
    $this->clienteModel = new Cliente();
    $this->veiculoModel = new Veiculo();
    $this->agendamentoModel = new Agendamentos();
}

// Listar Serviços - Api
public function ListarServico(){

$servico = $this->servicoModel->getServico();

if(empty($servico)){
    http_response_code(404);
    echo json_encode(["mensagem" => "Nenhum registro encontrado"]);
    exit;
}

echo json_encode($servico);


}

/** CLIENTE API */

//** LOGIN */

public function login(){

    $email = $_GET('email_cliente') ?? null;
    $senha = $_GET('senha_cliente') ?? null;

    if(!$email || !$senha){

        http_response_code(400);
        echo json_encode(['erro' => 'E-mail ou senha são obrigatórios'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
    }

    $cliente = $this->clienteModel->buscarCliente($email);

    if(!$cliente || $senha != $cliente["senha_cliente"]){

        http_response_code(401);
        echo json_encode(['erro' => 'E-mail e senha inválido'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
    }

    //Gerar um token

    $token = base64_encode(json_encode(['id' => $cliente['id_cliente'], 'email' => $cliente['email_cliente']]));

    

}

// Retornar os dados do cliente pelo ID

public function cliente($id){
    $cliente = $this->clienteModel->getClienteById($id);

    if(!$cliente){
        http_response_code(404);
        echo json_encode(["erro" => "Cliente não encontrado"]);
        exit;
    }

    echo json_encode($cliente);

}

// Atualizar dados do cliente
public function atualizarCliente($id){

    $dados = json_decode(file_get_contents('php://input'), true);

    var_dump($dados);

    /** Obter os dados do cliente */

$nome_cliente = filter_input(INPUT_POST, 'nome_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
$tipo_cliente  = filter_input(INPUT_POST, 'tipo_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
$cpf_cnpj_cliente  = filter_input(INPUT_POST, 'cpf_cnpj_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
$data_nasc_cliente  = filter_input(INPUT_POST, 'data_nasc_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
$email_cliente  = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
$senha_cliente  = filter_input(INPUT_POST, 'senha_cliente', FILTER_SANITIZE_SPECIAL_CHARS);

//$foto_cliente 

$alt_foto_cliente = $nome_cliente;
$telefone_cliente  = filter_input(INPUT_POST, 'telefone_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
$endereco_cliente  = filter_input(INPUT_POST, 'endereco_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
$bairro_cliente  = filter_input(INPUT_POST, 'bairro_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
$cidade_cliente  = filter_input(INPUT_POST, 'cidade_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
$id_uf           = filter_input(INPUT_POST, 'id_uf', FILTER_SANITIZE_SPECIAL_CHARS);
$status_cliente  = filter_input(INPUT_POST, 'status_cliente', FILTER_SANITIZE_SPECIAL_CHARS);

//id_cliente

//Validação dos dados
if(!$nome_cliente || !$email_cliente || !$cpf_cnpj_cliente){
http_response_code(400);
echo json_encode(["erro" => "Todos os campos são obrigatórios"]);
exit;

}

// Preparar os dados
$dados = [

    'nome_cliente'              =>   $nome_cliente,
    'tipo_cliente'              =>   $tipo_cliente,
    'cpf_cnpj_cliente'          =>   $cpf_cnpj_cliente,
    'data_nasc_cliente'         =>   $data_nasc_cliente,
    'email_cliente'             =>   $email_cliente,
    'senha_cliente'             =>   $senha_cliente,
    'alt_foto_cliente'          =>   $nome_cliente,
    'telefone_cliente'          =>   $telefone_cliente,
    'enderecocliente'           =>   $endereco_cliente,
    'bairro_cliente'            =>   $bairro_cliente,
    'cidade_cliente'            =>   $cidade_cliente,
    'id_uf'                     =>   $id_uf,
    'status_cliente'            =>   $status_cliente


];

$cliente = $this->clienteModel->atualizarCliente($id, $dados);

if($cliente){

    echo json_encode(['mensagem' => 'Cliente atualizado com sucesso']);

}

}

// Retornar os dados do Veiculo do Cliente pelo ID do CLIENTE
public function veiculo($id){

    $veiculo = $this->veiculoModel->getVeiculoIdCliente($id);
    
    if(!$veiculo){
        http_response_code(404);
        echo json_encode(["erro" => "Veiculo não encontrado"]);
        exit;
    }

    echo json_encode($veiculo);

    
}

// Retornar os Serviços executados no(s) veiculo(s) do cliente pelo ID
public function servicoExecutadoPorCliente($id){

    $executado = $this->veiculoModel->servicoExecutadoPorIdCliente($id);


    if(!$executado){
        http_response_code(404);
        echo json_encode(["erro" => "Serviço(s) não encontrado"]);
        exit;
    }

    echo json_encode($executado);



}

public function recuperarSenha()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['erro' => 'Método não permitido'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $email = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);

        if (!$email) {
            http_response_code(400);
            echo json_encode(['erro' => 'E-mail é obrigatório'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $cliente = $this->clienteModel->buscarCliente($email);

        if (!$cliente) {
            http_response_code(404);
            echo json_encode(['erro' => 'E-mail não encontrado'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $this->clienteModel->salvarTokenRecuperacao($cliente['id_cliente'], $token, $expira);

        // ENVIO DE E-MAIL
        require_once("vendors/phpmailer/PHPMailer.php");
        require_once("vendors/phpmailer/SMTP.php");
        require_once("vendors/phpmailer/Exception.php");

        $mail = new PHPMailer\PHPMailer\PHPMailer();

        try {
            $mail->isSMTP();
            $mail->Host       = EMAIL_HOST;
            $mail->Port       = EMAIL_PORT;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Username   = EMAIL_USER;
            $mail->Password   = EMAIL_PASS;

            $mail->CharSet = 'UTF-8';           
            $mail->Encoding = 'base64';    

            $mail->setFrom(EMAIL_USER, 'Ki Oficina');
            $mail->addAddress($cliente['email_cliente'], $cliente['nome_cliente']);
            $mail->isHTML(true);
            $mail->Subject = 'Recuperação de Senha';

            $link = "https://360criativo.com.br/api/redefinirSenha?token=$token";

            $mail->msgHTML("
            Olá {$cliente['nome_cliente']},<br><br>
            Recebemos uma solicitação para redefinir sua senha.<br>
            Clique no link abaixo para criar uma nova senha:<br><br>
            <a href='$link'>$link</a><br><br>
            Se você não fez essa solicitação, ignore este e-mail.
        ");
            $mail->AltBody = "Olá {$cliente['nome_cliente']}, acesse $link para redefinir sua senha.";

            $mail->send();

            echo json_encode(['mensagem' => 'Um link de redefinição foi enviado para seu e-mail'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao enviar e-mail', 'detalhes' => $mail->ErrorInfo], JSON_UNESCAPED_UNICODE);
        }
    }

    /** View para redefinir senha */
    public function redefinirSenha()
    {
        $dados = array();
        $dados['titulo'] = 'Recuperação de senha - Ki Oficina';
        $this->carregarViews('recuperar-senha', $dados);
    }

    /** O usuário acessa o link com o token, define uma nova senha e salva. */
    public function resetarSenha()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['erro' => 'Método não permitido'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $token = $_POST['token'] ?? null;
        $novaSenha = $_POST['nova_senha'] ?? null;

        if (!$token || !$novaSenha) {
            http_response_code(400);
            echo json_encode(['erro' => 'Token e nova senha são obrigatórios'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $cliente = $this->clienteModel->getClientePorToken($token);

        if (!$cliente || strtotime($cliente['token_expira']) < time()) {
            http_response_code(403);
            echo json_encode(['erro' => 'Token inválido ou expirado'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $atualizado = $this->clienteModel->atualizarSenha($cliente['id_cliente'], $novaSenha);

        if ($atualizado) {
            $this->clienteModel->limparTokenRecuperacao($cliente['id_cliente']);
            $dados['mensagem'] = 'Senha redefinida com sucesso';
            $this->carregarViews('home', $dados);
        } else {
            http_response_code(500);
            $dados['erro'] = 'Erro ao atualizar a senha';
            $this->carregarViews('home', $dados);
        }
    }



}