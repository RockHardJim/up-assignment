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
</script>

<!-- theme js -->
<script src="<?php echo URL; ?>assets/js/theme.min.js"></script>
</body>
</html>