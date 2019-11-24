<?php
function sendmail($to, $subject, $body){
    require_once('phpmail/PHPMailerAutoload.php');
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'bh-in-27.webhostbox.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@lintend.com';
    $mail->Password = 'helloworld12!@';
    $mail->Port = 465;
    $mail->From = 'info@lintend.com';
    $mail->FromName = 'Lintend';
    $mail->addAddress($to);
    $mail->addReplyTo('info@lintend.com', 'Lintend');
    $mail->WordWrap = 50;
    $mail->isHTML(true);
    $mail->SMTPSecure = 'ssl';
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);
    if(!$mail->send()) {
        return false;
    }else{
        return true;
    }                           
    // return true;
}
?>