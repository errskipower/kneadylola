<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kneadylola-emroth
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('is-relative'); ?>>
  <?php
    edit_post_link(
      '<i class="fas fa-edit fa-xs"></i>',
      '<span class="edit-link"><span class="icon has-text-grey">',
      '</span></span>'
    );
  ?>
  <header class="entry-header">
    <?php the_title( '<h1 class="entry-title title has-text-weight-normal is-2 has-text-centered">', '</h1>' ); ?>
  </header><!-- .entry-header -->

  <?php kneadylola_emroth_post_thumbnail(); ?>

  <div class="entry-content content">
    <?php
    the_content();

    wp_link_pages(
      array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kneadylola-emroth' ),
        'after'  => '</div>',
      )
    );
    ?>
  </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
