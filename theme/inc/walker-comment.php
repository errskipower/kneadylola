<?php
/**
 * Class Name: Commentwalker
 * Description: An extended Wordpress Commentwalker object that displays Bulma framework's Media Object https://bulma.io/ in Wordpress.
 * Author: Emiy Roth
 * Author URI: https://github.com/errskipower
 */

class Commentwalker extends Walker_Comment {

  public function start_lvl(&$output, $depth = 0, $args = []) {
    $GLOBALS['comment_depth'] = $depth + 1;
  }

  public function end_lvl (&$output, $depth = 0, $args = []) {
    $GLOBALS['comment_depth'] = $depth + 1;
    $output .= '</div></article>';
  }

  public function end_el(&$output, $item, $depth = 0, $args = [], $id = 0 ){
    $output .= $depth > 1 ? '</div></article>' : '';
  }

  public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
      $depth++;
      $GLOBALS['comment_depth'] = $depth;
      $GLOBALS['comment']       = $comment;

      ob_start();
      $this->comment( $comment, $depth, $args );
      $output .= ob_get_clean();
  }

  protected function comment( $comment, $depth, $args ) {
    $commenter = wp_get_current_commenter();
    if ( $commenter['comment_author_email'] ) {
        $moderation_note = __( 'Your comment is awaiting moderation.' );
    } else {
        $moderation_note = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.' );
    }

    $comment_class = implode(' ', get_comment_class(($this->has_children ? 'parent ' : ' ') . 'media', $comment));
    $is_by_post_author = strpos($comment_class, 'bypostauthor') !== false;

    ?>
    <article class="<?php echo $comment_class; ?>" id="comment-<?php comment_ID(); ?>">
      <figure class="media-left">
        <p class="image is-64x64">
          <?php echo get_avatar( $comment, 64); ?>
        </p>
      </figure>
      <div class="media-content">
        <?php
        edit_comment_link( '<span class="icon has-text-grey is-pulled-right"><i class="fas fa-edit fa-xs"></i></span>', '', '' );
        ?>
        <div class="content">
          <p>
            <strong>
              <?php
              printf(
                /* translators: %s: Comment author link. */
                __( '%s' ),
                sprintf( '<cite class="fn has-text-weight-normal is-uppercase is-size-7 %s">%s</cite>', ($is_by_post_author ? 'has-text-primary' : 'has-test-grey'), get_comment_author_link( $comment ) )
              );
              ?>
            </strong>
            <?php if ( '0' == $comment->comment_approved ) : ?>
              <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
              <br />
            <?php endif; ?>
            <?php
            comment_text(
                $comment,
                array_merge(
                    $args,
                    [
                        'add_below' => 'comment',
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                    ]
                )
            );
            ?>
            <div class="is-uppercase is-size-7 has-text-grey">
              <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                <?php
                    /* translators: 1: Comment date, 2: Comment time. */
                    printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
                ?>
                &middot;
                <?php
                comment_reply_link(
                    array_merge(
                        $args,
                        array(
                            'add_below' => 'comment',
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth'],
                            'before'    => '',
                            'after'     => '',
                        )
                    )
                );
                ?>
              </a>
            </div>
          </p>
        </div> <!-- end .content -->
    <?php
    if (!$this->has_children):
    ?>
      </div> <!-- end .media-content -->
    </article>
    <?php 
    endif;
  }
}
?>