<?php

if ( isset($_POST) ) {
  if ( !empty($_POST['nombre'])
    && !empty($_POST['email'])
    && !empty($_POST['telefono'])
    && !empty($_POST['zona'])
    && !empty($_POST['mensaje'])
    ) {

    $respuesta = ['estado' => true, 'msj' => ''];

    function checkIfContent( $stuff ){
      return $stuff ? $stuff : '';
    }

    $datos = [];
    $datos['nombre'] = checkIfContent($_POST['nombre']);
    $datos['email'] = checkIfContent($_POST['email']);
    $datos['telefono'] = checkIfContent($_POST['telefono']);
    $datos['zona'] = checkIfContent($_POST['zona']);
    $datos['mensaje'] = checkIfContent($_POST['mensaje']);



    // foreach ($datos as $campo => $valor) {
    //   if ( strlen($valor) < 3) {
    //     $respuesta['estado'] = false;
    //     $respuesta['msj'] .= '<br/> Complete el campo <strong>'.str_replace('info', 'consulta', $campo).'</strong> correctamente.';
    //   }
    // }

    if ( $respuesta['estado'] ) {

      $mensaje = '<b>Nombre:</b> '.$datos['nombre'].
                      '<br><br><b>Email:</b><br><br>'.$datos['email'].
                      '<br><br><b>Teléfono:</b><br><br>'.$datos['telefono'].
                      '<br><br><b>Zona:</b><br><br>'.$datos['zona'].
                      '<br><br><b>Mensaje:</b><br><br>';
      $mensaje .= nl2br($datos['mensaje']);


      require 'phpmailer/PHPMailerAutoload.php';

      $mail = new PHPMailer;

      $mail->SMTPDebug = 3;                               // Enable verbose debug output

      $mail->setLanguage('es', 'phpmailer/language');

      $mail->setFrom( $datos['email'], $datos['nombre'] );
      $mail->addAddress('matiasdelgado2011@gmail.com', 'Enviado por');
      $mail->addReplyTo($datos['email'], 'Contestar a');

      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = '[Contacto web] por '.$datos['nombre'];
      $mail->Body    = $mensaje;

      header('Content-Type: application/json');
      if(!$mail->send()) {
          // echo 'Message could not be sent.';
          // echo 'Mailer Error: ' . $mail->ErrorInfo;
          $respuesta = ['estado' => false, 'msj' => 'Mailer Error: ' . $mail->ErrorInfo];
      } else {
          $respuesta['msj'] = $respuesta['estado'] ? 'Su mensaje fue enviado con exito.' : $respuesta['msj'];
          // echo 'Message has been sent';
      }

    }
  } else {
    $respuesta = ['estado' => false, 'msj' => 'Complete todos los campos.'];
  }
} else {
  $respuesta = ['estado' => false, 'msj' => 'Hubo un error inesperado.'];
}
echo json_encode($respuesta);

?>