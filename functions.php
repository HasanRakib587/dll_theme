<?php

function dll_theme_scripts()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('custom', get_template_directory_uri() . '/assets/css/custom.css');

    wp_enqueue_style('dl-theme', get_stylesheet_uri() . '/style.css');

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js');
}

add_action("wp_enqueue_scripts", "dll_theme_scripts");

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
    if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
        if ( array_key_exists( 'data-toggle', $atts ) ) {
            unset( $atts['data-toggle'] );
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}
function dll_theme_features_registration(){

    // Logo UploadSupport
    add_theme_support("custom-logo", array(
        'height' => 100,
        'width' => 350,        
    ));
    add_theme_support( 'post-thumbnails' );    

    //Menu Support
    register_nav_menus(array(
        'left_menu'  => __('Left Menu', 'dll_theme'),
        'right_menu' => __('Right Menu', 'dll_theme'),
        'footer_menu' => __('Footer Menu', 'dll_theme'),
    ));

}
add_action("after_setup_theme","dll_theme_features_registration");

//Custom Class to Logo Image
function custom_logo_image_class( $attr ) {
    // Check if the current image is the custom logo
    if ( isset( $attr['class'] ) && 'custom-logo' === $attr['class'] ) {
        $attr['class'] = 'img-fluid custom-logo'; // Add your desired class here
    }
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'custom_logo_image_class' );

//Comments
function theme_enqueue_comment_reply() {
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_comment_reply' );

function custom_bootstrap_comment( $comment, $args, $depth ) {

    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    ?>

    <<?php echo $tag; ?>
        <?php comment_class( 'card border-0 border-bottom comment mb-3' ); ?>
        id="comment-<?php comment_ID(); ?>"
        data-comment-id="<?php comment_ID(); ?>"
    >
        <div class="card-body">
            <h5 class="card-title">
                <span><?php comment_author(); ?></span> says
            </h5>

            <p class="card-text">
                <?php comment_text(); ?>
            </p>

            <div class="d-flex justify-content-between">
                <p class="text-muted small mb-0">
                    <?php echo get_comment_date(); ?>
                    <?php echo get_comment_time(); ?>
                </p>

                <?php
                if ( $depth < $args['max_depth'] ) {
                  if ( $comment->comment_approved == '1' ) {

                      comment_reply_link( array_merge(
                          $args,
                          array(
                              'depth'     => $depth,
                              'max_depth' => $args['max_depth'],
                              'reply_text'=> 'Reply',
                              'class'     => 'reply-btn text-decoration-none text-uppercase text-danger'
                          )
                      ) );

                  } else {
                      echo '<span class="text-warning small">Comment awaiting approval</span>';
                  }
                }
                ?>
            </div>
        </div>

        <div class="reply-placeholder"></div>

        </<?php echo $tag; ?>>
    <?php
}

// Enqueue AJAX script
function theme_load_more_scripts() {
    wp_enqueue_script(
        'load-more',
        get_template_directory_uri() . '/assets/js/load-more.js',
        array('jquery'),
        null,
        true
    );

    wp_localize_script('load-more', 'loadmore_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'theme_load_more_scripts');

// AJAX Query
function theme_load_more_posts() {

    $paged = $_POST['page'];

    $latest_posts = get_posts(array(
        'posts_per_page' => 3,
        'fields'         => 'ids'
    ));

    $two_weeks_ago = date('Y-m-d', strtotime('-2 weeks'));

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 4, // load 4 each time
        'post__not_in'   => $latest_posts,
        'paged'          => $paged,
        'date_query'     => array(
            array(
                'before'    => $two_weeks_ago,
                'inclusive' => true,
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>

            <div class="col-md-6 my-5">
                <div class="card rounded-0 border-0 text-center">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('large', ['class' => 'card-img-top img-fluid']); ?>
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

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more', 'theme_load_more_posts');
add_action('wp_ajax_nopriv_load_more', 'theme_load_more_posts');


//Social Links
function add_social_contactmethod( $methods ) {
    $methods['facebook'] = 'Facebook URL';
    $methods['instagram'] = 'Instagram URL';
    $methods['twitter'] = 'Twitter URL';
    $methods['pinterest'] = 'Pinterest URL';
    return $methods;
}
add_filter( 'user_contactmethods', 'add_social_contactmethod' );


