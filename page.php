<?php get_header(); ?>

<div class="container my-5">
    <main id="main" class="site-main" role="main">
        <!-- Your custom PHP code and HTML goes here -->
        <?php
        while ( have_posts() ) : the_post();
            the_content(); // Displays content from the WordPress editor
        endwhile;
        ?>
    </main>
</div>

<?php get_footer(); ?>
