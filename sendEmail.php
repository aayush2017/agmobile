<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'autoload.php';

if (sendMailToUser() == true AND sendMailToMe() == true) {
    echo '1';
} 
function sendMailToMe() {
	try {
    //Server settings
    // $mail->SMTPDebug = 2; 
    $mail = new PHPMailer(true);                          // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.arenagurgaon.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'no-reply@arenagurgaon.com';                 // SMTP username
    $mail->Password = 'jaiswal88@';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to

	//Recipients
    $mail->setFrom('no-reply@arenagurgaon.com', 'New Enquiry - ArenaGurgaon');
    $mail->addAddress('info@arenagurgaon.com', 'Contact us - ArenaGurgaon');     // Add a recipient
    // $mail->addAddress('aayush.jaiswal984@gmail.com');               // Name is optional
    $mail->addReplyTo($_POST['email'], $_POST['fullnm']);
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $_POST['fullnm'] . ' is contact with us.';
    $mail->Body    = '<div style="text-align: left;">
<h1>Arena Gurgaon</h1>
<p><b>Name</b> :'.$_POST['fullnm'].'</p>
<p><b>Phone</b> :'.$_POST['mobile'].'</p>
<p><b>Email</b> :'.$_POST['email'].'</p>
<p><b>Course</b> :'.$_POST['course'].'</p>
<p><b>Message</b> :'.$_POST['message'].'</p>
<br/><br/>
<a href="http://prenits.com"><img src="http://prenits.com/img/logo.png" alt="prenits" style="width: 25%;"></a>
</div>';
	    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	    $mail->send();
        return true;
	} catch (Exception $e) {
	    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}
}
function sendMailToUser() {
try {
    $mail = new PHPMailer(true); 
    //Server settings
    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.arenagurgaon.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'no-reply@arenagurgaon.com';                 // SMTP username
    $mail->Password = 'jaiswal88@';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to

	//Recipients
    $mail->setFrom('no-reply@arenagurgaon.com', 'ArenaGurgaon');
    $mail->addAddress($_POST['email'], $_POST['fullnm']);     // Add a recipient
    // $mail->addAddress('aayush.jaiswal984@gmail.com');               // Name is optional
    $mail->addReplyTo('info@arenagurgaon.com', 'Replay');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Thanks for contact with us';
    $mail->Body    = '<h1>Arena Gurgaon</h1><p>This is a confirmation that we have recived your mail and we will contact to you ASAP.</p>';
	    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	    $mail->send();
        return true;
	} catch (Exception $e) {
	    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}
}
?>