<footer class="page-footer text-white">
    <div class="container footer-items">
        <div class="text-center pt-5">
            <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>">
                <img src="/images/logo-white.png" alt="sticks and stones logo white" id="foot-logo">
            </a>
        </div>
        <div class="row text-center d-flex justify-content-center pt-5 mb-3 footer-links">
            <div class="col-md-2 mb-3">
                <a href="/index.php" class="text-white link-hover py-1">Home</a>
            </div>
            <div class="col-md-2 mb-3">
                <a href="/hikes.php" class="text-white link-hover py-1">Hikes</a>
            </div>
            <div class="col-md-2 mb-3">
                <a href="/articles.php" class="text-white link-hover py-1">Blog</a>
            </div>
            <div class="col-md-2 mb-3">
                <a href="/contact.php" class="text-white link-hover py-1">Contact</a>
            </div>
        </div>
    </div>
    <hr class="footer-hr">
    <div class="hrr justify-content-center"></div>
    <div class="footer-copyright text-center py-3">© 2019 Copyright Sticks & Stones</div>
</footer>
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 6000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>
    <script src="/scripts.js"></script>

</body>
</html>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
?>