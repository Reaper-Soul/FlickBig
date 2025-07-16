<?php require_once 'app/views/templates/header.php'?>
<?php include 'app/views/templates/alert.php';?>
<main role="main" class="container  container-center">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text text-decoration-none"><span class="text-decoration-underline">Login Here!</span> 🔑</h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-sm-auto">
		<form action="/login/verify" method="post" >
		<fieldset>
			<br>
			<div class="form-group">
				<label for="username">Username</label>
				<input required type="text" class="form-control" name="username">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input required id="password" type="password" class="form-control" name="password">
				 <input type="checkbox" id="showPassword" onclick="togglePassword()"> Show Password<br><br>
			</div>
		    <div class="d-flex justify-content-center align-items-center gap-3">
					<button type="submit" class="btn btn-primary d-block">Login</button>
					<a href="/create">New User?</a>
				</div>
		</fieldset>
		</form>
		<br>
	</div>
</div>	

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
