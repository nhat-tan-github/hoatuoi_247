<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];}

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                          
        $mail->Host       = 'smtp.gmail.com';                    
        $mail->SMTPAuth   = true;                               
        $mail->Username   = 'webshophoa247@gmail.com';                   
        $mail->Password   = 'mspirqxdrycwdiun';                         
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                                    

        $mail->setFrom('webshophoa247@gmail.com', 'Feedback');
        $mail->addAddress('webhoact07@gmail.com', '.');  

        $mail->isHTML(true);                           
        $mail->Subject = 'Feedback Shop Hoa 247';
        $mail->Body    = $message;

       
        $mail->send();
       
        echo '<div class="container" style="max-width: 400px; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease-in-out; margin: 0 auto; text-align: center;">';
        echo '<p style="color: green; font-weight: bold; font-size: 18px;">Chúng tôi xin chân thành cảm ơn bạn vì đã gửi phản hồi. Sự ủng hộ của bạn là động lực lớn cho chúng tôi tiếp tục phát triển.</p>';
        echo '</div>';


    } catch (Exception $e) {
        echo "Lỗi: {$mail->ErrorInfo}";
    }

?>
