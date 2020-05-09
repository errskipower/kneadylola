<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package kneadylola-emroth
 */

if ( ! function_exists( 'kneadylola_emroth_posted_on' ) ) :
  /**
   * Prints HTML with meta information for the current post-date/time.
   */
  function kneadylola_emroth_posted_on($is_link = true) {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
      $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    }

    $time_string = sprintf(
      $time_string,
      esc_attr( get_the_date( DATE_W3C ) ),
      esc_html( get_the_date() ),
      esc_attr( get_the_modified_date( DATE_W3C ) ),
      esc_html( get_the_modified_date() )
    );

    $posted_on = $is_link ? sprintf(
      /* translators: %s: post date. */
      esc_html_x( '%s', 'post date', 'kneadylola-emroth' ),
      '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    ) : sprintf(
      /* translators: %s: post date. */
      esc_html_x( '%s', 'post date', 'kneadylola-emroth' ), $time_string
      );

    echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

  }
endif;

if ( ! function_exists( 'kneadylola_emroth_posted_by' ) ) :
  /**
   * Prints HTML with meta information for the current author.
   */
  function kneadylola_emroth_posted_by() {
    $byline = sprintf(
      /* translators: %s: post author. */
      esc_html_x( 'by %s', 'post author', 'kneadylola-emroth' ),
      '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

  }
endif;

if ( ! function_exists( 'kneadylola_emroth_entry_footer' ) ) :
  /**
   * Prints HTML with meta information for the categories, tags and comments.
   */
  function kneadylola_emroth_entry_footer() {
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
      /* translators: used between list items, there is a space after the comma */
      $tag_span_open = '<span class="tag-link">';
      $tags_list = get_the_tag_list( $tag_span_open, esc_html_x( '', 'list item separator', 'kneadylola-emroth' ) . '</span>' . $tag_span_open, '</span>' );
      if ( $tags_list ) {
        /* translators: 1: list of tags. */
        printf( '<div class="tags tag-link-list">' . esc_html__( '%1$s', 'kneadylola-emroth' ) . '</div>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
      }
    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
      echo '<span class="comments-link">';
      comments_popup_link(
        sprintf(
          wp_kses(
            /* translators: %s: post title */
            __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'kneadylola-emroth' ),
            array(
              'span' => array(
                'class' => array(),
              ),
            )
          ),
          wp_kses_post( get_the_title() )
        )
      );
      echo '</span>';
    }
  }
endif;

if ( ! function_exists( 'kneadylola_emroth_post_thumbnail' ) ) :
  /**
   * Displays an optional post thumbnail.
   *
   * Wraps the post thumbnail in an anchor element on index views, or a div
   * element when on single views.
   */
  function kneadylola_emroth_post_thumbnail() {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
      return;
    }

    if ( is_singular() ) :
      ?>

      <div class="post-thumbnail post-thumbnail-single">
        <?php the_post_thumbnail(); ?>
      </div><!-- .post-thumbnail -->

    <?php else : ?>

      <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
        <?php
          the_post_thumbnail(
            'post-thumbnail',
            array(
              'alt' => the_title_attribute(
                array(
                  'echo' => false,
                )
              ),
            )
          );
        ?>
      </a>

      <?php
    endif; // End is_singular().
  }
endif;


if ( ! function_exists( 'kneadylola_emroth_entry_navigation' ) ) :
  /**
   * Prints HTML with a post button
   */
  function the_post_navigation_button($post, $is_previous) {
    if (!$post) {
      return;
    }

    $title = get_the_title($post);
    $link = get_the_permalink($post);
    $icon = $is_previous ? 'fa-caret-left' : 'fa-caret-right';
    ?>

    <span class="level-item">
      <a href="<?php echo $link ?>" alt="<?php echo $title ?>" class="button is-small is-primary is-outlined is-uppercase">
        <?php if (!$is_previous): ?>
          <span><?php echo $title; ?></span>
        <?php endif; ?>
        <span class="icon is-small">
          <i class="fas <?php echo $icon; ?>"></i>
        </span>
        <?php if ($is_previous): ?>
          <span><?php echo $title; ?></span>
        <?php endif; ?>
      </a>
    </span>

    <?php
  }
endif;


if ( ! function_exists( 'kneadylola_emroth_entry_navigation' ) ) :
  /**
   * Prints HTML with next and previous post navigation
   */
  function kneadylola_emroth_entry_navigation() {
    // Hide post navigation for pages
    if ( 'post' === get_post_type() ) {
      $previous_post = get_previous_post();
      $next_post = get_next_post();

      ?>
      <div class="level post-nav">
        <div class="level-left"><?php the_post_navigation_button($previous_post, true); ?></div>
        <div class="level-right"><?php the_post_navigation_button($next_post, false); ?></div>

      </div>
      <?php
    }
  }
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
  /**
   * Shim for sites older than 5.2.
   *
   * @link https://core.trac.wordpress.org/ticket/12563
   */
  function wp_body_open() {
    do_action( 'wp_body_open' );
  }
endif;
