<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kneadylola-emroth
 */

?>

  </div><!-- #content -->

  <footer class="footer">
    <div class="content has-text-centered">
      <p>
        Copyright &copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved. Site Design by <a href="http://emroth.com">Emily Roth</a>.
      </p>
    </div>
  </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
