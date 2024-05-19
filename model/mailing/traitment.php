<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

// Get form input values
$email = $_POST['email'];
$selectedPacks = json_decode($_POST['selectedPacks']); // Decode the JSON array

// Other form values
$priceBefore = $_POST['priceBefore'];
$discount = $_POST['discount'];
$priceAfter = $_POST['priceAfter'];

// Prepare the email message with the form data
$message = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        li {
        margin-left: -63px;
        list-style: none;
    }
    .coupon-container .close {
        width: 24px;
        position: absolute;
        top: 16px;
        right: 16px;
        z-index: 2;
        cursor: pointer;
      }
      
      .coupon-container {
        font-family: initial;
          max-width: 380px;
          text-align: center;
          background: #c4c4c4bd;
          margin-top: 85px;
      
        opacity: 0;
        pointer-events: none;
        transform: translateY(30px);
        transition: all 400ms ease;
      }
      
      .coupon-container.active {
        opacity: 1;
        pointer-events: auto;
        transform: translateY(0);
      }
      
      .coupon-container .gift {
        margin-top: -115px;
        width: 40%;
      }
      
      .coupon-container .bg {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }
      
      .coupon-container h2,
      .coupon-container p,
      .coupon-container .discount,
      .coupon-container .code,
      .coupon-container .btn {
        position: relative;
      }
      
      .coupon-container h2 {
        margin: -22px;
        color: #8400d0;
          font-weight: 900;
          font-size: 38px;
          padding-top: 0px;
          margin-top: -4px;
      }
      
      .coupon-container p {
        font-size: 23px;
        color: #023047;
        margin: -5px;
      }
      
      .coupon-container .discount {
        font-family: fantasy;
        font-size: 56px;
        font-weight: 300;
        color: #ba6708;
        margin-top: -20px;
      }
      
      .coupon-container .code {
        font-size: 20px;
    font-weight: 700;
    font-family: "Google Sans";
    letter-spacing: 7px;
      }
      
      .coupon-container .btn {
        text-decoration: none;
        background: #e63946;
        padding: 16px;
        display: inline-block;
        width: 100%;
        color: #fff;
        box-sizing: border-box;
        margin-top: 4px;
        font-size: 24px;
        font-weight: 900;
        text-transform: uppercase;
      }
      
      .coupon-container .btn:hover {
        background: #e22535;
      }
      
      .get-discount-btn {
        padding: 8px 32px;
        background: #023047;
        color: #fff;
        border: none;
        font-size: 18px;
        cursor: pointer;
      }
    </style>
</head>
<body>
    <div class="coupon-container active">
        <img class="bg" src="" alt="" />
        <img class="gift" src="https://freesvg.org/img/secretlondon_red_present.png" alt="" />
        <h2>Congratulations!</h2>
        <p>You can get</p>
        <div class="discount">-' . $discount . '%off</div>
        <div class="code">
        <ol>';

foreach ($selectedPacks as $pack) {
    $message .= '<li>' . $pack . '</li>';
}

$message .= '</ol></div>
        <p>Price Before: ' . $priceBefore . '</p>
        <p>Discount:-' . $discount . '</p>
        <p>Price After:' . $priceAfter . '</p>
        <a href="#" class="btn">Visit us ASAP</a>
    </div>
</body>
</html>';

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Your SMTP server host
    $mail->SMTPAuth = true;
    $mail->Username = 'dnl.westy@gmail.com'; // SMTP username
    $mail->Password = 'ulsz agif ctjb xwpx'; // SMTP password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Sender and recipient
    $mail->setFrom('dnl.westy@gmail.com', 'DaDaH Store');
    $mail->addAddress($email); // Recipient email and name

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Special Offer from DaDaH Store';
    $mail->Body = $message;

    // Send email
    $mail->send();

} catch (Exception $e) {
    echo "Failed to send message. Error: {$mail->ErrorInfo}";
}
?>
