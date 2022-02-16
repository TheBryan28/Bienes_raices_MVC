<?php
/** normal
 * ! Better comments
 * ? mejorar los comentarios
 * TODO: alerta to do
 * * importante
 */
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index( Router $router ) {

        $propiedades = Propiedad::get(3);

        $router->render('paginas/index', [
            'inicio' => true,
            'propiedades' => $propiedades 
        ]);
    }

    public static function nosotros( Router $router ) {
        $router->render('paginas/nosotros', [

        ]);
    }

    public static function propiedades( Router $router ) {

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {
        $arrayId=Propiedad::id();
        $id = validarORedireccionar('/',$arrayId);

        // Obtener los datos de la propiedad
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog( Router $router ) {

        $router->render('paginas/blog');
    }

    public static function entrada( Router $router ) {
        $router->render('paginas/entrada');
    }


    public static function contacto( Router $router ) {
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validar 
            $respuestas = $_POST['contacto'];
            // create a new object
            $mail = new PHPMailer();//revisar documentacion de PHPmailer
            // configure an SMTP, protocolo de envio de emails
            $mail->isSMTP();//utilizamos SMTP para enviar
            $mail->Host = $_ENV['MAILGUN_SMTP_SERVER'];//el dominio
            $mail->SMTPAuth = true; 
            $mail->Username = $_ENV['MAILGUN_SMTP_LOGIN'];
            $mail->Password = $_ENV['MAILGUN_SMTP_PASSWORD'];
            $mail->SMTPSecure = 'tls';//tls agregar seguridad, ssl es para certificados
            $mail->Port = $_ENV['MAILGUN_SMTP_PORT'];
            //crear contenido del email
            $mail->setFrom('bienesraices@outlook.com', 'bryan');//Quien envia el email
            $mail->addAddress($respuestas['email'], $respuestas['nombre'] );//a donde se envia el email
            $mail->Subject = 'Tienes un Nuevo Mensaje de Bienesraices.com';
            // Set HTML 
            $mail->isHTML(TRUE); //habilitar HTML
            $mail->CharSet = 'UTF-8';  //email con letras en español
            //definir contenido
            $contenido = '<html>';
            $contenido .= "<p><strong>Has Recibido un email:</strong></p>";
            $contenido .= "<p>Nombre: " . $respuestas['nombre'] . "</p>";
            $contenido .= "<p>Mensaje: " . $respuestas['mensaje'] . "</p>";
            $contenido .= "<p>Vende o Compra: " . $respuestas['opciones'] . "</p>";
            $contenido .= "<p>Presupuesto o Precio: $" . $respuestas['presupuesto'] . "</p>";

            if($respuestas['contacto'] === 'telefono') {
                $contenido .= "<p>Eligió ser Contactado por Teléfono:</p>";
                $contenido .= "<p>Su teléfono es: " .  $respuestas['telefono'] ." </p>";
                $contenido .= "<p>En la Fecha y hora: " . $respuestas['fecha'] . " - " . $respuestas['hora']  . " Horas (Formato24H)</p>";
            } else {
                $contenido .= "<p>Eligio ser Contactado por Email:</p>";
                $contenido .= "<p>Su Email  es: " .  $respuestas['email'] ." </p>";
            }
            $contenido .= '</html>';

            $mail->Body = $contenido; //agregar el contenido al email
            $mail->AltBody = 'Esto es texto alternativo';//cuando la web no soporta HTML, entonces carga el texto plano como mensaje

            

            // Enviar y revisar si se pudo enviar el mensaje
            if(!$mail->send()){
                $mensaje = 'Hubo un Error... intente de nuevo';
            } else {
                $mensaje = 'Email enviado Correctamente';
            }

        }
        
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}