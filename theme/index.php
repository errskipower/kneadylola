<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kneadylola-emroth
 */

get_header();
?>
  <section class="section">
    <div class="container main-container">
      <div class="columns">
        <div class="column is-two-thirds">
          <?php get_template_part( 'template-parts/content', 'frontpage' ); ?>
        </div>
        <div class="column is-hidden-mobile">
          <?php get_sidebar(); ?>
        </div>
      </div>
    </div>
  </section>


<?php

get_footer();
