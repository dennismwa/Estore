<?php
    include 'connection.php';

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $qry = $conn->query("SELECT * FROM users WHERE id=".$_GET['id'])->fetch_array();
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
                <label for="">Customer Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo isset($names) ? $names : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Customer Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo isset($username) ? $username : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Customer Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo isset($email) ? $email : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Customer Contact</label>
                <input type="tel" name="phone" class="form-control" value="<?php echo isset($phone) ? $phone : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Customer Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo isset($password) ? $password : ""; ?>">
            </div>
        </div>
    </div>
</form>

<script>
    $('#sub_form').submit(function(e){
        e.preventDefault()
        start_loader()

        $.ajax({
            url: 'ajax.php?action=save_customer',
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
                    alert_pop("Customer data saved successfully", "success")
                    end_loader()
                    $('#uni_modal').modal('hide')
                    setTimeout(() => {
                        location.reload()
                    }, 1500);
                }

                if (resp == 2) {
                    alert_pop("Customer already exists", "danger")
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