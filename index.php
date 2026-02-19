<?php get_header(); ?>

<!-- Main Content -->
<section>
  <div class="container">
    <div class="row d-flex justify-content-between">
      <div class="col-md-8">
        <!-- Latest Articles -->
        <section>
          <?php
            // Define custom query arguments
            $args = array(
              'post_type'      => 'post',
              'posts_per_page' => 3, // Number of posts to show
              'post_status'    => 'publish'
            );
            // Create a new WP_Query instance
            $my_query = new WP_Query( $args );
            if($my_query->have_posts()) :
              while ($my_query->have_posts()) : $my_query->the_post();?>
                <!-- Latest Articles 1 -->
                <div class="card border-0 my-5">
                  <?php if ( has_post_thumbnail() ) :?>
                      <?php
                        the_post_thumbnail('full', [
                            'class' => 'card-img-top rounded-0 img-fluid',
                            'alt'   => get_the_title()
                        ]);
                      ?>
                  <?php endif; ?>
                  <div class="card-body text-center">
                    <div class="creation-date my-2">
                      <span class="post-meta small px-1"><?php the_date(); ?></span>
                      <span
                        class="d-inline-block bg-danger rounded-circle"
                        style="width: 10px; height: 10px"
                      ></span>

                      <span class="small px-1"><?php the_author(); ?></span>
                    </div>
                    <h5 class="card-title"><?php the_title(); ?></h5>
                    <p class="card-text"><?php the_excerpt(); ?></p>
                  </div>
                  <div
                    class="card-body d-flex justify-content-between align-items-center"
                  >
                    <a href="<?php the_permalink(); ?>" class="card-link btn btn-outline-danger rounded-0"
                      >Continue Reading</a
                    >
                    <a href="<?php comments_link(); ?>" class="card-link text-decoration-none text-black">
                      <span>
                        <?php
                          $comment_count = get_comments_number();

                          if ( $comment_count > 0 ) {
                              echo '<span class="text-danger">' . $comment_count . '</span> Comments';
                          } else {
                              echo '<span class="text-danger">0</span> Comments';
                          }
                        ?>
                      </span>
                    </a>
                  </div>
                </div>
          <?php endwhile;
            wp_reset_postdata(); // VERY IMPORTANT
          else:
              echo '<p>No Posts Found</p>';
          endif;?>
          <hr class="text-primary" />
        </section>
        <!-- Older Posts -->
        <section id="older-posts-section">
          <div class="row" id="older-posts-container">

            <?php
            // Get latest 3 post IDs
            $latest_posts = get_posts(array(
                'posts_per_page' => 3,
                'fields'         => 'ids'
            ));

            $two_weeks_ago = date('Y-m-d', strtotime('-2 weeks'));

            $args = array(
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => 4, // ✅ show 4 by default
                'post__not_in'   => $latest_posts,
                'paged'          => 1,
                'date_query'     => array(
                    array(
                        'before'    => $two_weeks_ago,
                        'inclusive' => true,
                    ),
                ),
            );

            $older_posts = new WP_Query($args);

            if ($older_posts->have_posts()) :
                while ($older_posts->have_posts()) :
                    $older_posts->the_post(); ?>

                    <div class="col-md-6 my-5">
                        <div class="card rounded-0 border-0 text-center">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('full', ['class' => 'card-img-top img-fluid']); ?>
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-black">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                </p>
                                <a href="<?php comments_link(); ?>" class="text-decoration-none">
                                    <?php comments_number(
                                        '<span class="text-danger">0</span> Comments',
                                        '<span class="text-danger">1</span> Comment',
                                        '<span class="text-danger">%</span> Comments'
                                    ); ?>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endwhile;
            endif;

            $max_pages = $older_posts->max_num_pages;
            wp_reset_postdata();
            ?>

          </div>

          <?php if ($max_pages > 1) : ?>
            <div class="text-center my-5">
              <button id="load-more-btn" class="btn btn-outline-danger rounded-0">
                Load Previous Articles
              </button>
            </div>
          <?php endif; ?>
        </section>
      </div> 
      <div class="col-md-3">
        <!-- Author Info -->
        <?php
        $author_id = 1; // Change to your main author ID
        $author = get_userdata($author_id);
        ?>

        <div class="card mb-3 my-5 rounded-0">
          
          <?php echo get_avatar($author_id, 600, '', '', [
              'class' => 'card-img-top img-fluid rounded-0'
          ]); ?>

          <div class="card-body bg-warning text-center">
            <h5 class="card-title">
              <?php echo esc_html($author->display_name); ?>
            </h5>
            <p>
                <?php if (!empty($author->description)) : ?>
                    <p class="card-text my-3">
                      <?php echo esc_html($author->description); ?>
                    </p>
                  <?php endif; ?>
            </p>            
            <div class="card-text social my-3">
              <?php 
                set_query_var( 'class_to_add', 'text-dark' );
                get_template_part( 'partials/social-links'); 
              ?>
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <?php get_sidebar(); ?>
      </div>
    </div> 
  </div>        
</section>

<!-- Archives -->
<section>
  <div class="container">
    <hr>
    <div class="row gap-5 justify-content-center">

      <h1 class="text-center my-5">From the archives</h1>

      <?php
      $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'category_name'  => 'archive'
      );

      $archive_query = new WP_Query($args);

      if ($archive_query->have_posts()) :
        while ($archive_query->have_posts()) :
          $archive_query->the_post();
      ?>

        <div class="col-md-3">
          <div class="card text-center rounded-0 border-0">

            <!-- Featured Image -->
            <a href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail()) :
                the_post_thumbnail('medium', ['class' => 'card-img-top']);
              else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/archive-feat.png"
                     class="card-img-top" alt="">
              <?php endif; ?>
            </a>

            <div class="card-body">

              <!-- Category (first category except archive) -->
              <h6>
                <?php
                  $categories = get_the_category();
                  foreach ($categories as $cat) {
                    if ($cat->slug !== 'archive') {
                      echo '<a class="text-decoration-none my-5" href="' 
                           . get_category_link($cat->term_id) . '">' 
                           . esc_html($cat->name) . '</a>';
                      break;
                    }
                  }
                ?>
              </h6>

              <h5 class="card-title">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                  <?php the_title(); ?>
                </a>
              </h5>

              <p class="card-text">
                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
              </p>

              <a href="<?php comments_link(); ?>" class="btn">
                <?php comments_number(
                  '<span class="text-danger">0</span> comments',
                  '<span class="text-danger">1</span> comment',
                  '<span class="text-danger">%</span> comments'
                ); ?>
              </a>

            </div>
          </div>
        </div>

      <?php
        endwhile;
        wp_reset_postdata();
      else :
        echo '<p class="text-center">No archived posts found.</p>';
      endif;
      ?>

    </div>
  </div>
</section>

<?php get_footer(); ?>
