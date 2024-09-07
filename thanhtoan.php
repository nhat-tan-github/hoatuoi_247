<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form thanh toán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            position: relative; 
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input {
            width: calc(100% - 10px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input:focus {
            border-color: #007bff;
        }

        button {
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #0056b3;
        }
        .visa-logo {
            position: absolute;
            top: 88%;
            right: 200px;
            transform: translateY(-50%);
            width: 80px;
            height: auto;
        }
        .mtc-logo {
            position: absolute;
            top: 88%;
            right: 120px; 
            transform: translateY(-50%);
            width: 75px;
            height: auto;
        }
        .pp-logo {
            position: absolute;
            top: 88%;
            right: 45px;
            transform: translateY(-50%);
            width: 85px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Form thanh toán</h1>
    <form action="thanhcong.php" method="post">
        <label for="card-number">Số thẻ:</label>
        <input type="text" id="card-number" name="card-number" placeholder="Nhập số thẻ của bạn" required>
        <br>
        <label for="cvv">Mã CVV:</label>
        <input type="text" id="cvv" name="cvv" placeholder="Nhập mã CVV" required>
        <br>
        <label for="card-name">Tên trên thẻ:</label>
        <input type="text" id="card-name" name="card-name" placeholder="Nhập tên trên thẻ" required>
        <br>
        <label for="expiry-date">Ngày hết hạn:</label>
        <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YYYY" pattern="(0[1-9]|1[0-2])\/[0-9]{4}" required>
        <br>
        <button type="submit">Thanh toán</button>
        <img src="./images/visa_logo.png" alt="Visa logo" class="visa-logo"> 
        <img src="./images/mtc_logo.png" alt="mtc logo" class="mtc-logo"> 
        <img src="./images/pp_logo.png" alt="pp logo" class="pp-logo"> 
    </form>
</body>
</html>
