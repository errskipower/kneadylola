<?php
/**
 * The template for displaying archive pages
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
          <div id="primary" class="content-area">
            <main id="main" class="site-main">

            <?php if ( have_posts() ) : ?>

              <header class="page-header has-text-centered">
                <?php
                the_archive_title( '<h1 class="page-title title has-text-weight-normal is-2">', '</h1>' );
                the_archive_description( '<div class="archive-description is-size-7 is-uppercase letter-spacing-1">', '</div>' );
                ?>
              </header><!-- .page-header -->
              
              <?php
              $term = get_queried_object();
              $term_children = get_term_children($term->term_id, $term->taxonomy);
              $has_children = count($term_children) > 0;

              if ($has_children):
                get_template_part( 'template-parts/content', 'archive-parent' );
              else:
                get_template_part( 'template-parts/content', 'archive-child' );
              endif;
              ?>
              
              <?php
              the_posts_navigation();

            else :

              get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>

            </main><!-- #main -->
          </div><!-- #primary -->
        </div>
        <div class="column is-hidden-mobile">
          <?php get_sidebar(); ?>
        </div>
      </div>
    </div>
  </section>

<?php
get_sidebar();
get_footer();
