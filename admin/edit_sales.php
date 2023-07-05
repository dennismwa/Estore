<?php
    include 'connection.php';

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $qry = $conn->query("SELECT * FROM sales WHERE id=".$_GET['id'])->fetch_array();
        foreach ($qry as $k => $v) {
            $$k = $v;
        }
    }
?>

<form action="" id="sub_sales">
    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?>">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Sales Status</label>
                <select name="status" id="" class="form-control">
                    <option value="1" <?=$sales_status == 1 ? "selected" : "" ?>>Received</option>
                    <option value="2" <?=$sales_status == 2 ? "selected" : "" ?>>Pending</option>
                    <option value="3" <?=$sales_status == 3 ? "selected" : "" ?>>Ordered</option>
                </select>
            </div>
        </div>
    </div>
</form>

<script>
    $('#sub_sales').submit(function(e){
        e.preventDefault()
        start_loader()

        $.ajax({
            url: 'ajax.php?action=save_sales_status',
            method: 'POST',
            type: 'POST',
            data: new FormData($(this)[0]),
            cashe: false,
            contentType: false,
            processData: false,
            error: err => {
                console.log(err)
                alert("An error occured")
                end_loader()
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_pop("Sales Status updated successfully", "success")
                    end_loader()
                    $('#uni_modal').modal('hide')
                    setTimeout(() => {
                        location.reload()
                    }, 1500);
                }

                if (resp == 2) {
                    alert_pop("Category already exists", "danger")
                    end_loader()
                }

                if (resp == 3) {
                    alert_pop("Please input the fields", "warning")
                    end_loader()
                }
            }
        })
    })
</script>