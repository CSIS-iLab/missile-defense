<?php
/**
 * Checkboxes to filter posts by category
 *
 * @package CSIS iLab
 * @subpackage @package MissileThreat
 * @since 1.0.0
 */


// var_dump(get_taxonomies());
// var_dump(get_categories());

if( $terms = get_terms( array(
	'taxonomy' => array(
		'category',
	),
	'orderby' => 'name',
	'exclude_tree' => array(
		17,
		34,
		275,
		1
		)
		))) :
		
		if( is_archive() AND !is_category( $category = 'ongoing-projects')) {
			?>
						<input type="checkbox" id="analysis" name="analysis" value="analysis" class="filter__checkbox">
						<label for="analysis">Analysis</label><br/>
			<?php
					}
		
		foreach ( $terms as $term ) :
			
			?>
			<input type="checkbox" id=<?php $term->slug; ?> name=<?php $term->slug; ?> value=<?php $term->slug; ?> class="filter__checkbox indent">
			<label for="<?php $term->slug; ?>"><?php echo $term->name; ?></label><br/>
			<?php
				endforeach;
				if( is_archive() AND !is_category( $category = 'ongoing-projects')) {
		?>
					<input type="checkbox" id="countries" name="countries" value="countries" class="filter__checkbox">
					<label for="countries">Missiles of the World</label><br/>
					<input type="checkbox" id="system" name="system" value="system" class="filter__checkbox">
					<label for="system">Defense Systems</label><br/>
		<?php
				}
	
	endif;