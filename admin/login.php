<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-store | Login</title>

    <!--css links-->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery.dataTables.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!--script links-->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>
    <div class="form-container">
        <div class="form-box">
            <h2 class="text-center mb-4">Admin Login</h2>
            <form action="" id="form">
                <div class="form-group mb-4">
                    <input type="text" name="username" placeholder="Enter Username" id="" class="form-control one">
                </div>
                <div class="form-group mb-4">
                    <input type="password" name="password" placeholder="**********" id="" class="form-control one">
                </div>
                <button type="submit" id="btn" class="w-100 auth_btn"><i class="fas fa-unlock"></i> login</button>
            </form>
        </div>
    </div>
</body>
</html>

<script>
    $(document).ready(function(){
        $('.auth_btn').click(function(){
            $(this).attr("disabled", true)
            $(this).html("<i class='fas fa-circle-notch fa-spin'></i> Processing.......")
            $('#form').submit()
        })


        $('#form').submit(function(e){
            e.preventDefault()

            $.ajax({
                url: 'ajax.php?action=login_auth',
                method: 'POST',
                type: 'POST',
                data: new FormData($(this)[0]),
                contentType: false,
                cashe: false,
                processData: false,
                error: err => {
                    console.log(err)
                    alert("An error occured")
                    $('.auth_btn').removeAttr("disabled", true)
                    $('.auth_btn').html("<i class='fas fa-unlock'></i> login")
                },
                success: function(resp) {
                    if (resp == 1) {
                        $('.form-box').prepend("<div class='alert alert-success'>Verified Successfully</div>")
                        setTimeout(() => {
                            location.href = "index.php?page=home";
                        }, 1500);
                    }

                    if (resp == 2) {
                        alert("Invalid Credentials")
                        $('.auth_btn').removeAttr("disabled", true)
                        $('.auth_btn').html("<i class='fas fa-unlock'></i> login")
                    }
                }
            })
        })
    })
</script>