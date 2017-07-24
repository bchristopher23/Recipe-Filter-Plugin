<?php
//Create Shortcode
function recipe_sc() {
    
    ob_start();
    
    $args = array(
      'post_type'   => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 10
    );

    $recipes = new WP_Query( $args ); ?>   

    <div class="recipe-index-sidebar">
	<div class="row">
    
    <div class="col-md-3">
    <?php dynamic_sidebar('recipe-index-1'); ?>
	</div>    

	<div class="col-md-3">
	<?php dynamic_sidebar('recipe-index-2'); ?>
	</div>    	

	<div class="col-md-3">
	<?php dynamic_sidebar('recipe-index-3'); ?>
	</div>   

	<div class="col-md-3">
	<?php dynamic_sidebar('recipe-index-4'); ?>
	</div>    
	</div>
	</div>

    <div id="recipe_tax_filter" class="col-md-2">
    <h3>Eats</h3>
	<?php
	    $terms = get_terms( array(
	    'taxonomy' => 'eats',
	    'hide_empty' => false,
		) );

		foreach ($terms as $term){
			echo '<div class="check_grp">';
			echo '<input class="css-checkbox" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '">';
			echo '<label class="css-label lite-x-gray" for="' . $term->slug . '">' . $term->name . '</label></div>';

		}
	?>
    <h3>Cuisine</h3>
	<?php
	    $terms = get_terms( array(
	    'taxonomy' => 'cuisine',
	    'hide_empty' => false,
		) );

		foreach ($terms as $term){
			echo '<div class="check_grp">';
			echo '<input class="css-checkbox" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '">';
			echo '<label class="css-label lite-x-gray" for="' . $term->slug . '">' . $term->name . '</label></div>';

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
			echo '<input class="css-checkbox" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '">';
			echo '<label class="css-label lite-x-gray" for="' . $term->slug . '">' . $term->name . '</label></div>';

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
			echo '<input class="css-checkbox" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '">';
			echo '<label class="css-label lite-x-gray" for="' . $term->slug . '">' . $term->name . '</label></div>';

		}
	?>
    </div>

	<div id="recipes" class="col-md-10">

	<?php 
	// the query
	$recipes = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1)); ?>

	<?php if ( $recipes->have_posts() ) : ?>

	<ul class="recipe_wrap" id="recipes_container">
	<div class="row">
		<!-- the loop -->
		<?php $i = 0;
		while ( $recipes->have_posts() ) : $recipes->the_post();
			if ($i == 4) {
		        $i = 0;
		        ?>
		        </div>
		        <div class="row">
		        <?php
		    }?>
			<li class="col-md-3 recipe <?php 
			$eats = get_the_terms(get_the_id(), 'eats');
            foreach ($eats as $eat){
                echo $eat->slug . ' ';
            }

			$cuisines = get_the_terms(get_the_id(), 'cuisine');
            foreach ($cuisines as $cuisine){
                echo $cuisine->slug . ' ';
            }

			$seasons = get_the_terms(get_the_id(), 'season');
            foreach ($seasons as $season){
                echo $season->slug . ' ';
            }

			$times = get_the_terms(get_the_id(), 'time');
            foreach ($times as $time){
                echo $time->slug . ' ';
            }

			 ?>" >
				<a href="<?php the_permalink() ?>">
				<?php the_post_thumbnail('medium'); ?>
				</a>
				<a class="recipe_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

			</li>
		<?php 
		$i++;
		endwhile; ?>
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