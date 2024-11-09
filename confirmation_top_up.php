<?php require_once('./config.php') ?>

<?php
// Kiểm tra nếu dữ liệu đã được gửi từ trang Top Up
$service = 'Top-up';
$payment_method = $_POST['payment_method'] ?? 'N/A';
$amount = $_POST['amount'] ?? '0 VND';
$fee = 'Free';
$total_amount = $amount; // Giả sử không có phí bổ sung
?>

<div class="container py-5">
    <div class="card card-outline-primary" style="padding: 20px; border-radius: 15px;">
        <h2 style="font-weight: bold; font-size: 24px;">Secured Payment</h2>
        <div class="mt-4">
            <div class="row-item">
                <span class="label">Service</span>
                <span class="value"><?php echo htmlspecialchars($service); ?></span>
            </div>
            <div class="row-item">
                <span class="label">Payment Methods</span>
                <span class="value"><?php echo htmlspecialchars($payment_method); ?></span>
            </div>
            <div class="row-item">
                <span class="label">Amount</span>
                <span class="value"><?php echo htmlspecialchars($amount); ?></span>
            </div>
            <div class="row-item">
                <span class="label">Fee</span>
                <span class="value"><?php echo htmlspecialchars($fee); ?></span>
            </div>
            <hr>
            <div class="row-item">
                <span class="label">Total Amount</span>
                <span class="value"><?php echo htmlspecialchars($total_amount); ?></span>
            </div>
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-dark btn-lg" style="width: auto;">Confirm</button>
        </div>
    </div>
</div>

<style>
    .row-item {
        display: grid;
        grid-template-columns: 1fr 2fr; /* Chia cột theo tỷ lệ 1:2 */
        align-items: center;
        padding: 5px 0;
    }

    .label {
        font-weight: bold;
    }

    .value {
        text-align: left;
    }

    hr {
        border: none;
        height: 1px;
        background-color: white;
        margin: 10px 0;
    }
</style>
