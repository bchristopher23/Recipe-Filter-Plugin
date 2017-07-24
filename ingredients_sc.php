<?php
//Create Shortcode
function ingredients_sc() {
    
    ob_start();

	$tags = get_tags(array('hide_empty' => false)); 
    $groups = array();

    if( $tags && is_array( $tags ) ) {
		foreach( $tags as $tag ) {
			$first_letter = strtoupper( $tag->name[0] );
			$groups[$first_letter][] = $tag;
		}
	}
?>

<div class="ingredients_jump">
<?php 

if( !empty( $groups ) ) {

foreach( $groups as $letter => $tags ) {
	$list .= "\n\t" . '<a href="#' . apply_filters( 'the_title', $letter ) . '">' . apply_filters( 'the_title', $letter ) .'</a>';
}}

?>	
</div>

<?php 
    
echo '<ul id="ingredients_wrap">'; 

if( !empty( $groups ) ) {

foreach( $groups as $letter => $tags ) {
	$list .= "\n\t" . '<div class="ingredients_group">';
	$list .= "\n\t" . '<h2 class="ingredient_letter" id="' . apply_filters( 'the_title', $letter ) . '">' . apply_filters( 'the_title', $letter ) .'</h2>';

foreach( $tags as $tag ) {
	$lower = strtolower($tag->name);
	$name = str_replace(' ', ' ', $tag->name);
	$naam = str_replace(' ', '-', $lower);
	$list .= "\n\t\t" . '<li class="ingredient_item">' . tag_description($tag->term_taxonomy_id) . '<a href="/tag/'.$naam.'">'.$name.'</a></li>';
}
$list .= '</div>';
}

} else {

	$list .= "\n\t" . '<p>Sorry, but no ingredients were found</p>';

}

print $list;

echo "</ul>";

    $result = ob_get_clean();
    return $result;
}

add_shortcode('b_ingredients', 'ingredients_sc');