<?php
    if (isset($_SESSION['auth']) && $_SESSION['auth'] === 1){
        header('Location: /home');
        die;
    }
?>
<?php require_once 'app/views/templates/header.php'?>
    <main role="main" class="container container-center">
      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="text text-decoration-none text-white">
              <span class="text-decoration-underline">Create Account!</span> 🔑
            </h1>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-auto">
          <form action="/create/verify" method="post" style="max-width: 300px;">
            <fieldset>
              <br>
              <div class="form-group">
                <label for="username" class="text-white">Username</label>
                <input required type="text" class="form-control" name="username">
              </div>
              <div class="form-group">
                <label for="password" class="text-white">Password</label>
                <input required type="password" class="form-control" id="password" name="password">
              </div>
              <div class="form-group">
                <label for="confirm-password" class="text-white">Confirm Password</label>
                <input required type="password" class="form-control" id="confirm-password" name="confirm-password">
                <input type="checkbox" id="showPassword" onclick="togglePassword()" style="margin-top: 10px;">
                <span class="text-white"> Show Password</span><br><br>
              </div>

              <p class="text-danger text-center small">
                Note: The password should be a mix of uppercase and lowercase letters and must be more than 10 letters.
              </p>

              <div class="d-flex justify-content-center align-items-center gap-3">
                <button type="submit" class="btn fw-bold" style="background-color: var(--accent-color);">
                  Sign Up
                </button>
                <a href="/login" style="color: var(--accent-color);">Already have an account?</a>
              </div>
            </fieldset>
          </form>
          <br>
        </div>
      </div>
    </main>
<?php require_once 'app/views/templates/footer.php'?>

<script>
    function togglePassword() {
            const passwordField = document.getElementById("password");
            const confirmpasswordField = document.getElementById("confirm-password");
            confirmpasswordField.type = confirmpasswordField.type === "password" ? "text" : "password";
            passwordField.type = passwordField.type === "password" ? "text" : "password";
    }
</script>

<style>
    main.container-center {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }
</style>