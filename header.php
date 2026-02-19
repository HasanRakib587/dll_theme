<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset') ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<nav class="mt-3 navbar navbar-expand-lg navbar-light position-relative" role="navigation">
  <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <button
        class="navbar-toggler"
        type="button" data-bs-toggle="collapse"
        data-bs-target="#bs-example-navbar-collapse-1"
        aria-controls="bs-example-navbar-collapse-1"
        aria-expanded="false"
        aria-label="<?php esc_attr_e( 'Toggle navigation', 'dll_theme' ); ?>">
          <span class="navbar-toggler-icon"></span>
      </button>
      <!-- ✅ One logo (we’ll center it responsively with CSS) -->
      <?php if(has_custom_logo()) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <a class="custom-logo-link navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/images/daily-logo.png" alt="">
        </a>
      <?php endif ?>

      <!-- Left Menu -->
      <?php
        wp_nav_menu( array(
            'theme_location'    => 'left_menu',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse justify-content-between',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'navbar-nav',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
        ));
      ?>

      <!-- Right Menu -->
      <?php
        wp_nav_menu( array(
            'theme_location'    => 'right_menu',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'navbar-nav ms-auto',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
        ));
      ?>
    </div>
</nav>
