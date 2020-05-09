<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kneadylola-emroth
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'kneadylola-emroth'); ?></a>

  <header>
    <section class="hero">
      <div class="hero-body">
        <div class="container has-text-centered is-family-secondary">
          <h1 class="title site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a>
          </h1>
          <h2 class="subtitle site-description has-text-primary has-text-weight-bold"><?php bloginfo('description'); ?></h2>
        </div>
      </div>
    </section>

    <nav class="navbar" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <!-- <a class="navbar-item" href="https://bulma.io">
          <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
        </a> -->

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="mainNavbar">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>

      <?php
      wp_nav_menu(
        [
          'theme_location' => 'menu-1',
          'container'      => false,
          'menu_class'     => 'navbar-menu is-uppercase letter-spacing-1',
          'menu_id'        => 'mainNavbar',
          'after'          => "</div>",
          'walker'         => new \Navwalker
        ]
      );
      ?>

    </nav>
  </header>

  <div id="content" class="site-content">
