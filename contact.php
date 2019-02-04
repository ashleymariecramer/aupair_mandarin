<?php
// configure
$from = 'Info AuPair Mandarin info@aupairmandarin.com>';
$sendTo = 'Info AuPair Mandarin info@aupairmandarin.com>';
$subject = 'Nos encantaría una Au Pair Mandarin para nuestros hijos';
$fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message'); // array variable name => Text to appear in email
$okMessage = '谢谢! Gracias! Tu mensaje ha sido enviado correctamente, pronto nos pondremos en contacto contigo';
$errorMessage = 'Falló el envio del mensaje. Por favor, inténtelo más tarde o escribirnos directamente a info@aupairmandarin.com';

// let's do the sending

try
{
    $emailText = "You have new message from contact form\n=============================\n";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }
    mail($sendTo, $subject, $emailText, "From: " . $from);

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];
}