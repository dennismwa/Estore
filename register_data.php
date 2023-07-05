<form id="sub_form">
    <h2 class="text-center mb-5">Register Here</h2>
    <div class="form-group mb-3">
        <input type="text" name="names" placeholder="Full Names" class="form-control" required style="width: 250px;font-weight: bold; padding: 10px 40px;text-align: center;border-radius: 22px;margin-left: 40px;">
    </div>
    <div class="form-group mb-3">
        <input type="text" name="username" placeholder="Username" class="form-control" required style="width: 250px;font-weight: bold; padding: 10px 40px;text-align: center;border-radius: 22px;margin-left: 40px;">
    </div>
    <div class="form-group mb-3">
        <input type="email" name="email" placeholder="email" class="form-control" required style="width: 250px;font-weight: bold; padding: 10px 40px;text-align: center;border-radius: 22px;margin-left: 40px;">
    </div>
    <div class="form-group mb-3">
        <input type="tel" name="phone" placeholder="Mobile Number" class="form-control" required style="width: 250px;font-weight: bold; padding: 10px 40px;text-align: center;border-radius: 22px;margin-left: 40px;">
    </div>
    <div class="form-group mb-3">
        <input type="password" name="password1" placeholder="New Password" class="form-control" required style="width: 250px;font-weight: bold; padding: 10px 40px;text-align: center;border-radius: 22px;margin-left: 40px;">
    </div>
    <div class="form-group mb-3">
        <input type="password" name="password2" placeholder="Confirm Password" class="form-control" required style="width: 250px;font-weight: bold; padding: 10px 40px;text-align: center;border-radius: 22px;margin-left: 40px;">
    </div>
    <input type="submit"class="btn btn-success w-100 mb-4" value="Sign Up" style="margin-left: 70px;">
    <p style="margin-left: 70px;">Already have an account?</p>
    <a href="login.php?acc=login_data" class="btn btn-primary w-100 mt-4" style="margin-left: 70px;">Login</a>
</form>

<script>
    $('#sub_form').submit(function(e){
        e.preventDefault()

        $.ajax({
            url: 'process.php?p=save_user',
            method: 'POST',
            type: 'POST',
            data: new FormData($(this)[0]),
            cashe: false,
            contentType: false,
            processData: false,
            success: function(resp) {
                if (resp == 1) {
                    alert("User account created successfully")
                    location.href = "login.php"
                }

                if (resp ==2) {
                    alert("User account already exists")
                }

                if (resp ==3) {
                    alert("Password do not match")
                }

                if (resp ==4) {
                    alert("Password must contain Uppercase, Lowercase, Number, special characters and minimum of 8 characters")
                }
            }
        })
    })
</script>