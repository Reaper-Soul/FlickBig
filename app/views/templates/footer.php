<footer class="footer fixed-bottom pt-1" style="background-color: var(--secondary-color) !important; color: var(--text-primary) !important;">    
    <div class="column">
        <div class="row-lg-12 text-center">
            <p class="copyright my-3">flickBIG Inc. Copyright &copy; <?php echo date('Y'); ?> </p>
        </div>
    </div>
</footer>

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
