$(document).ready(function() {
    $.ajax({
        url: 'get_order.php', // Tệp xử lý dữ liệu trên máy chủ
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            const ordersList = $('#orders-list');
            response.forEach(function(order) {
                const orderElement = $('<div class="order">');
                orderElement.html(`
                    <p class="order-id" data-order-id="${order.order_id}">
                        ID Đơn hàng #${order.order_id} - 
                        <span class="order-status">${order.Status == 1 ? 'Đã giao' : 'Chưa giao'}</span>
                    </p>
                    <p class="order-date">Ngày tạo: ${order.date_create}</p>
                    <p class="order-total">Tổng tiền: ${order.total} VND</p>
                    ${order.isPayed == 1 ? '<p class="btn-paid">Đã Thanh toán' : '<button class="btn-pay" data-order-id="${order.order_id}">Thanh toán</button>'}
                `);
                ordersList.append(orderElement);
            });

            $('.order').click(function() {
                const orderId = $(this).find('.order-id').data('order-id');
                window.location.href = `order_detail.php?order_id=${orderId}`;
            });

            $('.btn-pay').click(function(e) {
                e.stopPropagation(); 
                const orderId = $(this).data('order-id');
                window.location.href = `thanhtoan.php?order_id=${orderId}`;
            });
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
});
