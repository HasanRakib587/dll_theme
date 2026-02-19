<?php get_header(); ?>
<section>
  <div class="container-fluid">
    <!-- Top Category Heading -->
    <div class="row my-5">
      <div class="col-md-12">
        <h1 class="text-center">
          <?php
            $categories = get_the_category();
            if (!empty($categories)) {
                foreach ($categories as $cat) {
                    echo esc_html($cat->name);
                }
            }
            ?>
        </h1>
      </div>
    </div>
    <hr />
  </div>
</section>
<section>
  <div class="container-fluid">
    <div class="row">

      <!-- Main Content -->
      <div class="col-md-8">
        <div class="row g-4">
          <?php
          $category = get_queried_object();
          $category_id = $category->term_id;

          $args = array(
            'posts_per_page' => 8,
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'cat'            => $category_id,
          );

          $my_query = new WP_Query($args);

          if( $my_query->have_posts() ) :
              while( $my_query->have_posts() ) : $my_query->the_post();
          ?>
              <div class="col-md-6">
                <div class="card border-0">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <a href="<?php the_permalink(); ?>">
                          <?php the_post_thumbnail('medium', [
                              'class' => 'card-img-top rounded-0 img-fluid',
                              'alt'   => get_the_title()
                          ]); ?>
                      </a>
                    <?php endif; ?>
                    <div class="card-body text-center">
                      <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                        <h5 class="card-title"><?php the_title(); ?></h5>
                      </a>
                      <p class="card-text"><?php the_excerpt(); ?></p>
                      <?php
                      $comment_count = get_comments_number();
                      ?>
                      <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                        <span>
                          <span class="text-danger"><?php echo $comment_count; ?></span> Comments
                        </span>
                      </a>
                    </div>
                </div>
              </div>
          <?php
              endwhile;
              $max_pages = $my_query->max_num_pages;
              wp_reset_postdata();
          else:
              echo '<p>No Posts Found</p>';
          endif;
          ?>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-md-4">
          <div class="big-salad text-center">
            <div class="my-3">
              <?php get_sidebar(); ?>
            </div>
          </div>
      </div>

    </div>
    <!-- Load More Button -->
    <div class="row my-5">
      <div class="col-md-12 text-center">
        <?php if ($max_pages > 1) : ?>
            <div class="text-center my-5">
              <button id="load-more-btn" class="btn btn-outline-danger rounded-0">
                Load Previous Articles
              </button>
            </div>
          <?php endif; ?>
      </div>
    </div>
    <hr />
  </div>
</section>
<?php get_footer(); ?>
