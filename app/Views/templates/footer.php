<!-- End page content -->
</div>
</main>
<footer class="footer mt-auto py-3 bg-light">
<div class="container">
<span class="text-muted">&copy; Web Based Technologies 2023</span>
</div>
</footer>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
crossorigin="anonymous">
</script>



<script>
    var loginButton = document.getElementById('login-button');
    var loginPopup = document.getElementById('login-popup');
    var registerButton = document.getElementById('register-button');
    var registerPopup = document.getElementById('register-popup');

    loginButton.addEventListener('click', function() {
        loginPopup.style.display = 'block';
    });

    registerButton.addEventListener('click', function() {
        registerPopup.style.display = 'block';
    });
</script>


</body>
</html>