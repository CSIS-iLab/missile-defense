<?php
/**
 * The template for displaying the Defense Systems taxonomy archive page
 *
 */

get_header(); // This fxn gets the header.php file and renders it ?>
	<header class="entry-header">
		<h1>Missiles of the World</h1>
	</header>

	<div class="main-fluid"><!-- start the page containter -->
	<div id="primary" class="row-fluid">
		<div id="content" role="main" class="span12">
			<h2 class="landingPage" style="text-align: center;">It’s not just about ballistic missiles anymore.</h2>
			<p style="text-align: center;">Rockets, artillery, and mortars (RAM), cruise missiles, and even maneuvering hypersonic boost glide delivery systems now form the complicated 21st century strike complex with which U.S., allied, and partner nations must contend. Organized by country, the following represents a growing collection of information on global missile systems, with illustrations and up-to-date information on their capabilities and history.</p>

				<?php 
					$args = array('name' => 'missiledb');
					$output = 'objects'; // or names
					$taxonomies = get_taxonomies($args,$output); 
					if  ($taxonomies) {
					  foreach ($taxonomies  as $taxonomy ) {
					  	$terms = get_terms(array(
					  		'taxonomy' => $taxonomy->name,
					  		'hide_empty' => true
					  		));
					  	$counter = 0;
					  	echo "<div class='row-fluid'>";
	        			foreach ( $terms as $term) {

	        				$feature_image = get_term_meta( $term->term_id, 'countries_feature_image', true );

	        				if($counter % 4 === 0) {
	        					echo "</div><div class='row-fluid'>";
						    }
						    $counter++;
		        		?>

	        			<div class="span3 missiles-country" style="background-image:url('<?php echo $feature_image; ?>');">
	        				<a href="/<?php echo $term->slug; ?>">
	        					<div class="country-title"><?php echo $term->name; ?></div>
	        					<div class="country-overlay"></div>
		        			</a>
	        			</div>

	        			<?
	        			}
	        			echo "</div>";
					  }
					}  
				?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>