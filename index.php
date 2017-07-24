<?php
/**
Plugin Name: Recipe Filter
Description: Adds shortcode to display and filter recipes on any page.
Version: 1.0
**/

//Enqueue Assets
function add_scripts(){
    wp_enqueue_style('recipe_styles', plugin_dir_url( __FILE__ ) . '/css/style.css' );
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), null, true);
    wp_enqueue_script( 'custom_script', plugin_dir_url( __FILE__ ) . 'js/script.js' );
    wp_enqueue_script( 'isotope_js', plugin_dir_url( __FILE__ ) . 'js/isotope.js' );
}
add_action('wp_enqueue_scripts', 'add_scripts');

//Register Taxonomies

//Eats
function create_eats_tax() {
//Labels part for the GUI
  $labels = array(
    'name' => _x( 'Eats', 'taxonomy general name' ),
    'singular_name' => _x( 'Eat', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Eats' ),
    'popular_items' => __( 'Popular Eats' ),
    'all_items' => __( 'All Eats' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Eat' ), 
    'update_item' => __( 'Update Eat' ),
    'add_new_item' => __( 'Add New Eat' ),
    'new_item_name' => __( 'New Eat Name' ),
    'separate_items_with_commas' => __( 'Separate eats with commas' ),
    'add_or_remove_items' => __( 'Add or remove eats' ),
    'choose_from_most_used' => __( 'Choose from the most used eats' ),
    'menu_name' => __( 'Eats' ),
  ); 

//Register the taxonomy
  register_taxonomy('eats','post',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'eat' ),
  ));
}
add_action( 'init', 'create_eats_tax', 0 );

//Cuisine
function create_cuisine_tax() {
//Labels part for the GUI
  $labels = array(
    'name' => _x( 'Cuisine', 'taxonomy general name' ),
    'singular_name' => _x( 'Cuisine', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Cuisine' ),
    'popular_items' => __( 'Popular Cuisine' ),
    'all_items' => __( 'All Cuisine' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Cuisine' ), 
    'update_item' => __( 'Update Cuisine' ),
    'add_new_item' => __( 'Add New Cuisine' ),
    'new_item_name' => __( 'New Cuisine Name' ),
    'separate_items_with_commas' => __( 'Separate Cuisine with commas' ),
    'add_or_remove_items' => __( 'Add or remove Cuisine' ),
    'choose_from_most_used' => __( 'Choose from the most used Cuisine' ),
    'menu_name' => __( 'Cuisine' ),
  ); 

//Register the taxonomy
  register_taxonomy('cuisine','post',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cusine' ),
  ));
}
add_action( 'init', 'create_cuisine_tax', 0 );

//Season
function create_season_tax() {
//Labels part for the GUI
  $labels = array(
    'name' => _x( 'Season', 'taxonomy general name' ),
    'singular_name' => _x( 'Season', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Season' ),
    'popular_items' => __( 'Popular Season' ),
    'all_items' => __( 'All Season' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Season' ), 
    'update_item' => __( 'Update Season' ),
    'add_new_item' => __( 'Add New Season' ),
    'new_item_name' => __( 'New Season Name' ),
    'separate_items_with_commas' => __( 'Separate Season with commas' ),
    'add_or_remove_items' => __( 'Add or remove Season' ),
    'choose_from_most_used' => __( 'Choose from the most used Season' ),
    'menu_name' => __( 'Season' ),
  ); 

//Register the taxonomy
  register_taxonomy('season','post',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'season' ),
  ));
}
add_action( 'init', 'create_season_tax', 0 );

//Time
function create_time_tax() {
//Labels part for the GUI
  $labels = array(
    'name' => _x( 'Time', 'taxonomy general name' ),
    'singular_name' => _x( 'Time', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Time' ),
    'popular_items' => __( 'Popular Time' ),
    'all_items' => __( 'All Time' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Time' ), 
    'update_item' => __( 'Update Time' ),
    'add_new_item' => __( 'Add New Time' ),
    'new_item_name' => __( 'New Time Name' ),
    'separate_items_with_commas' => __( 'Separate Time with commas' ),
    'add_or_remove_items' => __( 'Add or remove Time' ),
    'choose_from_most_used' => __( 'Choose from the most used Time' ),
    'menu_name' => __( 'Time' ),
  ); 

//Register the taxonomy
  register_taxonomy('time','post',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'time' ),
  ));
}
add_action( 'init', 'create_time_tax', 0 );

//Include Recipes Shortcode
include('recipe_sc.php');

//Include Ingredients Shortcode
include('ingredients_sc.php');

//Custom Admin CSS
function custom_css() {
  echo '<style>

.column-title{
	width: 150px !important;
}

.wp-list-table #taxonomy-eats, .wp-list-table #taxonomy-cuisine, .wp-list-table #taxonomy-season, .wp-list-table #taxonomy-time, .column-taxonomy-eats, .column-taxonomy-time, .column-taxonomy-season, .column-taxonomy-cuisine{
	display: none;
}
  </style>';
}
add_action('admin_head', 'custom_css');

add_action("{$taxonomy}_edit_form_fields", 'add_form_fields_example', 10, 2);
?>