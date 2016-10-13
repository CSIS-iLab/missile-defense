<?php
/**
 * The template for displaying the Defense Systems taxonomy archive page
 *
 */

get_header(); // This fxn gets the header.php file and renders it ?>
	<header class="entry-header">
		<h1>Defense Systems</h1>
	</header>

	<div class="main-fluid"><!-- start the page containter -->
	<div id="primary" class="row-fluid">
		<div id="content" role="main" class="span12">

				<?php 
					$args = array('name' => 'system');
					$output = 'objects'; // or names
					$taxonomies = get_taxonomies($args,$output); 
					if  ($taxonomies) {
					  foreach ($taxonomies  as $taxonomy ) {
					  	$terms = get_terms(array(
					  		'taxonomy' => $taxonomy->name,
					  		'hide_empty' => false
					  		));
					  	$counter = 0;
					  	echo "<div class='row-fluid'>";
	        			foreach ( $terms as $term) {
	        				if($counter % 3 === 0) {
	        					echo "</div><div class='row-fluid'>";
						    }
						    $counter++;
		        		?>

	        			<div class="span4" style="border:1px solid red;height:200px;">
	        				<a href="<?php echo $term->slug; ?>">
		        				<div>
		        					<div class="title"><?php echo $term->name; ?></div>
		        				</div>
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