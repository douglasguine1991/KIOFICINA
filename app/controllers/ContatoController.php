<?php

class ContatoController extends Controller
{

    public function index()
    {


        $dados = array();
        $dados['titulo'] = ' Contato - kioficina';

        $this->carregarViews('contato', $dados);
    }

    //Enviar Email
    public function enviarEmail()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
            $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_SPECIAL_CHARS);
            $msg = filter_input(INPUT_POST, 'msg', FILTER_SANITIZE_SPECIAL_CHARS);

            // VAR_DUMP($nome);
            // VAR_DUMP($email);
            // VAR_DUMP($tel);
            // VAR_DUMP($assunto);
            // VAR_DUMP($msg);
            // VAR_DUMP($_SERVER['REQUEST_METHOD']);
            // VAR_DUMP($_SERVER);

            if ($nome && $email && $tel && $msg) {

                // reconhcer estrutura PHPMAILER
                require_once("vendors/phpmailer/PHPMailer.php");
                require_once("vendors/phpmailer/SMTP.php");
                require_once("vendors/phpmailer/Exception.php");


                $phpmail = new PHPMailer\PHPMailer\PHPMailer(); //Gereando variael de email

                try {
                    $phpmail->isSMTP(); //envio por SMTP
                    $phpmail->SMTPDebug = 0;

                    $phpmail->Host = EMAIL_HOST; //SMTP Servidor de email
                    $phpmail->Port = EMAIL_PORT; //porta do servidor SMTP

                    $phpmail->SMTPSecure = 'ssl'; //Certificado / Autenticação SMTP
                    $phpmail->SMTPAuth = true; //caso necessite ser autenticado

                    $phpmail->Username = EMAIL_USER; //EMAIL smtp
                    $phpmail->Password = EMAIL_PASS; //SENHA SMTP

                    $phpmail->IsHTML(true); //Trabalhar com estrutura HTML
                    $phpmail->setFrom(EMAIL_USER, $nome); //email do remetente
                    $phpmail->addAddress(EMAIL_USER, $assunto); //email do destinario

                    $phpmail->Subject = $assunto; //Assunto enviado pelo metodo Post

                    //Estrutura do email
                    $phpmail->msgHTML("Nome: $nome <br>
                                       E-mail: $email <br>
                                       Telefone: $tel <br>
                                       Mensagem: $msg");

                    $phpmail->AltBody = "Nome: $nome \n
                                         E-mail: $email \n
                                         Telefone: $tel \n
                                         Mensagem: $msg";

                    $phpmail->send();

                    $dados = array(
                        'mensagem' => 'Obrigado pelo seu contato, em breve responderemos',
                        'status' => 'sucesso'
                    );

                    $this->carregarViews('contato', $dados);

                    // EMAIL DE RESPOSTA

                } catch (Exception $e) {

                    $dados = array(
                        'mensagem'  => 'Não foi possível enviar sua mensagem!',
                        'status'    => 'erro',
                        'nome'      =>  $nome,
                        'email'     =>  $email
                    );

                    error_log('Erro ao enviar o email' . $phpmail->ErrorInfo);

                    $this->carregarViews('erro', $dados);

                } // FIM TRY

            } // FIM DO IF que testa se os campos estão preenchidos

        } else{
            $dados = array();
            $this->carregarViews('contato', $dados);
        }
    }
}
