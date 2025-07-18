<?php include 'app/views/templates/alert.php'; ?>

<footer class="footer fixed-bottom pt-1" style="background-color: var(--secondary-color) !important; color: var(--text-primary) !important;">    
    <div class="column">
        <div class="row-lg-12 text-center">
            <p class="copyright my-3">flickBIG Inc. Copyright &copy; <?php echo date('Y'); ?> </p>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<style>
    .copyright::after{
        content: "";
        width: 150px;
        height: 1px;
        background-color: var(--highlight-color);
        position: absolute;
        display: block;
        left: 50%;
        transform: translateX(-50%);
        top: 80%;
    }
</style>

</body>
</html>
