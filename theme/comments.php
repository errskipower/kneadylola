<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kneadylola-emroth
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
  return;
}
?>

<div id="comments" class="comments-area">

  <?php
  // You can start editing here -- including this comment!
  if ( have_comments() ) :
    ?>
    <h2 class="comments-title title is-4 has-text-weight-normal has-text-centered">
      <?php
      $kneadylola_emroth_comment_count = get_comments_number();
      if ( '1' === $kneadylola_emroth_comment_count ) {
        printf(
          /* translators: 1: title. */
          esc_html__( 'One comment;', 'kneadylola-emroth' ),
          '<span>' . wp_kses_post( get_the_title() ) . '</span>'
        );
      } else {
        printf( 
          /* translators: 1: comment count number, 2: title. */
          esc_html( _nx( '%1$s comments', '%1$s comments', $kneadylola_emroth_comment_count, 'comments title', 'kneadylola-emroth' ) ),
          number_format_i18n( $kneadylola_emroth_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
          '<span>' . wp_kses_post( get_the_title() ) . '</span>'
        );
      }
      ?>
    </h2><!-- .comments-title -->

    <?php the_comments_navigation(); ?>

    <div class="comment-list">
      <?php
      wp_list_comments(
        [
          'walker'     => new \Commentwalker,
          'style'      => 'div',
          'short_ping' => true,
          'max_depth'  => 3
        ]
      );
      ?>
    </div><!-- .comment-list -->

    <?php
    the_comments_navigation();

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() ) :
      ?>
      <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'kneadylola-emroth' ); ?></p>
      <?php
    endif;

  endif; // Check for have_comments().

  $comment_args = [
    // (array) Default comment fields, filterable by default via the 'comment_form_default_fields' hook.
    'fields' => [
      // (string) Comment author field HTML.
      'author' => '<div class="field comment-form-author">
                    <label class="label is-uppercase is-size-7 has-text-weight-normal" for="author">Name <span class="has-text-danger">*</span></label>
                    <p class="control has-icons-left">
                      <input class="input" type="text" id="author" name="author" aria-required="true" placeholder="" required>
                      <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                      </span>
                    </p>
                  </div>',
      // (string) Comment author email field HTML.
      'email' => '<div class="field comment-form-email">
                    <label class="label is-uppercase is-size-7 has-text-weight-normal" for="email">Email <span class="has-text-danger">*</span></label>
                    <p class="control has-icons-left">
                      <input class="input" type="email" id="email" name="email" aria-required="true" placeholder="" required>
                      <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                      </span>
                    </p>
                  </div>',
      // (string) Comment author URL field HTML.
      'url' => '<div class="field comment-form-url">
                    <label class="label is-uppercase is-size-7 has-text-weight-normal" for="website">Website</label>
                    <p class="control has-icons-left">
                      <input class="input" type="url" id="url" name="url" aria-required="true" placeholder="">
                      <span class="icon is-small is-left">
                        <i class="fas fa-globe"></i>
                      </span>
                    </p>
                  </div>',
      // (string) Comment cookie opt-in field HTML.
      'cookies' => '<div class="field comment-form-cookies-consent">
                      <p class="control">
                        <label class="checkbox">
                          <input type="checkbox" value="yes" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" required>
                          Save my name, email, and website for the next time I comment.
                        </label>
                      </p>
                    </div>',
    ],
    // (string) The comment textarea field HTML.
    'comment_field' => '<div class="field">
                          <label class="label is-uppercase is-size-7 has-text-weight-normal" for="comment">Comment <span class="has-text-danger">*</span></label>
                          <div class="control">
                            <textarea class="textarea" placeholder="Textarea" maxLength="65525" name="comment" id="comment" required></textarea>
                          </div>
                        </div>',
    // (string) HTML element for a 'logged in as [user]' message.
    'logged_in_as' => sprintf(
        '<p class="logged-in-as notification is-light">%s</p>',
        sprintf(
            /* translators: 1: Edit user link, 2: Accessibility text, 3: User name, 4: Logout URL. */
            __( 'Logged in as <a href="%1$s" aria-label="%2$s">%3$s</a>. <a href="%4$s">Log out?</a>' ),
            get_edit_user_link(),
            /* translators: %s: User name. */
            esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
            $user_identity,
            /** This filter is documented in wp-includes/link-template.php */
            wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
        )
    ),
    // (string) HTML element for a message displayed before the comment fields if the user is not logged in. Default 'Your email address will not be published.'.
    'comment_notes_before' => '<div class="content"><p class="comment-notes is-size-7 has-text-grey has-text-centered">Your email address will not be published. Required fields are marked <span class="has-text-danger">*</span></p></div>',
    // // (string) HTML element for a message displayed after the textarea field.
    // 'comment_notes_after' => '',
    // // (string) The comment form element action attribute. Default '/wp-comments-post.php'.
    // 'action' => '',
    // // (string) The comment form element id attribute. Default 'commentform'.
    // 'id_form' => '',
    // // (string) The comment submit element id attribute. Default 'submit'.
    // 'id_submit' => '',
    // // (string) The comment form element class attribute. Default 'comment-form'.
    // 'class_form' => '',
    // (string) The comment submit element class attribute. Default 'submit'.
    'class_submit' => 'button is-small is-primary is-uppercase',
    // // (string) The translatable 'reply' button label. Default 'Leave a Reply'.
    // 'title_reply' => '',
    // // (string) The translatable 'reply-to' button label. Default 'Leave a Reply to %s', where %s is the author of the comment being replied to.
    // 'title_reply_to' => '',
    // (string) HTML displayed before the comment form title. Default: <h3 id="reply-title" class="comment-reply-title">.
    'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title title is-4 has-text-weight-normal has-text-centered">',
    // (string) HTML displayed before the cancel reply link.
    'cancel_reply_before' => '<span class="is-size-7 is-uppercase is-block cancel-reply">',
    // (string) HTML displayed after the cancel reply link.
    'cancel_reply_after' => '</span>',
    // (string) The translatable 'cancel reply' button label. Default 'Cancel reply'.
    'cancel_reply_link' => '(Cancel Reply)',
    // (string) The translatable 'submit' button label. Default 'Post a comment'.
    'label_submit' => 'Post Comment',
  ];

  comment_form($comment_args);
  ?>

</div><!-- #comments -->
