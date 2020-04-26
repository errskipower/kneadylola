<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kneadylola-emroth
 */

?>

<?php if (current_theme_supports('post-thumbnails') && has_post_thumbnail()) : ?>
  <figure class="image post-thumbnail-image-container">
    <a href="<?php the_permalink(); ?>" rel="bookmark">
      <?php the_post_thumbnail('post-thumbnail', ['class' => 'post-thumbnail-image']); ?>
      <div class="post-thumbnail-content has-text-centered">
        <span class="tag is-primary is-light is-uppercase">
          <?php 
          foreach (get_the_category() as $category): 
            echo $category->name;
          endforeach;
          ?>
        </span>
        <h4 class="post-thumbnail-title title is-4 has-text-white has-text-weight-normal"><?php the_title(); ?></h4>
      </div>
    </a>
  </figure>
<?php endif; ?> 
