<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thanh toán thành công</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f4f4f4;
    }
    .container {
      border: 1px solid #ddd;
      padding: 100px; 
      width: 30%; 
      margin: 20px auto;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      position: relative;
      overflow: hidden;
      top: 50px;
      height:250px;
      position: relative; 
    }
    .tich {
      position: absolute;
      top: 10px;
      left: 50%;
      transform: translateX(-50%);
      width: 150px;
    }
    .title {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }
    .message {
      font-size: 16px;
      margin-top: 10px;
      text-align: center;
    }
    .order-id {
      font-weight: bold;
    }
    .link {
      text-decoration: none;
      color: #007bff;
    }
    .button {
      background-color: #007bff;
      color: #fff;
      padding: 10px 20px;
      border: none;
      text-align: center;
      font-size: 16px;
      margin-top: 20px;
      display: block;
      width: 100%;
      border-radius: 5px;
      transition: background-color 0.3s ease;
      text-decoration: none;
    }
    .button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <form class="container" action="index.php" method="post">
    <img src="./images/tich.png" alt="tich" class="tich">
    <h1 class="title">Thanh toán thành công</h1>
    <p class="message">Cảm ơn bạn đã mua hàng tại <span style="font-weight: bold;">Shop Hoa 247</span></p>
    <p class="message">Bạn có thể xem chi tiết trong <a class="link" href="order.php">đơn hàng của tôi</a>.</p>
    <p class="message">Thời gian dự kiến giao hàng là 1 ngày </p>
    <button type="submit" class="button">TIẾP TỤC MUA HÀNG</button>
  </form>
</body>
</html>
