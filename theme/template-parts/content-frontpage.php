<?php
/**
 * Template part for displaying the frontpage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kneadylola-emroth
 */

 const MAX_LARGE_POST_COUNT = 3;

?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">

  <?php
  if ( have_posts() ) :

    if ( is_home() && ! is_front_page() ) :
      ?>
        <header>
          <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
        </header>
        <?php
      endif;

      /* Start the Loop */
      $post_count = 1;
      while ( have_posts()) :
        the_post();

        /*
          * Include the Post-Type-specific template for the content.
          * If you want to override this in a child theme, then include a file
          * called content-___.php (where ___ is the Post Type name) and that will be used instead.
          */
        if (get_post_type() === 'post' && $post_count > MAX_LARGE_POST_COUNT && !is_singular()):
          if ($post_count === (MAX_LARGE_POST_COUNT + 1)): ?>
            <div class="columns is-multiline is-relative">
          <?php
          endif;
          // show 3 most recent posts, then thumbnail posts for the rest
          ?>
          <div class="column is-half">
          <?php
            get_template_part('template-parts/content', 'post-thumbnail');
          ?>
          </div>
        <?php
        else: 
          get_template_part('template-parts/content', get_post_type());
        endif;

        $post_count++;

      endwhile;

      if ($post_count > MAX_LARGE_POST_COUNT): 
        echo do_shortcode('[ajax_load_more container_type="div" post_type="post" posts_per_page="6" offset="4" pause="true" images_loaded="true" scroll="false"]');
      ?>
        
        </div>
      <?php
      endif;

      // the_posts_navigation();

    else :
      get_template_part( 'template-parts/content', 'none' );

  endif;
  ?>
  </main><!-- #main -->
</div><!-- #primary -->