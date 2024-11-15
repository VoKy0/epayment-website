<?php require_once('./config.php') ?>

<div class="container py-5">
    <div class="card card-outline-primary" style="padding: 20px; border-radius: 15px;">
        <h2 style="font-weight: bold; font-size: 24px;">Top Up</h2>
        <form action="confirmation_top_up.php" method="POST" id="top_up_form"> <!-- Chuyển hướng đến confirmation_top_up.php -->
            <div class="form-group">
                <label for="top_up_amount" class="control-label">Top-up amount</label>
                <input type="number" class="form-control" id="top_up_amount" name="amount" placeholder="0 VND" required>
            </div>
            <div class="form-group">
                <label class="control-label">Source of fund</label>

                <!-- Vietcombank Option -->
                <div class="source-option d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div>Vietcombank</div>
                        <div style="font-size: 0.9em;">Balance: 20.000.000 VND</div>
                    </div>
                    <input type="radio" name="payment_method" value="Vietcombank" required>
                </div>

                <!-- VISA Option -->
                <div class="source-option d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div>VISA</div>
                        <div style="font-size: 0.9em;">Balance: 10.000.000 VND</div>
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
            <div class="form-group text-center">
                <button type="submit" class="btn btn-dark btn-lg" style="width: 100px;" onclick="changeAction()">Top Up</button>
            </div>
        </form>
    </div>
</div>

<script>
    function changeAction() {
        // Thay đổi action của form để chuyển hướng sang confirmation_top_up
        var form = document.getElementById('top_up_form');
        form.action = window.location.origin + '/oph/?page=confirmation_top_up'; // Thay đổi action của form
    }

    $(function(){
        // Show dropdown for additional banks on "Add banks" button click
        $('#add_bank_btn').on('click', function() {
            $('#bank_selection_dropdown').toggle();
        });

        // Add selected bank to the options list and remove it from the dropdown
        $('#add_selected_bank').on('click', function() {
            const selectedBank = $('#additional_bank_options option:selected');
            const bankName = selectedBank.val();
            const bankBalance = selectedBank.data('balance');

            // Add selected bank as a new option
            $('#additional_payment_options').prepend(`
                <div class="source-option d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div>${bankName}</div>
                        <div style="font-size: 0.9em;">Balance: ${bankBalance}</div>
                    </div>
                    <input type="radio" name="payment_method" value="${bankName}" checked>
                </div>
            `);

            // Remove the selected bank from the dropdown
            selectedBank.remove();

            // Hide dropdown after adding and reset selection
            $('#bank_selection_dropdown').hide();
        });
    });
</script>
