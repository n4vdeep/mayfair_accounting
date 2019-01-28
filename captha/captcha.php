<?php

if(isset($_POST['Submit'])) 
{
function CheckCaptcha($userResponse) {
      $fields_string = '';
      $fields = array(
        'secret' => '6LeSSI0UAAAAAFnwmu5cj7bk4guiaoXXnlID5-C2',
        'response' => $userResponse
      );
      foreach($field as $key=>$value)
      $fields_string .= $key . '=' . $value . '&';
      $fields_string = rtrim($fields_string, '&');

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
      curl_setopt($ch, CURLOPT_POST, count($fields));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

      $res = curl_exec($ch);
      curl_close($ch);

      return json_decode($res, True);
    }

    // CALL THE FUNCTION CheckCaptcha
    $result = CheckCaptcha($_PSOT['g-recaptcha-response']);

    if($result['success']) {
      //IF THE USER HAS CHECKED THE CAPTCHA BOX
      echo "Captcha verified successfully";
    } else {
      // IF THE CAPTCHA BOX WASNT CHECKED
      echo '<script>alert("Error Message");</script>';
    }
}
?>