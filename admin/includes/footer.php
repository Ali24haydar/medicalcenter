</div>

    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- magnifier popup js cdn link -->
    <script src="assets/js/jquery.magnific-popup.js"></script>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/changeView.js"></script>
    <script src="assets/js/searchBox.js"></script>
    <script src="assets/js/expandSearchBox.js"></script>
    <script src="assets/js/animatedLogin.js"></script>
    <script src="assets/js/autocomplete.js"></script>
    <script src="assets/js/validation.js"></script> 
    <script src="assets/js/sendConfEmail.js"></script> 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script> 
        $('.imageLB').magnificPopup({
            type: 'image',
            mainClass: 'mfp-with-zoom',
            zoom: {
                enabled: true,
                duration: 300,
                easing: 'ease-in-out',
            }
        });
    </script>

    <script>
    if( $('.alert').hasClass("showAlert")){
      setTimeout(function(){
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
      },5000);
    }

    $('.close-btn').click(function(){
      $('.alert').removeClass("show");
      $('.alert').addClass("hide");
    });
  </script>

</body>
</html>