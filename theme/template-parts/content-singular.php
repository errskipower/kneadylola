<?php
/**
 * Template part for displaying a singular post
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
  <header class="entry-header has-text-centered">
    <div class="tag-link">
      <?php the_category(', '); ?>
    </div>
    <?php
    the_title( '<h1 class="entry-title title has-text-weight-normal is-2">', '</h1>' );
    if ( 'post' === get_post_type() ) :
      ?>
      <div class="entry-meta is-size-7 is-uppercase letter-spacing-1">
        <span>
          <?php kneadylola_emroth_posted_on(); ?>
        </span>
        <span class="has-text-weight-bold"> &sdot; </span>
        <span>
          <a href="#comments">
            <?php echo get_comments_number() . ' ' . get_comments_number_text('comments', 'comment', 'comments'); ?>
          </a>
        </span>
      </div><!-- .entry-meta -->
    <?php endif; ?>
  </header><!-- .entry-header -->

  <?php kneadylola_emroth_post_thumbnail(); ?>

  <div class="entry-content content">
    <?php
    the_content(
      sprintf(
        wp_kses(
          /* translators: %s: Name of current post. Only visible to screen readers */
          __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'kneadylola-emroth' ),
          array(
            'span' => array(
              'class' => array(),
            ),
          )
        ),
        wp_kses_post( get_the_title() )
      )
    );

    wp_link_pages(
      array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kneadylola-emroth' ),
        'after'  => '</div>',
      )
    );
    ?>
  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php kneadylola_emroth_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
