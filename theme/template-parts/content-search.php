<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kneadylola-emroth
 */

?>

<div class="columns is-multiline is-relative archive-content">
  <?php
  /* Start the Loop */
  while ( have_posts() ) :
    the_post();
    ?>
    <div class="column is-one-third">
      <?php

      /*
      * Include the Post-Type-specific template for the content.
      * If you want to override this in a child theme, then include a file
      * called content-___.php (where ___ is the Post Type name) and that will be used instead.
      */
      get_template_part( 'template-parts/content', 'post-thumbnail' );
      ?>
    </div>
    <?php

  endwhile;
  ?>
</div>
