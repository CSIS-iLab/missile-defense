<?php
/*
 * Basic loop (with setup_postdata)
 */
$posts = $value;
?>

<ul>
	<?php foreach ( $posts as $post ): // variable must be called $post (IMPORTANT) ?>
		<?php setup_postdata( $post ); ?>
		<li>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</li>
	<?php endforeach; ?>
</ul>
<?php
wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>