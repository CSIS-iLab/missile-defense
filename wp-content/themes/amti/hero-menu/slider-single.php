
<div id='hero-menu-container' class="container-fluid">
	<div class='feature-background' style='
		background-image:url("<?php echo $feat_image; ?>");
		background-position-x:<?php echo $feat_bgpos_x; ?>;
		background-position-y:<?php echo $feat_bgpos_y; ?>;
	'>
		<!--<div class="overlay">-->
		<div class="container">
		<div class='row'>
			<div class='featuredItem-container'>
				
					

						<div class="col-sm-4 hero">
									<div class='featuredItem'>
									<div class="heroText">
									<?php echo $date; ?>
										<!--<div class='description'><?php echo $feat_description; ?></div>-->
										<div class='title'><a href='<?php echo $feat_link; ?>'><?php echo $feat_title; ?></a></div>
										<?php echo $excerpt; ?>
										
									</div>
									<div class="seeMore-container">
									<a href='<?php echo $feat_link; ?>' class='seeMore'><?php echo __($feat_cta, 'heroMenu'); ?></a>
									</div>
									</div>
								</div>
								<div class="col-sm-8">
								</div>
						</div>
					</div>
				<!--</div>-->
			</div>
		</div>
	</div>
