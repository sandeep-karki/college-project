<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'C:\xampp\composer\vendor\autoload.php';
//include 'C:\xampp\php\PEAR';

include '../inc/session.php';
include '../inc/template_header.php';
include '../inc/navigation.php';

$mail = new PHPMailer(true);
$htmlVersion="<h1>Hello  , <br><br><p>This is the html Version</p><br><br><h3>Hope it works!!!</h3> ";
$textVersion="Hello ,./r/n This is the text version";                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'sthasushree@gmail.com';                 // SMTP username
    $mail->Password = 'fortune00fame';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    //echo 'processing';
    //Recipients
    $mail->setFrom('sthasushree@gmail.com', 'Mailer Shreejana');

    include '../inc/dbcon.php';
/*** prepare the select statement ***/
             $stmt = "SELECT email FROM registration";
     
            /*** execute the prepared statement ***/
            $run = mysqli_query($con,$stmt);
            if (!$run) {
                die ('SQL Error: ' . mysqli_error($conn));
            }
            $email =array();     
            while($row = mysqli_fetch_array($run)) {
                //$id = $row['id'];
                //$name = $row['name'];
                //echo $row['name'];
                $email = $row['email'];
                echo $row['email'];
                //$batch = $row['batch'];
                //call send email function
                //sendEmail($email, $name, $batch);
            }  















    //$mail->addAddress($email);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
  /*  $recipients = array(
        'sthasunita987@gmail.com' => 'Person One' ,
        'sthasrizaana99@hotmail.com' => 'Person Two' ,
        'sthasreejana499@outlook.com' => 'Person Three' ,
        'shresthashreejana499@yahoo.com' => 'Person Four'
         );
    foreach ($recipients as $emails => $name) {
        $mail->addCC($emails,$name);
        # code...
    }
    */
    $mail->addCC($email);
    //$mail->addBCC('bcc@example.com');   

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Mail sending bulk Testing to all stored in database.';
    $mail->Body    = $htmlVersion ;
    $mail->AltBody = $textVersion;


    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        /*--------------------- for sending mail close ------------------*/

}

?>