<?php
    include 'connection.php';

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $qry = $conn->query("SELECT * FROM staff WHERE id=".$_GET['id'])->fetch_array();
        foreach ($qry as $k => $v) {
            $$k = $v;
        }
    }
?>

<form action="" id="sub_form">
    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?>">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Full Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo isset($names) ? $names : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Contact</label>
                <input type="tel" name="phone" class="form-control" value="<?php echo isset($phone) ? $phone : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo isset($email) ? $email : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo isset($address) ? $address : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Department</label>
                <input type="text" name="dept" class="form-control" value="<?php echo isset($department) ? $department : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Salary</label>
                <input type="number" name="salary" class="form-control" value="<?php echo isset($salary) ? $salary : ""; ?>">
            </div>
        </div>
    </div>
</form>

<script>
    $('#sub_form').submit(function(e){
        e.preventDefault()
        start_loader()

        $.ajax({
            url: 'ajax.php?action=save_staff',
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
                    alert_pop("Staff data saved successfully", "success")
                    end_loader()
                    $('#uni_modal').modal('hide')
                    setTimeout(() => {
                        location.reload()
                    }, 1500);
                }

                if (resp == 2) {
                    alert_pop("Staff already exists", "danger")
                    end_loader()
                }

                if (resp == 3) {
                    alert_pop("Please input the fields", "warning")
                    end_loader()
                }

                if (resp == 4) {
                    alert_pop("Invalid Email Format", "warning")
                    end_loader()
                }

                if (resp == 5) {
                    alert_pop("Invalid Phone Number", "warning")
                    end_loader()
                }
            }
        })
    })
</script>