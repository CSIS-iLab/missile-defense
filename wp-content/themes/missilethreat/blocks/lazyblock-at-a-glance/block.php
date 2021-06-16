
<?php
/**
 * At a Glance Block Template.
 *
 * @var  array  $attributes Block attributes.
 * @var  array  $block Block data.
 * @var  string $context Preview context [editor,frontend].
 */


$missile_short_name = get_field('missile_name');
$block_name = get_lzb_meta('name');
$block_title = get_lzb_meta('title');
$missile_name = get_the_title();

if ( isset( $missile_short_name ) && !empty( $missile_short_name ) ) {
  $missile_name = $missile_short_name;
}

if ( isset( $block_name ) && !empty( $block_name ) ) {
  $missile_name = $block_name;
}

?>
<div class="alignwide">
  <div class="at-a-glance__wrapper">
    <div class="at-a-glance">
      <h1 class="at-a-glance__title"><?php echo $missile_name ?> <?php echo $block_title ?></h1>
      
      <?php
      $specs = get_lzb_meta('missile-specs');
      
      foreach( $specs as $spec ) {
        $spec_name = $spec['spec'];
        $spec_value = $spec['value']; ?>

        <dl class="at-a-glance__spec">
          <dt class="at-a-glance__spec-name text--bold"><?php echo $spec_name; ?></dt>
          <dd><?php echo $spec_value; ?></dd>
        </dl>
        <?php } ?>
      </div>
  </div>
</div>
