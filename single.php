<?php get_header(); ?>

<section>
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
    ?>
        <div class="container">
          <hr class="my-5" />
          <div class="article-meta d-flex justify-content-between">
            <p><?php the_date(); ?></p>
            <p>
              <?php
                $categories = get_the_category();
                if (!empty($categories)) {
                    foreach ($categories as $cat) {
                        echo '<a class="text-decoration-none text-black text-uppercase" href="' . esc_url(get_category_link($cat->term_id)) . '" class="badge bg-secondary me-1">';
                        echo esc_html($cat->name);
                        echo '</a>';
                    }                    
                }
                ?>
            </p>
            <p class="text-uppercase">
              by <span class="text-danger"><?php the_author(); ?></span>
            </p>
          </div>
          <div class="article-heading text-center my-5">
            <h1><?php the_title(); ?></h1>
          </div>
          <div class="article-cover">
            <div class="row">
              <div class="col-md-12 mx-auto my-5">
                <img src="./images/19x10.png" class="img-fluid" alt="" />
              </div>
            </div>
          </div>
        </div>
    <?php
        endwhile;
    endif;
    ?>
  <div class="container-fluid">
    <div class="article-content">
      <div class="row g-5 justify-content-between my-5">
        <div class="col-md-2 mx-auto">
          <hr />
          <a href="#allComments" class="card-link text-decoration-none text-black">
            <span class="text-danger">
              <?php echo get_comments_number(); ?>
            </span>
            <?php comments_number( 'Comment', 'Comment', 'Comments' ); ?>
          </a>

          <a
            href="#commentForm"
            id="topWriteCommentLink"
            class="btn btn-outline-danger rounded-0 my-3"
          >
            Write a comment
          </a>
        </div>
        <div class="col-md-7 my-5">
          <article class="text-center">
            <?php the_content(); ?>
          </article>

          <hr class="my-5" />
          <!-- Tags -->
          <div class="tags">
            <span>Tags:</span>
            <?php
              $tags = get_the_tags(); // Returns an array of WP_Term objects or false if none

              if ( $tags ) {
                  foreach ( $tags as $tag ) {
                      echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) )
                      .'" class="text-decoration-none text-danger px-1">';
                      echo esc_html( $tag->name );
                      echo '</a>';
                  }
              }else{ echo ' <span>No Tags</span>';}
            ?>
            <!-- social links -->
            <div class="my-3">
              <?php 
                set_query_var( 'class_to_add', 'text-dark' );
                get_template_part( 'partials/social-links'); 
              ?>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <?php get_sidebar(); ?>
        </div>
      </div>
      <hr />
    </div>
    <div class="article-footer mt-5">
      <div class="container">
        <div class="row align-items-center text-md-start">
          <!-- Next / Previous -->
          <div class="col-md-12 d-flex justify-content-between order-1">
            <?php
              $prev_post = get_previous_post();
              $next_post = get_next_post();
            ?>
            <!-- Previous -->
            <?php if ( $prev_post ) : ?>
              <a class="text-decoration-none" href="<?php echo get_permalink( $prev_post->ID ); ?>">
                ← Previous Article ?>
              </a>
            <?php else : ?>
              <span></span>
            <?php endif; ?>
            <!-- Next -->
            <?php if ( $next_post ) : ?>
              <a class="text-decoration-none" href="<?php echo get_permalink( $next_post->ID ); ?>">
                Next Article →
              </a>
            <?php else : ?>
              <span></span>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php
      if ( comments_open() || get_comments_number() ) :
          comments_template();
      endif;
      ?>
</section>
<?php get_footer(); ?>
