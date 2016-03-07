<html>
<head>
<?php
	require 'mailer/PHPMailerAutoload.php';
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "insoft.ej@gmail.com";
    $mail->Password = "quetzal2";
    $mail->SetFrom("FormulárioSite");
    $mail->AddAddress("insoft.ej@gmail.com");
    $logfile = dirname(dirname(__FILE__)) . '/mail.log';
    try {
		$mensagem = "Nome: ".$_POST['nome']."  ||  ".$_POST['email']."  ||  ".$_POST['mensagem'];
        $mail->Body = $mensagem;
        $mail->Subject = $_POST['assunto'];


        file_put_contents($logfile, "Content: \n", FILE_APPEND);
        file_put_contents($logfile, $mensagem . "\n\n", FILE_APPEND);

        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Email has been sent";
			echo '
				<script>
					function myFunction() {
						confirm("Email Enviado!\n Você será redirecionado para o site novamente em alguns segundos");
					}
					myFunction();
				</script>';
        }
    } catch (Exception $e) {
        #print_r($e->getMessage());
        file_put_contents($logfile, "Error: \n", FILE_APPEND);
        file_put_contents($logfile, $e->getMessage() . "\n", FILE_APPEND);
        file_put_contents($logfile, $e->getTraceAsString() . "\n\n", FILE_APPEND);
    }

?>
</head>
<body>
<?php 
	$redirect = "http://localhost/siteInsoft/#contato";
	
	sleep(15);
	header("location:$redirect");?>
</body>
</html>