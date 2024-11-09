<?php require_once('./config.php') ?>

<div class="container py-5">
    <div class="card card-outline-primary">
        <div class="card-header">
            <h5 class="card-title">Top Up</h5>
        </div>
        <div class="card-body">
            <form action="" id="top_up_form">
                <div class="form-group">
                    <label for="top_up_amount" class="control-label">Top-up amount</label>
                    <input type="number" class="form-control" id="top_up_amount" name="top_up_amount" placeholder="0 VND" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Source of fund</label>
                    <div class="source-option">
                        <label class="d-flex justify-content-between align-items-center">
                            <span>Vietcombank</span>
                            <span>Balance: 20.000.000 VND</span>
                            <input type="radio" name="source" value="Vietcombank" required>
                        </label>
                    </div>
                    <div class="source-option">
                        <label class="d-flex justify-content-between align-items-center">
                            <span>VISA</span>
                            <span>Balance: 10.000.000 VND</span>
                            <input type="radio" name="source" value="VISA" required>
                        </label>
                    </div>
                    <div class="source-option">
                        <label class="d-flex justify-content-between align-items-center">
                            <span>Add banks</span>
                            <input type="button" class="btn btn-sm btn-primary" value="Link with existing banks or open new bank account">
                        </label>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Top Up</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#top_up_form').submit(function(e){
            e.preventDefault();
            var form = $(this);
            var amount = $('#top_up_amount').val();
            var source = $('input[name="source"]:checked').val();

            if(amount <= 0){
                alert("Please enter a valid top-up amount.");
                return false;
            }

            start_loader(); // Assuming you have a loading indicator

            $.ajax({
                url: _base_url_ + "classes/Master.php?f=top_up",
                method: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function(resp){
                    if(resp.status == 'success'){
                        alert("Top-up successful!");
                        location.reload();
                    } else {
                        alert("Error: " + resp.msg);
                    }
                    end_loader();
                },
                error: function(err){
                    console.log(err);
                    alert("An error occurred during the top-up process.");
                    end_loader();
                }
            });
        });
    });
</script>
