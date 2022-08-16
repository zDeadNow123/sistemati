<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Após 15 segundos a página será redirecionada para index.php -->
    <meta http-equiv="refresh" content="15;URL=index.php">
    <title>Verificação de contato</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/meu_estilo.css" type="text/css">
</head>
<body class="fundofixo">
    <?php include('menu_publico.php'); ?>
    <main class="container">
        <section>
            <div class="jumbotron alert-danger">
                <h1 class="text-danger">Agradecemos o contato</h1>
                <?php
                    $destino = "contato@softkleen.com.br";
                    $nome_contato = $_POST['nome_contato'];
                    $email_contato = $_POST['email_contato'];
                    $msg_contato = "Mensagem de: ".$_POST['nome_contato']."\n".$_POST['comentarios_contato'];

                    // PHPMailer
                    use PHPMailer\PHPMailer\PHPMailer;

                    require 'mailer/Exception.php';
                    require 'mailer/PHPMailer.php';
                    require 'mailer/SMTP.php';

                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'smtp.freesmtpservers.com';
                    $mail->SMTPAuth = false; // Não desejo autenticar :D
                    $mail->Port = 25;
                    //$mail->SMTPSecure = 'tls';
                    //$mail->Username = $email_contato;
                    //$mail->Password = 'senha';


                    $mail->setFrom($email_contato); // Remetente
                    $mail->addAddress($destino); // Destinatário

                    $mail->Subject = 'Formulário de contato do Site'; // Assunto
                    $mail->Body = $msg_contato; // Mensagem

                    if(!$mail->send()) {
                        echo 'Não foi possível enviar a mensagem.<br>';
                        echo 'Erro: ' . $mail->ErrorInfo;
                    } else {
                        echo 'Mensagem enviada.';
                    }

                    //$mailsend = mail($destino, "Formulário de contato Site", $msg_contato, "De: $email_contato");
                    //$mailsend = mail($destino, "Formulário de contato Site", $msg_contato);
                    //echo $nome_contato; (só pra testar)
                    echo "<p class='text-center'>Obrigado por enviar seus comentários, <b>$nome_contato</b></p>";
                    echo "<p class='text-center'>Mensagem enviada com sucesso!</p>";
                    
                ?>
            </div>
        </section>
        <footer>
            <?php include('rodape.php'); ?>
        </footer>
    </main>

    <!-- LINKS DOS ARQUIVOS BOOTSTRAP -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>