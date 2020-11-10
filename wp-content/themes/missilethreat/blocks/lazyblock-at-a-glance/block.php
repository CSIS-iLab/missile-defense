
<?php
/**
 * At a Glance Block Template.
 *
 * @var  array  $attributes Block attributes.
 * @var  array  $block Block data.
 * @var  string $context Preview context [editor,frontend].
 */


$missile_short_name = get_field('missile_name');

?>
<div class="at-a-glance__wrapper alignwide">
  <?php dynamic_sidebar( 'social-share' ); ?>
  <div class="at-a-glance">
    <h1 class="at-a-glance__title text--semibold">At a Glance</h1>
    <?php
    $specs = get_lzb_meta('missile-specs');

    foreach( $specs as $spec ) {
      $spec_name = $spec['spec'];
      $spec_value = $spec['value']; ?>

    <p class="at-a-glance__spec"><span class="at-a-glance__spec-name text--bold"><?php echo $spec_name; ?></span><br><?php echo $spec_value; ?></p>
    <?php } ?>
  </div>
</div>