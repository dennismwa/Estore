<?php
    include 'inc/top.php';
    $qry = $conn->query("SELECT * FROM products WHERE id=".$_GET['id'])->fetch_array();
    foreach ($qry as $k => $v) {
        $$k = $v;
    }

    $vat = $price * 0.02;
    $grand = $price + ($price * 0.02);

?>



<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h1><?php echo $name; ?></h1>
            <p><strong>Price: </strong>Ksh.<?php echo number_format($price, 0) ?></p>
            <p><strong>Quantity In Stock: </strong><?php echo $units ?></p>
        </div>
        <div class="col-md-6">
            <form action="" id="sub_form">
                <input type="hidden" name="user_id" value="<?php echo $m['id']; ?>">
                <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="number" name="qty" min="1" class="form-control" value="1">
                </div>
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="hidden" name="product_id" value="<?php echo $_GET['id']; ?>">
                <div class="form-group">
                    <label for="">Total</label>
                    <input type="number" name="total" class="form-control" readonly value="<?php echo $price; ?>">
                </div>
                <div class="form-group">
                    <label for="">VAT (2%)</label>
                    <input type="number" name="vat" class="form-control" readonly value="<?php echo $vat; ?>">
                </div>
                <div class="form-group">
                    <label for="">Grand Total</label>
                    <input type="number" name="grand" class="form-control" readonly value="<?php echo $grand; ?>">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('[name="qty"]').keyup(function(){
        var qty = $('[name="qty"]').val()
        var price = $('[name="price"]').val()
        var total = qty * price
        var vat = total * 0.02
        var grand = total + vat
        $('[name="total"]').val(total)
        $('[name="vat"]').val(vat)
        $('[name="grand"]').val(grand)
    })

    $('[name="qty"]').change(function(){
        var qty = $('[name="qty"]').val()
        var price = $('[name="price"]').val()
        var total = qty * price
        var vat = total * 0.02
        var grand = total + vat
        $('[name="total"]').val(total)
        $('[name="vat"]').val(vat)
        $('[name="grand"]').val(grand)
    })

    $('#sub_form').submit(function(e){
        e.preventDefault()

        $.ajax({
            url: 'process.php?p=save_cart',
            method: 'POST',
            type: 'POST',
            data: new FormData($(this)[0]),
            cashe: false,
            contentType: false,
            processData: false,
            error: err => {
                console.log(err)
                alert("An error occured while processing")
            },
            success:function(resp) {
                if (resp == 1) {
                    alert("Added to cart")
                    $('#uni_modal').modal('hide')
                    location.reload()
                }

                if (resp == 2) {
                    alert("Quantity exceeds the stock")
                }

                if (resp == 3) {
                    alert("Quantity cannot be emptys")
                }
            }
        })
    })
</script>