<?php
// Kiểm tra xem có yêu cầu POST không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem có ID đơn hàng được gửi từ yêu cầu POST không
    if (isset($_POST["orderId"])) {
        // Lấy ID đơn hàng từ yêu cầu POST
        $orderId = $_POST["orderId"];

        // Thực hiện kết nối đến cơ sở dữ liệu
        require "inc/db.php";

        // Chuẩn bị câu lệnh cập nhật trạng thái đã giao của đơn hàng
        $sql = "UPDATE orders SET delivered = 1 WHERE id = :id";

        // Chuẩn bị và thực thi câu lệnh sử dụng Prepared Statement
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $orderId, PDO::PARAM_INT);
        
        // Kiểm tra xem câu lệnh đã thực thi thành công không
        if ($stmt->execute()) {
            // Trả về mã trạng thái 200 (OK) để chỉ ra rằng quá trình đã hoàn thành thành công
            http_response_code(200);
        } else {
            // Trả về mã lỗi 500 (Internal Server Error) để chỉ ra rằng có lỗi xảy ra trong quá trình đánh dấu đã giao
            http_response_code(500);
        }
        
        // Đóng kết nối
        $conn = null;
    } else {
        // Trả về mã lỗi 400 (Bad Request) nếu không có ID đơn hàng được gửi từ yêu cầu POST
        http_response_code(400);
    }
} else {
    // Trả về mã lỗi 405 (Method Not Allowed) nếu yêu cầu không phải là yêu cầu POST
    http_response_code(405);
}
?>
