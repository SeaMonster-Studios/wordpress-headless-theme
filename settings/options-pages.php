<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

function ctp_acf_options_pages() {

  if( function_exists('acf_add_options_page') ) { //Check if installed acf

      $ctp_acf_post_types = get_post_types( array(
          '_builtin' => false
      ) ); //get post types

      foreach ( $ctp_acf_post_types as $cpt ) {

        if( post_type_exists( $cpt ) ) {

          $cpt_name = get_post_type_object( $cpt )->labels->name;

          $cpt_acf_page = array(
              'page_title' => ucfirst( $cpt_name ) . ' Index',
              'menu_title' => ucfirst( $cpt_name ) . ' Index',
              'menu_slug' => 'cpt-acf-' . $cpt,
              'capability' => 'edit_posts',
              'position' => false,
              'parent_slug' => 'edit.php?post_type=' . $cpt,
              'icon_url' => false,
              'redirect' => false,
              'post_id' => 'cpt_' . $cpt,
              'autoload' => false
          );

          acf_add_options_page( $cpt_acf_page );

      } // end if
    }
  } else { //activation warning
    // add_action( 'admin_notices', 'ctp_acf_admin_error_notice' );

    function ctp_acf_admin_error_notice(){
      $output = '<section class="admin-alert"><p>Whoops... Better create that post type first.</p></section>';
        echo $output;
    }
  }
}

add_action( 'init', 'ctp_acf_options_pages', 99 );



if ( function_exists( 'acf_add_options_sub_page' ) ){
  acf_add_options_sub_page(array(
    'title'      => 'Posts Index',
    'parent'     => 'edit.php',
		'capability' => 'manage_options',
		'post_id' => 'posts_index'
  ));
}
if( function_exists('acf_add_options_page') && function_exists('acf_add_options_sub_page') ) { //Check if installed acf
  acf_add_options_page(array(

		/* (string) The title displayed on the options page. Required. */
		'page_title' => 'Brand',

		/* (string) The title displayed in the wp-admin sidebar. Defaults to page_title */
		'menu_title' => '',

		/* (string) The slug name to refer to this menu by (should be unique for this menu).
		Defaults to a url friendly version of menu_slug */
		'menu_slug' => '',

		/* (string) The capability required for this menu to be displayed to the user. Defaults to edit_posts.
		Read more about capability here: http://codex.wordpress.org/Roles_and_Capabilities */
		'capability' => 'edit_posts',

		/* (int|string) The position in the menu order this menu should appear.
		WARNING: if two menu items use the same position attribute, one of the items may be overwritten so that only one item displays!
		Risk of conflict can be reduced by using decimal instead of integer values, e.g. '63.3' instead of 63 (must use quotes).
		Defaults to bottom of utility menu items */
		'position' => '2.1',

		/* (string) The slug of another WP admin page. if set, this will become a child page. */
		'parent_slug' => '',

		/* (string) The icon class for this menu. Defaults to default WordPress gear.
		Read more about dashicons here: https://developer.wordpress.org/resource/dashicons/ */
		'icon_url' => 'dashicons-art',

		/* (boolean) If set to true, this options page will redirect to the first child page (if a child page exists).
		If set to false, this parent page will appear alongside any child pages. Defaults to true */
		'redirect' => true,

		/* (int|string) The '$post_id' to save/load data to/from. Can be set to a numeric post ID (123), or a string ('user_2').
		Defaults to 'options'. Added in v5.2.7 */
		'post_id' => 'brand',

		/* (boolean)  Whether to load the option (values saved from this options page) when WordPress starts up.
		Defaults to false. Added in v5.2.8. */
		'autoload' => false,
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Reusables',
		'menu_title'	=> '',
		'menu_slug' 	=> 'reusables',
		'post_id' => 'reusables',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position' => '2.2',
		'icon_url' => 'dashicons-layout',
	));

} // end if
