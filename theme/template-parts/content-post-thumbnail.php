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
        <?php if (is_front_page()): ?>
          <span class="tag is-primary is-light is-uppercase">
            <?php 
            foreach (get_the_category() as $category): 
              echo $category->name;
            endforeach;
            ?>
          </span>
        <?php else: ?>
          <span class="is-uppercase is-size-7 letter-spacing-1 has-text-white">
            <?php 
            kneadylola_emroth_posted_on(false);
            ?>
          </span>
        <?php endif; ?>
        <h4 class="post-thumbnail-title title <?php echo is_front_page() ? 'is-4' : 'is-5'; ?> has-text-white has-text-weight-normal"><?php the_title(); ?></h4>
      </div>
    </a>
  </figure>
<?php endif; ?> 
