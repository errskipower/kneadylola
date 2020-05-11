<?php
/**
 * The template for displaying a serach form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package kneadylola-emroth
 */
?>

<form role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
  <div class="field has-addons has-addons-centered">
    <label class="label" for="search"><span class="screen-reader-text">Search for:</span></label>
    <div class="control">
      <input class="input search-field" type="search" placeholder="Search …" value="<?php the_search_query(); ?>" name="s">
    </div>
    <div class="control">
      <input type="submit" class="search-submit button is-primary" value="Search" />
    </div>
  </div>
</form>
