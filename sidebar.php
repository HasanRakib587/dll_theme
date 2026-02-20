<?php
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
        'category_name'  => 'trending'
    );

    $trending_query = new WP_Query($args);
?>
<?php if($trending_query->have_posts()) : ?>
    <!-- Sidebar -->
    <div class="text-center" style="margin-top: 70vh">
        <hr class="text-primary" />
        <h3>Most Popular</h3>
        <div class="my-3">
    
        <?php
        if ($trending_query->have_posts()) :
            $count = 1;
            while ($trending_query->have_posts()) :
            $trending_query->the_post();
        ?>
    
            <div class="popular-posts my-5">
            <h3 class="lead">
                <?php echo str_pad($count, 2, '0', STR_PAD_LEFT); ?>
            </h3>
    
            <a class="text-decoration-none" href="<?php the_permalink(); ?>">
                <h2 class="lead">
                <?php the_title(); ?>
                </h2>
            </a>
            </div>
    
        <?php
            $count++;
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No trending posts found.</p>';
        endif;
        ?>
    
        <hr class="text-primary" />
        </div>
    </div>
<?php endif ?>
