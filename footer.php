<footer class="bg-dark mt-5 py-5">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-md-8 text-light">
                <?php 
                    wp_nav_menu( array(
                        'theme_location'    => 'footer_menu',
                        'menu_class'        => 'navbar-nav footer-menu',
                    ));
                ?>
            </div>
            <!-- social Links -->
            <div class="col-md-4 d-flex flex-wrap gap-3 my-3">
                <?php 
                    set_query_var( 'class_to_add', 'text-light' );
                    get_template_part( 'partials/social-links' ); 
                ?>
            </div>
            <div class="col-md-12">
                <p class="m-0 text-secondary">Copyright &copy; All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
    <script>
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }

        window.addEventListener('load', function () {
            window.scrollTo(0, 0);
        });
    </script>
</body>
</html>


