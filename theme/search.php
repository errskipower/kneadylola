<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package kneadylola-emroth
 */

get_header();
?>

<section class="section">
  <div class="container main-container">
    <div class="columns">
      <div class="column is-two-thirds">
        <section id="primary" class="content-area">
          <main id="main" class="site-main">

          <?php if ( have_posts() ) : ?>

            <header class="page-header has-text-centered">
              <div class="is-size-7 is-uppercase letter-spacing-1">Search results for</div>
              <h1 class="page-title title has-text-weight-normal is-2">
                <?php
                /* translators: %s: search query. */
                printf( esc_html__( '%s', 'kneadylola-emroth' ), '<span>' . get_search_query() . '</span>' );
                ?>
              </h1>
            </header><!-- .page-header -->

            <?php
            get_template_part( 'template-parts/content', 'search' );

            the_posts_navigation();

          else :

            get_template_part( 'template-parts/content', 'none' );

          endif;
          ?>

          </main><!-- #main -->
        </section><!-- #primary -->

      </div>
      <div class="column is-hidden-mobile">
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
</section>


<?php
get_footer();
