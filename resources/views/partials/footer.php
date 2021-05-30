<section class="bg-primary promo">
    <div class="container">
        <h2>Home of the brave!!!</h2>
    </div>
</section>
<!-- footer -->
<footer id="footer">
    <div class="container">
        <div class="footer-bottom">
            <p>Copyright &copy; <?php echo Date('Y') ?> <a href="#" target="_blank">UP-GAMERZ</a>. All rights reserved.</p>
        </div>
    </div>
</footer>
<!-- /footer -->

<!-- vendor js -->
<script src="<?php echo URL; ?>assets/plugins/jquery/jquery-3.2.1.min.js"></script>
<script src="<?php echo URL; ?>assets/plugins/popper/popper.min.js"></script>
<script src="<?php echo URL; ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- plugins js -->
<script src="<?php echo URL; ?>assets/plugins/lightbox/lightbox.js"></script>
<script src="<?php echo URL; ?>assets/plugins/owl-carousel/js/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-loading-overlay/2.1.7/loadingoverlay.min.js" integrity="sha512-hktawXAt9BdIaDoaO9DlLp6LYhbHMi5A36LcXQeHgVKUH6kJMOQsAtIw2kmQ9RERDpnSTlafajo6USh9JUXckw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    (function($) {
        "use strict";

        // Full Width Carousel
        $('.owl-slide').owlCarousel({
            nav: true,
            loop: true,
            autoplay: true,
            items: 1
        });

        // Recent Reviews
        $('.owl-list').owlCarousel({
            margin: 25,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                500: {
                    items: 2
                },
                701: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });

        // lightbox
        $('[data-lightbox]').lightbox();
    })(jQuery);

    $('#register').on('submit', function (e) {
        e.preventDefault();
        const register = e.target

        // Let's call it 2 times just for fun...
        $("#register").LoadingOverlay("show");


        fetch(register.action, {
            method: register.method,
            body: new FormData(register)
        }).then(response => response.json()).then(data => {
            if (!data.status) {
                $("#register").LoadingOverlay("hide", true);
                iziToast.warning({
                    title: 'Caution',
                    message: data.message,
                });
            } else {
                $("#register").LoadingOverlay("hide", true);
                iziToast.success({
                    title: 'Success',
                    message: data.message,
                });
            }
        }).catch(exception => {
            $("#register").LoadingOverlay("hide", true);
            iziToast.success({
                title: 'Success',
                message: data.message,
            });
        })
    });

</script>

<!-- theme js -->
<script src="<?php echo URL; ?>assets/js/theme.min.js"></script>
</body>
</html>