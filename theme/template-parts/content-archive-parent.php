<?php
/**
 * Template part for displaying an archive parent (has children)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kneadylola-emroth
 */


$term = get_queried_object();
$term_children = get_term_children($term->term_id, $term->taxonomy);

foreach ($term_children as $child_term_id):
  $term_posts = new WP_Query([
      'cat'            => $child_term_id,
      'posts_per_page' => 6,
      'orderby'        => 'date', 
      'order'          => 'DESC'
  ]);

  $child_term = get_term($child_term_id, $term->taxonomy)
  ?>
  <div class="term-child">

    <h2 class="title has-text-weight-normal is-3"><?php echo $child_term->name; ?></h2>

    <div class="columns is-multiline is-relative archive-content">

      <?php while ($term_posts->have_posts()) : $term_posts->the_post(); ?>

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
      <?php endwhile; ?>

    </div>

    <a href="<?php echo get_term_link($child_term_id, $term->taxonomy); ?>" class="button is-small is-uppercase letter-spacing-1 is-primary is-outlined">
      <span>Show me more</span>
      <span class="icon is-small">
        <i class="fas fa-caret-right"></i>
      </span> 
    </a>


  </div>

<?php
endforeach; 
