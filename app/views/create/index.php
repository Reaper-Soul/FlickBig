<?php require_once 'app/views/templates/header.php'?>
<?php include 'app/views/templates/components/alert.php';?>
<main role="main" class="container container-center">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text text-decoration-none"><span class="text-decoration-underline">Create Account!</span> 🔑</h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-sm-auto">
        <form action="/create/verify" method="post" >
        <fieldset>
            <div class="w-50 mx-auto">
            <div class="form-group">
                <label for="username">Username</label>
                <input required type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input required type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input required type="password" class="form-control" name="confirm-password">
            </div>
            </div>
            <br>
            <p class="text-danger w-60 text-center small mx-auto">Note: The password should be a mix of uppercase and lowercase letters and must be more than 10 letters.</p>
            <div class="d-flex justify-content-center align-items-center gap-3">
                <button type="submit" class="btn btn-primary d-block">Sign Up</button>
                <a href="/login">Already have an account?</a>
            </div>
        </fieldset>
        </form>
        <br>
    </div>
</div>

<style>
    main.container-center {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }
</style>