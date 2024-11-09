<?php require_once('./config.php') ?>

<style>
    .container {
        display: flex;
        justify-content: space-between;
    }
    .card-outline-primary {
        background-color: #d5dae1;
        border: none;
        border-radius: 10px;
        padding: 20px;
        width: 45%;
    }
    h2 {
        font-weight: bold;
        font-size: 28px;
    }
    .form-group label {
        font-weight: bold;
        font-size: 16px;
    }
    .source-option {
        border: 1px solid #c5cbd3;
        border-radius: 8px;
        padding: 10px;
        background-color: #fff;
    }
    .source-option:hover {
        border-color: #1f2a37;
    }
    .source-option div:first-child {
        font-size: 16px;
        font-weight: bold;
        color: #1f2a37;
    }
    .source-option div:last-child {
        color: #657786;
    }
    .btn-dark {
        background-color: #1f2a37;
        border: none;
    }
    .btn-link {
        font-size: 14px;
        color: #1f2a37;
    }
</style>

<div class="container">
    <!-- Left Section: Source of Fund -->
    <div class="card card-outline-primary">
        <h2>Source of fund</h2>
        <form action="confirmation_transfer.php" method="POST" id="transfer_form">
            <div class="form-group">
                <label class="control-label">Fee schedule</label>

                <!-- Vietcombank Option -->
                <div class="source-option d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div>Vietcombank</div>
                        <div>Balance: 20.000.000 VND</div>
                    </div>
                    <input type="radio" name="payment_method" value="Vietcombank" required>
                </div>

                <!-- VISA Option -->
                <div class="source-option d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div>VISA</div>
                        <div>Balance: 10.000.000 VND</div>
                    </div>
                    <input type="radio" name="payment_method" value="VISA" required>
                </div>

                <!-- Additional payment options (dynamically added) -->
                <div id="additional_payment_options" style="padding-top: 10px;"></div>

                <!-- Add banks button -->
                <div class="source-option d-flex justify-content-between align-items-center mb-3">
                    <div>Add banks</div>
                    <button type="button" id="add_bank_btn" class="btn btn-link">Link with existing banks or open new bank account</button>
                </div>

                <!-- Additional payment options dropdown -->
                <div id="bank_selection_dropdown" style="display: none; padding-left: 20px;">
                    <label>Select a bank:</label>
                    <select id="additional_bank_options" class="form-control">
                        <option value="Momo" data-balance="5.000.000 VND">Momo - Balance: 5.000.000 VND</option>
                        <option value="ZaloPay" data-balance="8.000.000 VND">ZaloPay - Balance: 8.000.000 VND</option>
                        <option value="PayPal" data-balance="15.000.000 VND">PayPal - Balance: 15.000.000 VND</option>
                    </select>
                    <button type="button" id="add_selected_bank" class="btn btn-primary btn-sm mt-2">Add Selected Bank</button>
                </div>
            </div>
    </div>

    <!-- Right Section: Transfer Amount -->
    <div class="card card-outline-primary">
        <h2>Transfer</h2>
        <div class="form-group">
            <label for="transfer_amount">Transfer amount</label>
            <input type="number" class="form-control" id="transfer_amount" name="amount" placeholder="0 VND" required>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-dark btn-lg" style="width: auto;" onclick="changeAction()">Transfer</button>
        </div>
        </form>
    </div>
</div>

<script>
    function changeAction() {
        // Thay đổi action của form để chuyển hướng sang confirmation_top_up
        var form = document.getElementById('transfer_form');
        form.action = window.location.origin + '/oph/?page=confirmation_transfer';
    }

    $(function(){
        // Hiển thị dropdown cho ngân hàng bổ sung khi nhấn nút "Thêm ngân hàng"
        $('#add_bank_btn').on('click', function() {
            $('#bank_selection_dropdown').toggle();
        });

        // Thêm ngân hàng đã chọn vào danh sách các tùy chọn và xóa khỏi dropdown
        $('#add_selected_bank').on('click', function() {
            const selectedBank = $('#additional_bank_options option:selected');
            const bankName = selectedBank.val();
            const bankBalance = selectedBank.data('balance');

            // Thêm ngân hàng đã chọn như một tùy chọn mới
            $('#additional_payment_options').prepend(`
                <div class="source-option d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div>${bankName}</div>
                        <div style="font-size: 0.9em;">Số dư: ${bankBalance}</div>
                    </div>
                    <input type="radio" name="payment_method" value="${bankName}" checked>
                </div>
            `);

            // Xóa ngân hàng đã chọn khỏi dropdown
            selectedBank.remove();

            // Ẩn dropdown sau khi thêm và đặt lại lựa chọn
            $('#bank_selection_dropdown').hide();
        });
    });
</script>