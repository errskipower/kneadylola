<?php
/**
 * Top Posts ultimate posts widget template
 *
 * @version     2.1.1
 */
?>

<?php if ($instance['before_posts']) : ?>
  <div class="upw-before">
    <?php echo wpautop($instance['before_posts']); ?>
  </div>
<?php endif; ?>

<div class="upw-posts hfeed">

  <?php if ($upw_query->have_posts()) : ?>
    
    <div class="columns is-multiline is-variable is-1">

      <?php while ($upw_query->have_posts()) : $upw_query->the_post(); ?>

        <?php $current_post = ($post->ID == $current_post_id && is_single()) ? 'active' : ''; ?>

        <div class="column is-half">

            <?php if (current_theme_supports('post-thumbnails') && $instance['show_thumbnail'] && has_post_thumbnail()) : ?>
              <figure class="image top-posts-image-container">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                  <?php the_post_thumbnail($instance['thumb_size']); ?>
                  <?php if (get_the_title() && $instance['show_title']) : ?>
                    <h4 class="top-posts-title has-text-centered has-text-white"><?php the_title(); ?></h4>
                  <?php endif; ?>
                </a>
              </figure>
            <?php endif; ?>
          
        </div>

      <?php endwhile; ?>

    </div>

  <?php else : ?>

    <p class="upw-not-found">
      <?php echo wpautop($instance['custom_empty']); ?>
    </p>

  <?php endif; ?>

</div>

<?php if ($instance['after_posts']) : ?>
  <div class="upw-after">
    <?php echo wpautop($instance['after_posts']); ?>
  </div>
<?php endif; ?>
