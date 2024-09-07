<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            position: relative;
        }

        #map {
    position: absolute;
    left: 10%;
    top: 50%;
    width: 30%; 
    height: 50vh;
    border: 0;
    transform: translate(5%, 50%);
}


        .container {
            position: absolute;
            right: 0;
            top: 0;
            width: 50%; 
            height: 100vh; 
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .container > div {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            border-color: #4CAF50;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color:#45a049;
        }

        .contact-info {
            max-width: 400px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            margin-left: 4px;
        }

        .contact-info h3 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .contact-info ul {
            list-style: none;
            padding: 0;
        }

        .contact-info ul li {
            margin-bottom: 10px;
        }

        .contact-info ul li strong {
            font-weight: bold;
        }

        .contact-info ul li:not(:last-child) {
            font-family: Arial, sans-serif;
            color: #555;
        }

        .contact-info ul li:last-child {
            font-style: italic;
            color: #777;
        }
        
    </style>
</head>
<body>
<iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.137407316531!2d106.65460897508895!3d10.80078638934949!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752937159dbd15%3A0x286f2a16b253c64b!2zSOG7jWMgVmnhu4duIEvhu7kgVGh14bqtdCBN4bqtdCBNw6MgLSBNaeG7gW4gTmFtIChLTVAp!5e0!3m2!1svi!2s!4v1711216866363!5m2!1svi!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

<div class="container">
    <div>
        <h2>Để lại phản hồi</h2>
        <p>Sử dụng biểu mẫu này để gửi phản hồi cho chúng tôi</p>
        <form action="send_email.php" method="post" id="feedbackform">
            <label for="name">Họ và tên:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="message">Nội dung:</label>
            <textarea id="message" name="message" rows="4" required></textarea>
            
            <input  type="submit" value="Gửi">
        </form>
    </div>

    <div class="contact-info">
        <h3>Thông tin liên hệ</h3>
        <ul>
            <li><strong>Số điện thoại:</strong> +84 98314672</li>
            <li><strong>Email:</strong> webhoact07@gmail.com</li>
            <li><strong>Địa chỉ:</strong> 17A, Cộng Hòa, Tân Bình, TP.HCM</li>
        </ul>
    </div>
</div>

</body>
</html>
