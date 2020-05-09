<?php
/**
 * Admin recipe template styles
 *
 */
function admin_recipe_template_styles() {
  $screen = get_current_screen();
  $show_on = ['admin_page_wprm_template_editor'];

  // if (defined('WP_LOCAL_DEV') && WP_LOCAL_DEV) {
  //   $show_on[] = 'post';
  // }

  if (!empty($screen->base) && in_array($screen->base, $show_on)) {
    echo recipe_template_styles( 'all' );
  }

}
add_action( 'admin_head', 'admin_recipe_template_styles' );

/**
 * Recipe template styles
 *
 */
function frontend_recipe_template_styles($output, $recipe, $type, $slug) {

  if (empty($type)) {
    return $output;
  }
    
  $template = WPRM_Template_Manager::get_template_by_type($type);
  if (!empty($template['slug'])) {
    $style = recipe_template_styles($template['slug']);
  }

  return $style . $output;
}
add_filter( 'wprm_get_template', 'frontend_recipe_template_styles', 10, 4 );

/**
 * Recipe template styles
 *
 */
function recipe_template_styles($slug = false) {

  if (!$slug) {
    return;
  }

  // key is WPRM template slug, value is CSS file location
  $templates = [
    'kneady-lola-compact' => '/recipe.css'
  ];

  $style = '';
  if ( array_key_exists( $slug, $templates ) ) {
    $url = get_stylesheet_directory_uri() . $templates[ $slug ] . '?' . filemtime( get_stylesheet_directory() . $templates[ $slug ] );
    $style .= '<link rel="stylesheet" id="recipe-' . $slug . '-css"  href="' . $url . '" type="text/css" media="all" />';

  } elseif ( 'all' === $slug ) {
    foreach( $templates as $slug => $template ) {
      $url = get_stylesheet_directory_uri() . $templates[ $slug ] . '?' . filemtime( get_stylesheet_directory() . $templates[ $slug ] );
      $style .= '<link rel="stylesheet" id="recipe-' . $slug . '-css"  href="' . $url . '" type="text/css" media="all" />';
    }
  }
  return $style;
}