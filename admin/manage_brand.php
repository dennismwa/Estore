<?php
    include 'connection.php';

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $qry = $conn->query("SELECT * FROM brand WHERE id=".$_GET['id'])->fetch_array();
        foreach ($qry as $k => $val) {
            $$k = $val;
        }
    }
?>

<form action="" id="sub_form">
    <input type="hidden" name="id" value="<?=isset($_GET['id']) ? $_GET['id'] : ""; ?>">
    <div class="form-group mb-3">
        <label for="">Brand Name</label>
        <input type="text" class="form-control" name="name" value="<?=isset($name) ? $name : ""; ?>">
    </div>
    <div class="form-group mb-3">
        <label for="">Brand Description</label>
        <textarea name="desc" id="" cols="30" rows="5" class="form-control">
            <?=isset($description) ? $description : ""; ?>
        </textarea>
    </div>
</form>

<script>
    $('#sub_form').submit(function(e){
        e.preventDefault()
        start_loader()

        $.ajax({
            url: 'ajax.php?action=save_brand',
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
                    alert_pop("Brand data saved successfully", "success")
                    end_loader()
                    $('#uni_modal').modal('hide')
                    setTimeout(() => {
                        location.reload()
                    }, 1500);
                }

                if (resp == 2) {
                    alert_pop("Brand already exists", "danger")
                    end_loader()
                }

                if (resp == 3) {
                    alert_pop("Please input the fields", "warning")
                    end_loader()
                }
            }
        })
    })

    $(document).ready(function(){})
</script>