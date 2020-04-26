<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kneadylola-emroth
 */

?>

<?php
if (is_singular()):
  get_template_part( 'template-parts/content', 'singular' );
else:
?>
  <article class="columns">
    <figure class="column is-half">
      <p class="image">
        <?php kneadylola_emroth_post_thumbnail(); ?>
      </p>
    </figure>
    <div class="column is-half">
      <div class="content">
        <div class="tag-link">
          <?php the_category(', '); ?>
        </div>
        <?php 
        the_title(
          '<h2 class="entry-title title has-text-weight-normal is-4">
            <a class="post-title-link" href="' . get_the_permalink() . '">', 
          '</a></h2>'
        ); 
        ?>
        <div class="entry-meta is-size-7 is-uppercase letter-spacing-1">
          <?php
          kneadylola_emroth_posted_on();
          ?>
        </div><!-- .entry-meta -->
        <div class="entry-content">
          <?php the_excerpt(); ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="button is-small is-uppercase letter-spacing-1 is-primary is-outlined">
          <?php 
          echo sprintf(
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
          );
          ?>
        </a>
      </div>
    </div>
  </article>
<?php endif; ?>