<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once("PHPMailer/PHPMailer.php");
include_once("PHPMailer/Exception.php");
include_once("PHPMailer/SMTP.php");

$mail = new PHPMailer (true);

try {
    //Configuración del servidor 
    $mail->SMTPDebug = 0 ;                      //SMTP::DEBUG_SERVER;(para debugear) Habilita la salida de depuración detallada 
    $mail->isSMTP ();                                            // Enviar usando SMTP 
    $mail->Host= 'smtp.gmail.com' ;                    // Configure el servidor SMTP para enviar a través de 
    $mail->SMTPAuth = true ;                                   // Habilita la autenticación SMTP 
    $mail->Username = 'xxxxxxxxxxxxxxxxxxxxx@gmail.com' ;                     // Nombre de usuario SMTP 
    $mail->Password = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' ;                               // Contraseña SMTP 
    $mail->SMTPSecure = PHPMailer :: ENCRYPTION_STARTTLS ;         // Habilite el cifrado TLS; `PHPMailer :: ENCRYPTION_SMTPS` alentó 
    $mail->Port=587 ;                                    // Puerto TCP para conectarse, use 465 para `PHPMailer :: ENCRYPTION_SMTPS` arriba

    //Destinatarios 
    $mail->setFrom ('xxxxxxxxxxxxxxxxxxxxxxx@gmail.com','FiDrive');
    $mail->addAddress ($datos['correo'],'Usuario');     // Agregar un destinatario

    // Archivos adjuntos 
    //$mail -> addAttachment ( '/var/tmp/file.tar.gz' );         // Agregar archivos adjuntos 
    //$mail -> addAttachment ( '/tmp/image.jpg' , 'new.jpg' );    // Nombre opcional

    // Contenido 
    $mail->isHTML (true);                                  // Establecer el formato de correo electrónico en HTML 
    $mail->Subject = 'Recuperación de contraseña' ;
    $mail->Body  = '<h2>Gracias por contactarte con FiDrive</h2><br>'.
    "Hola <b>".$datos['login']." </b>Ya podes volver a ser parte de nosotros!<br>". 
    "No compartas el siguiente link con nadie y a volver a ingresar cambia la contraseña de manera inmediata para ".
    "garantizarte la seguridad que precisas, activa de nuevo tu cuenta <a href='http://Localhost/FAI-1513TPE/vista/contenido/formularios/perfilCuenta.php?usclave=$contra' target='_blank'>AQUÍ</a>";
    $mail->CharSet='UTF-8';
    //$mail->AltBody = 'Este es el cuerpo en texto plano para clientes de correo que no son HTML' ;
    $mail->send ();
    echo "<script>
    alert('Revise su correo para validar');
    window.location.href='../formularios/ingresarCuenta.php'
    </script>";
} catch (Exception  $e) {
    echo "<script>
    alert('No se pudo enviar el mensaje. Error de correo: {".$mail->ErrorInfo."}');
    window.location.href='../formularios/recuperarCuenta.php'
    </script>";
}