<?php
/**
 * Template part for displaying islands in the island tracker.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Transparency
 */

$custom = get_post_custom();

if(isset($custom['missile_url'])) {
	$url = $custom['missile_url'][0];
}
else {
	$url = esc_url( get_permalink());
}

// Get the first part of the range
$range = null;
if(isset($custom['missile_range'])) {
	// Check if we have a hyphenated range
    if (strpos($custom['missile_range'][0], '-') !== false) {
	    $range = strtok($custom['missile_range'][0], '-');
	}
	else {
		$range = strtok($custom['missile_range'][0], ' ');
	}
	$range = str_replace(",", "", $range);
}

?>

<tr id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<td>
		<?php
			if(isset($custom['missile_name'])) {
				if(get_post_status() != 'publish' && !isset($custom['missile_url'])) {
					echo $custom['missile_name'][0];
				}
				else {
					echo "<a href='".$url."' rel='bookmark'>".$custom['missile_name'][0]."</a>";
				}
			}
			else {
				if(get_post_status() != 'publish' && !isset($custom['missile_url'])) {
					the_title();
				}
				else {
					the_title( '<a href="'.$url.'" rel="bookmark">', '</a>' );
				}
			}
		?>
	</td>
	<td class="hidden-xs">
		<?php
			if(isset($custom['missile_class'])) {
			    echo $custom['missile_class'][0];
			}
		?>
	</td>
	<td class="hidden-xs" data-order="<?php echo $range; ?>">
		<?php
			if(isset($custom['missile_range'])) {
			    echo $custom['missile_range'][0];
			}
		?>
	</td>
	<td class="hidden-xs">
		<?php
			if(isset($custom['missile_status'])) {
			    echo $custom['missile_status'][0];
			}
		?>
	</td>
</tr><!-- #post-## -->