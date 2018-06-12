<?php
/**
 * Post Footer Template
 *
 *
 * @package Missile_Defense
 */

?>
<footer class="entry-footer container row">
	<section class="entry-footer-left col-xs-12 col-md-8">
		<?php missiledefense_shareOnArchives(); ?>
		<?php missiledefense_citation(); ?>
		<div class='meta-container'>
			<?php missiledefense_entry_categories(); ?>
		</div>
	</section>
	<section class="entry-footer-right col-xs-12 col-md-4">
		<?php missiledefense_related_posts(); ?>
	</section>
	<?php missiledefense_display_footnotes(); ?>
</footer>
