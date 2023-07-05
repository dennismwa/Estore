<?php
    include 'admin/connection.php';

    $qry = $conn->query("SELECT * FROM products WHERE id=".$_GET['id'])->fetch_array();
    foreach ($qry as $k => $val) {
        $$k = $val;
    }
?>

<form action="" id="sub_form">
    <input type="hidden" name="p_id" id="" value="<?=$_GET['id'] ?>">
    <input type="hidden" name="user_id" id="" value="<?=$_GET['user_id'] ?>">
    <input type="hidden" name="p_qty" id="" value="<?=$quantity ?>">
    <input type="hidden" name="price" id="" value="<?=$sale_price ?>">
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label for="">Quantity</label>
                <input type="number" name="qty" class="form-control" value="1">
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label for="">Total</label>
                <input type="number" name="total" class="form-control" readonly value="<?=$sale_price ?>">
            </div>
        </div>
    </div>
</form>

<script>
    $('[name="qty"]').on('keyup change', function(){
        if ($(this).val() <= 0) {
            var val = 1
            $(this).val(val)
        }

        var qty = $(this).val()
        var price = $('[name="price"]').val()

        var grand = qty * price
        $('[name="total"]').val(grand)
    })

    $('#sub_form').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: 'process.php?p=save_cart',
            method: 'POST',
            type: 'POST',
            data: new FormData($(this)[0]),
            cashe: false,
            contentType: false,
            processData: false,
            success: function(resp) {
                if (resp == 1) {
                    alert('Product Added to Cart Successfully')
                    $('#uni_modal').modal('hide')
                    location.reload()
                }

                if (resp == 2) {
                    alert('Product Already added to Cart')
                    $('#uni_modal').modal('hide')
                }

                if (resp == 3) {
                    alert('The quantity requested exceeds the stock')
                }
            }
        })
    })
</script>