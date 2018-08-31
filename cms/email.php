<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'C:\xampp\composer\vendor\autoload.php';
//include 'C:\xampp\php\PEAR';

//include '../inc/session.php';
//include '../inc/template_header.php';
//include '../inc/navigation.php';

$mail = new PHPMailer(true);
$htmlVersion="<h1>Hello  , <br><br><p>This is the html Version</p><br><br><h3>Hope it works!!!</h3> ";
$textVersion="Hello ,./r/n This is the text version";                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
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

    //initializing variables
$ebatch = "";

    $errors = array(); //creating $errors as an array variable.

include '../inc/dbcon.php';
    if (isset($_POST['entbatch'])) {
        $ebatch = mysqli_real_escape_string($con, $_POST['batch']);
        //echo 'success';
        //ensure that the form field are filled properly(form validation)...
    if (!empty($ebatch)) {
            if (!preg_match("/^[0-9]{4}$/", $ebatch)) {
                    array_push($errors, "invalid batch number");
                }
            }
            else{
                array_push($errors, "batch is required here");
            }





if (count($errors) == 0){

/*** prepare the select statement ***/
             $stmt = "SELECT email FROM registration WHERE batch= '$ebatch' ";
     
            /*** execute the prepared statement ***/
            $run = mysqli_query($con,$stmt);
            if (!$run) {
                die ('SQL Error: ' . mysqli_error($conn));
            }
            $email =array();
            //$arrlength = count($email);
            //$row = array();     
            while($row = mysqli_fetch_array($run)) {
                //$id = $row['id'];
                //$name = $row['name'];
                //echo $row['name'];
                $email = $row['email'];
                echo $row['email'];
                echo '<br><br>';
                //echo $arrlength;
                $mail->addAddress($email);     // Add a recipient

                //$batch = $row['batch'];
                //call send email function
                //sendEmail($email, $name, $batch);
            }

           
        
        //session_start();
        //$_SESSION['success'] = "student record deleted successfully";
        
   
            
        }
    

    //$mail->addAddress('sthasrizaana99@hotmail.com');               // Name is optional
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
  /* for($x = 0; $x < $arrlength; $x++) {
    $mail->addCC($email[$x]);
    echo "<br>";
    }
    
    */
    
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
        //$_SESSION['success'] = "student registered successfully.";          

        @header('location:send_mail.php');
        exit();
} 
}catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        /*--------------------- for sending mail close ------------------*/

}
//include '../inc/template_footer.php';

?>