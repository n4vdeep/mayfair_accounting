<?php

session_cache_limiter( 'nocache' );
header( 'Expires: ' . gmdate( 'r', 0 ) );
header( 'Content-type: application/json' );
$to         = 'enquire@mayfair-accounting.co.uk';  // put your email here
$email_template = 'simple.html'; //Update this depending where the put the file
$subject    = strip_tags($_POST['vsubject']);
$email       = strip_tags($_POST['vemail']);
$name       = strip_tags($_POST['vname']);
$message    = nl2br( htmlspecialchars($_POST['vmessage'], ENT_QUOTES) );
$result     = array();
            
    //Form validation check if any required fields are empty before submitting 
    //the email.
    if(empty($email)){
        $result = array( 'response' => 'error', 'empty'=>'email', 'message'=>'<strong>Error!</strong>&nbsp; Email is empty.' );
        echo json_encode($result );
        die;
    } 
    if(empty($name)){
        $result = array( 'response' => 'error', 'empty'=>'name', 'message'=>'<strong>Error!</strong>&nbsp; Name is empty.' );
        echo json_encode($result );
        die;
    } 
    if(empty($message)){
         $result = array( 'response' => 'error', 'empty'=>'message', 'message'=>'<strong>Error!</strong>&nbsp; Message body is empty.' );
         echo json_encode($result );
         die;
    }
    if(empty($_POST['g-recaptcha-response']))  {
        $result = array( 'response' => 'error', 'empty'=>'message', 'message'=>'<strong>Error!</strong>&nbsp; Please complete the Captcha.' );
         echo json_encode($result );
         die;
    }
    
    //Check the recaptcha is ticked and verified.
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $secret = '6LeSSI0UAAAAAFnwmu5cj7bk4guiaoXXnlID5-C2';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        
        //If its successfull then send mail
        if($responseData->success == true) {
    $headers  = "From: " . $name . ' <' . $email . '>' . "\r\n";
    $headers .= "Reply-To: ". $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $templateTags =  array(
        '{{subject}}' => $subject,
        '{{email}}'=>$email,
        '{{message}}'=>$message,
        '{{name}}'=>$name
        );
    $templateContents = file_get_contents( dirname(__FILE__) . '/../inc/'.$email_template);
    $contents =  strtr($templateContents, $templateTags);
    
    // Success mail message
    if ( mail( $to, $subject, $contents, $headers ) ) {
        $result = array( 'response' => 'success', 'message'=>'<strong>Thank You!</strong>&nbsp; Your email has been delivered.' );

    } else
    
    //If we have a mail error
    
    {
        $result = array( 'response' => 'error', 'message'=>'<strong>Error!</strong>&nbsp; Can\'t Send Mail.'  );
    }
   
    echo json_encode( $result );
    die;

        }
        //For if verification fails (ie a robot or spam)
        else
        {
            echo "<p> Sorry verification valid</p>";
        }
   }
   
?>