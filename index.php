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

//Create Shortcode
function recipe_sc() {
    
    ob_start();
    
    $args = array(
      'post_type'   => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 10
    );

    $recipes = new WP_Query( $args ); ?>    
    <div id="recipe_tax_filter" class="col-md-3">
    <h3>Eats</h3>
	<?php
	    $terms = get_terms( array(
	    'taxonomy' => 'eats',
	    'hide_empty' => false,
		) );

		foreach ($terms as $term){
			echo '<div class="check_grp">';
			echo '<input class="checkbox-custom" type="checkbox" value=".' . $term->slug . '">';
			echo '<label class="checkbox-custom-label" for="' . $term->slug . '">' . $term->name . '</label></div>';

		}
	?>
    <h3>Cusine</h3>
	<?php
	    $terms = get_terms( array(
	    'taxonomy' => 'cuisine',
	    'hide_empty' => false,
		) );

		foreach ($terms as $term){
			echo '<div class="check_grp">';
			echo '<input type="checkbox" value=".' . $term->slug . '">';
			echo '<label for="' . $term->slug . '">' . $term->name . '</label></div>';

		}
	?>

    <h3>Season</h3>
    <?php
	    $terms = get_terms( array(
	    'taxonomy' => 'season',
	    'hide_empty' => false,
		) );

		foreach ($terms as $term){
			echo '<div class="check_grp">';
			echo '<input type="checkbox" value=".' . $term->slug . '">';
			echo '<label for="' . $term->slug . '">' . $term->name . '</label></div>';

		}
	?>

    <h3>Time</h3>
    <?php
	    $terms = get_terms( array(
	    'taxonomy' => 'time',
	    'hide_empty' => false,
		) );

		foreach ($terms as $term){
			echo '<div class="check_grp">';
			echo '<input type="checkbox" value=".' . $term->slug . '">';
			echo '<label for="' . $term->slug . '">' . $term->name . '</label></div>';

		}
	?>
    </div>

	<div id="recipes" class="col-md-9">

	<?php 
	// the query
	$recipes = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1)); ?>

	<?php if ( $recipes->have_posts() ) : ?>

	<ul class="row recipe_wrap" id="recipes_container">

		<!-- the loop -->
		<?php while ( $recipes->have_posts() ) : $recipes->the_post(); ?>
			<li class="col-md-3 recipe <?php 
			$eats = get_the_terms(get_the_id(), 'eats');
			$cuisine = get_the_terms(get_the_id(), 'cuisine');
			$season = get_the_terms(get_the_id(), 'season');
			$time = get_the_terms(get_the_id(), 'time');
			echo $eats[0]->slug . ' ';
			echo $cuisine[0]->slug . ' ';
			echo $season[0]->slug . ' ';
			echo $time[0]->slug;
			 ?>" >
				<a href="<?php the_permalink() ?>">
				<?php the_post_thumbnail('medium'); ?>
				</a>
				<a class="recipe_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

			</li>
		<?php endwhile; ?>
		<!-- end of the loop -->

	</ul>

		<?php wp_reset_postdata(); ?>

	<?php else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>

	</div><!-- /.recipes -->

    <?php 
    $result = ob_get_clean();
    return $result;
}

add_shortcode('b_recipes', 'recipe_sc');

?>