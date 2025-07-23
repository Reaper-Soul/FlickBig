<?php
	if (isset($_SESSION['auth']) && $_SESSION['auth'] === 1){
		header('Location: /home');
		die;
	}
?>
<?php require_once 'app/views/templates/header.php'?>
<main role="main" class="container  container-center">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text text-decoration-none text-white"><span class="text-decoration-underline">Login Here!</span> 🔑</h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-sm-auto">
		<form action="/login/verify" method="post" >
		<fieldset>
			<br>
			<div class="form-group">
				<label for="username" class="text-white">Username</label>
				<input required type="text" class="form-control" name="username">
			</div>
			<div class="form-group">
				<label for="password" class="text-white">Password</label>
				<input required id="password" type="password" class="form-control" name="password">
				 <input type="checkbox" id="showPassword" onclick="togglePassword()" style="margin-top: 10px;"><span style="color: white;">  Show Password</span><br><br>
			</div>
		    <div class="d-flex justify-content-center align-items-center gap-3">
					<button type="submit" class="btn d-block fw-bold" style="background-color: var(--accent-color);">Login</button>
					<a href="/create" style="color: var(--accent-color);">New User?</a>
				</div>
		</fieldset>
		</form>
		<br>
	</div>
</div>
<?php require_once 'app/views/templates/footer.php'?>

<script>
	function togglePassword() {
			const passwordField = document.getElementById("password");
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
