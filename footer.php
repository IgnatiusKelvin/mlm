<footer class="ftco-footer ftco-section bg-danger mt-5 pt-4" style="padding-top:250px">
    <center>
        <p class="text-white">©Copyright 2022</p>
    </center>
</footer>

<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>
<script>
    feather.replace({
        'aria-hidden': 'true'
    });
    $(".togglePassword").click(function(e) {
        e.preventDefault();
        var type = $(this).parent().parent().find(".password").attr("type");
        console.log(type);
        if (type == "password") {
            $("svg.feather.feather-eye").replaceWith(feather.icons["eye-off"].toSvg());
            $(this).parent().parent().find(".password").attr("type", "text");
        } else if (type == "text") {
            $("svg.feather.feather-eye-off").replaceWith(feather.icons["eye"].toSvg());
            $(this).parent().parent().find(".password").attr("type", "password");
        }
    });
</script>
</body>

</html>