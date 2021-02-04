<?php
if(isset($_POST['login'])) {
    if(!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
        echo 'reCAPTHCA verification failed, please try again.';
    } else {
        $secret = 'google_secret_key';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        if($response->success) {
            // What happens when the CAPTCHA was entered incorrectly
            echo 'Successful login.';
        } else {
            // Your code here to handle a successful verification
            echo 'reCAPTHCA verification failed, please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP reCAPTHCA</title>
</head>
<body>

    <form method="POST">
        <div class="g-recaptcha" data-sitekey="site_key"></div>
        <input type="submit" name="login" value="Log in">
    </form>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
