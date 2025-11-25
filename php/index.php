<?php



use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;



require 'PHPMailer/Exception.php';

require 'PHPMailer/PHPMailer.php';

require 'PHPMailer/SMTP.php';



header('Content-Type: text/html; charset=utf-8');



$mail = new PHPMailer;





$mail->isSMTP();

// $mail->Host = 'rs2-or.serverhostgroup.com';
$mail->Host = 'rs8-va.serverhostgroup.com';

$mail->SMTPAuth = true;

$mail->Username = 'senderemails@secofyl.com';

// $mail->Password = '[Cjx?)mZou-f';

$mail->Password = 'sendenvia_123secofyl';

$mail->SMTPSecure = 'ssl';

$mail->Port = 465;



$mail->addReplyTo($_POST['email'], $_POST['nombre']);





// var// variables cotizacion




$mail->setFrom('senderemails@secofyl.com', 'Secofyl Web Contacto');

// $mail->FromName = $_POST['nombre'];

$mail->addAddress("secofyl@gmail.com");
$mail->isHTML(true);
$mail->Subject = "Secofyl contacto Pagina Web";
$mail->AddEmbeddedImage('../assets/logo.jpeg', 'logo_id');

$html = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>

<html xmlns='http://www.w3.org/1999/xhtml'>

<head>

    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

    <title>Secofyl</title>

</head>

<body> 

    <table style='width: 550px; border: 0;margin:0 auto'>

    	<tr>

    		<td>

            <img src='cid:logo_id' style='max-height: 95px;' alt='Logotipo' />



                

            </td>

        </tr>

    	<tr>

    		<td style='padding: 30px;'>

            <p>Nuevo mensaje enviado a traves de la p&aacute;gina web a las " . date("Y-m-d H:i:s") . "</p><br>

            <table align='' border='0' cellpadding='5' cellspacing='0' width='500' style='border:1px solid #eaeaea'>

                <tr>

                    <td>Nombre</td>

                    <td>" . $_POST['nombre'] . "</td>

                </tr>

                <tr>

                    <td>Teléfono</td>

                    <td>" . $_POST['telefono'] . "</td>

                </tr>

                <tr>

                    <td>E - mail</td>

                    <td>" . $_POST['email'] . "</td>

                </tr>

                <tr>

                    <td>Asunto</td>

                    <td>" . $_POST['asunto'] . "</td>

                </tr>

                <tr>

                    <td>Mensaje Extra</td>

                    <td>" . $_POST['mensaje'] . "</td>

                </tr>

            </table>

    		</td>

    	</tr>

    </table>

</body>

</html>";



$mail->Body = $html;


try {
    $mail->send();
    $result = array(
        'success' => true
    );
    echo json_encode($result);
    // Puedes agregar un registro (log) aquí si el envío es exitoso
    // error_log("Correo enviado con éxito.");
    exit();
} catch (Exception $e) {
    // 1. Obtener el error detallado de PHPMailer
    $error_message = $mail->ErrorInfo;

    // 2. Imprimir el error en la salida (si se ejecuta en el navegador)
    // Para ver este mensaje, asegúrate de que tu script NO esté siendo llamado 
    // únicamente por AJAX, o revisa la respuesta de la llamada AJAX en la consola.
    echo "Message could not be sent. Mailer Error: {$error_message}";

    // 3. Registrar el error en el log del servidor (es lo más recomendable)
    error_log("PHPMailer Error: {$error_message}");

    $result = array(
        'success' => false,
        'error' => "Mailer Error: {$error_message}" // Añadir el error al JSON de respuesta
    );
    echo json_encode($result);
    exit();
}
