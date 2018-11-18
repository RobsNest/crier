<?php

require("sendgrid-php/sendgrid-php.php");

function NotifyRob()
{
    $from = new Email(null, "trebor@cumberlandcrier.com");
    $subject = "New Post";
    $to = new Email(null, "robsdigs@gmail.com");
    $content = new Content("text/plain", "A new classified post has been received.");
    $mail = new Mail($from, $subject, $to, $content);
    $to = new Email(null, "rob@cumberlandcrier.com");
    $mail->personalization[0]->addTo($to);
    //echo json_encode($mail, JSON_PRETTY_PRINT), "\n";
    return $mail;
}
?>
