<style>
    input:hover{
        transform: scale(1.2);
    }
</style>
<form id="sub_form">
    <h2 class="text-center mb-5"><b>Login Here<b></h2>
    <div class="form-group mb-3">
        <input type="text" name="username" placeholder="Username" class="form-control" style="width: 250px;font-weight: bold; padding: 10px 40px;text-align: center;border-radius: 22px;margin-left: 50px;">
        
        </style>
    </div>
    <div class="form-group mb-3">
        <input type="password" name="password" placeholder="*********" class="form-control"style="width: 250px;font-weight: bold;text-align: center; padding: 10px 40px; border-radius: 22px;margin-left: 50px;">
    </div>
    <input type="submit" class="btn btn-success w-100 mb-4" value="Login" style="padding: 10px 40px; border-radius: 22px;margin-left: 80px;">
    <p style="margin-left: 50px;">Don't have an account?</p>
    <a href="login.php?acc=register_data" class="btn btn-primary w-100 mt-4"style="margin-left: 70px;">Create Account</a>
</form>

<script>
    $('#sub_form').submit(function(e){
        e.preventDefault()

        $.ajax({
            url: 'process.php?p=user_auth',
            method: 'POST',
            type: 'POST',
            data: new FormData($(this)[0]),
            cashe: false,
            contentType: false,
            processData: false,
            success: function(resp) {
                if (resp == 1) {
                    alert("User account verified successfully")
                    location.href = "index.php"
                }

                if (resp ==2) {
                    alert("Invalid Credentials")
                }
            }
        })
    })
</script>