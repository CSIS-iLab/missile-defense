<?php
if (!defined('ABSPATH')) exit;

/* READ THE BLOCKS */
$blocks_dir = NEWSLETTER_DIR . '/emails/tnp-composer/blocks/';
$files = glob($blocks_dir . '*.block.php', GLOB_BRACE);
foreach ($files as $file) {
    $path_parts = pathinfo($file);
    $filename = $path_parts['filename'];
    $section = substr($filename, 0, strpos($filename, '-'));
    $index = substr($filename, strpos($filename, '-') + 1, 2);
    $blocks[$section][$index]['name'] = substr($filename, strrpos($filename, '-') + 1);
    $blocks[$section][$index]['filename'] = $filename;
}
// order the sections
$blocks = array_merge(array_flip(array('header', 'content', 'footer')), $blocks);

// prepare the options for the default blocks
$block_options = get_option('newsletter_main');
?>

<div id="newsletter-preloaded-export" style="display: none;"></div>

<?php include NEWSLETTER_DIR . '/emails/tnp-composer/edit.php'; ?>

<div id="newsletter-builder">  

    <?php /* SIDEBAR */ ?>
    <div id="newsletter-builder-sidebar">

        <?php
        foreach ($blocks as $k => $section) {
            ?>
            <div class="newsletter-sidebar-add-buttons" id="sidebar-add-<?php echo $k ?>">
                <h4><span><?php echo ucfirst($k) ?></span></h4>
                <?php foreach ($section AS $key => $block) { ?>
                    <div class="newsletter-sidebar-buttons-content-tab" data-id="<?php echo $k . '-' . $key ?>" data-file="<?php echo $block['filename'] ?>">
                        <?php if (file_exists(NEWSLETTER_DIR . '/emails/tnp-composer/blocks/' . $block['filename'] . '.png')) { ?>
                            <img src="<?php echo plugins_url('newsletter'); ?>/emails/tnp-composer/blocks/<?php echo $block['filename'] ?>.png" title="Drag&Drop" />
                        <?php } else { ?>
                            <img src="http://placehold.it/200x100?text=<?php echo $block['name'] ?>" title="Drag&Drop" />
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

    </div>

    <div id="newsletter-builder-area">

        <div id="newsletter-builder-area-center">

            <div id="newsletter-builder-area-center-frame">

                <div id="newsletter-builder-area-center-frame-content">

                    <?php
                    if (isset($email)) {
                        $x = strpos($body, '<body');
                        if ($x !== false) {
                            $x = strpos($body, '>', $x);
                            $y = strpos($body, '</body>');
                            echo substr($body, $x + 1, $y - $x - 1);
                        } else {
                            echo $body;
                        }
                    } else {
                        include $blocks_dir . 'header-01-header.block.php';
                        include $blocks_dir . 'content-01-hero.block.php';
                        include $blocks_dir . 'footer-01-footer.block.php';
                        include $blocks_dir . 'footer-02-canspam.block.php';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    TNP_PLUGIN_URL = "<?php echo NEWSLETTER_URL ?>";
</script>
<!--<script type="text/javascript" src="<?php echo plugins_url('newsletter'); ?>/emails/tnp-composer/_scripts/jquery-2.2.3.min.js"></script>-->
<!--<script type="text/javascript" src="<?php echo plugins_url('newsletter'); ?>/emails/tnp-composer/_scripts/jquery-ui-1.10.4.min.js"></script>-->
<script type="text/javascript" src="<?php echo plugins_url('newsletter'); ?>/emails/tnp-composer/_scripts/newsletter-builder.js"></script>
<script type="text/javascript" src="<?php echo plugins_url('newsletter'); ?>/tinymce4/tinymce.min.js"></script>