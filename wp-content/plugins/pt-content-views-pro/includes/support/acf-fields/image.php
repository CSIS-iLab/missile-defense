<?php
/*
 * Customized display (Object)
 */
$image = $value;

// vars
$url	 = $image[ 'url' ];
$title	 = $image[ 'title' ];
$alt	 = $image[ 'alt' ];
$caption = $image[ 'caption' ];

// Get a size
$size	 = '';
$sizes	 = array( 'large', 'medium', 'thumbnail' );
foreach ( $sizes as $s ) {
	if ( !empty( $image[ 'sizes' ][ $s ] ) ) {
		$size = $s;
		break;
	}
}
$size = apply_filters( PT_CV_PREFIX_ . 'acf_image_size', $size );

$thumb	 = $image[ 'sizes' ][ $size ];
$width	 = $image[ 'sizes' ][ $size . '-width' ];
$height	 = $image[ 'sizes' ][ $size . '-height' ];

if ( $caption ) {
	echo '<div class="wp-caption">';
}
?>

<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />

<?php
if ( $caption ) {
	printf( '<p class="wp-caption-text">%s</p></div>', $caption );
}
