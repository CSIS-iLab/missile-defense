<?php
@include_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();
$module = Newsletter::instance();
$extensions = $module->getTnpExtensions();

$controls->data = get_option('newsletter_main');

if ($controls->is_action('install')) {

    $extension = null;
    foreach ($extensions as $e) {
        if ($e->id == $_GET['id']) {
            $extension = $e;
            break;
        }
    }

    $id = $extension->id;
    $slug = $extension->slug;

    $source = 'http://www.thenewsletterplugin.com/wp-content/plugins/file-commerce-pro/get.php?f=' . $id .
            '&k=' . urlencode(Newsletter::instance()->options['contract_key']);

    if (!class_exists('Plugin_Upgrader', false)) {
        require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    }

    $upgrader = new Plugin_Upgrader(new Automatic_Upgrader_Skin());

    $result = $upgrader->install($source);
    if (!$result || is_wp_error($result)) {
        $controls->errors = __('Error while installing','newsletter');
        if (is_wp_error($result)) {
            $controls->errors .= ': ' . $result->get_error_message();
        }
    } else {
        $result = activate_plugin($extension->wp_slug);
        if (is_wp_error($result)) {
            $controls->errors .= __('Error while activating:','newsletter') . " " . $result->get_error_message();
        } else {
            $controls->messages .= __('Installed and activated','newsletter');
        }
    }
    wp_clean_plugins_cache(false);
}

if ($controls->is_action('activate')) {
    $extension = null;
    foreach ($extensions as $e) {
        if ($e->id == $_GET['id']) {
            $extension = $e;
            break;
        }
    }
    $result = activate_plugin($extension->wp_slug);
    if (is_wp_error($result)) {
        $controls->errors .= __('Error while activating:', 'newsletter') . " " . $result->get_error_message();
    } else {
        $controls->messages .= __('Activated', 'newsletter');
    }
    wp_clean_plugins_cache(false);
}
?>

<div class="wrap" id="tnp-wrap">

    <?php include NEWSLETTER_DIR . '/tnp-header.php'; ?>

    <div id="tnp-heading">

        <h2><?php _e('Extensions', 'newsletter') ?></h2>

    </div>

    <div id="tnp-body">

        <?php if (is_array($extensions)) { ?>

            <?php foreach ($extensions AS $e) { ?>

                <?php
                $e->activate_url = wp_nonce_url(admin_url('admin.php') . '?page=newsletter_main_extensions&act=activate&id=' . $e->id, 'save');
                $e->install_url = wp_nonce_url(admin_url('admin.php') . '?page=newsletter_main_extensions&act=install&id=' . $e->id, 'save');
                ?>

                <!--PREMIUM EXTENSIONS--> 
                <?php if ($e->type == "premium") { ?>
                    <div class="tnp-extension-premium-box <?php echo $e->slug ?>">
                        <div class="tnp-extensions-image"><img src="<?php echo $e->image ?>" alt="" /></div>
                        <h3><?php echo $e->title ?></h3>
                        <p><?php echo $e->description ?></p>
                        <div class="tnp-extension-premium-action">
                            <?php if (is_plugin_active($e->wp_slug)) { ?>
                                <span><i class="fa fa-check" aria-hidden="true"></i> <?php _e('Plugin active', 'newsletter') ?></span>
                            <?php } elseif (file_exists(WP_PLUGIN_DIR . "/" . $e->wp_slug)) { ?>
                                <a href="<?php echo $e->activate_url ?>" class="tnp-extension-activate">
                                    <i class="fa fa-power-off" aria-hidden="true"></i> <?php _e('Activate', 'newsletter') ?>
                                </a>
                            <?php } elseif ($e->downloadable) { ?>
                                <a href="<?php echo $e->install_url ?>" class="tnp-extension-install">
                                    <i class="fa fa-download" aria-hidden="true"></i> Install Now
                                </a>
                            <?php } else { ?>
                                <a href="http://www.thenewsletterplugin.com/premium?utm_source=plugin&utm_medium=link&utm_campaign=extpanel" class="tnp-extension-buy" target="_blank">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy Now
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

                <!--FREE EXTENSIONS-->
                <?php if ($e->type == "free") { ?>
                    <div class="tnp-extension-free-box <?php echo $e->slug ?>">
                        <div class="tnp-extensions-image"><img src="<?php echo $e->image ?>" alt="" /></div>
                        <h3><?php echo $e->title ?></h3>
                        <p><?php echo $e->description ?></p>
                        <div class="tnp-extension-free-action">
                            <?php if (is_plugin_active($e->wp_slug)) { ?>
                                <span><i class="fa fa-check" aria-hidden="true"></i> <?php _e('Plugin active', 'newsletter') ?></span>
                            <?php } elseif (file_exists(WP_PLUGIN_DIR . "/" . $e->wp_slug)) { ?>
                                <a href="<?php echo $e->activate_url ?>" class="tnp-extension-activate">
                                    <i class="fa fa-power-off" aria-hidden="true"></i> <?php _e('Activate', 'newsletter') ?>
                                </a>
                            <?php } elseif ($e->downloadable) { ?>
                                <a href="<?php echo $e->install_url ?>" class="tnp-extension-install">
                                    <i class="fa fa-download" aria-hidden="true"></i> Install Now
                                </a>
                            <?php } else { ?>
                                <a href="http://www.thenewsletterplugin.com/account?utm_source=plugin&utm_medium=link&utm_campaign=extpanel" class="tnp-extension-free" target="_blank">
                                    <i class="fa fa-gift" aria-hidden="true"></i> Free Download
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

                <!--INTEGRATIONS-->
                <?php if ($e->type == "integration") { ?>
                    <div class="tnp-integration-box <?php echo $e->slug ?>">
                        <div class="tnp-extensions-image"><img src="<?php echo $e->image ?>" alt="" /></div>
                        <h3><?php echo $e->title ?></h3>
                        <p><?php echo $e->description ?></p>
                        <div class="tnp-integration-action">
                            <?php if (is_plugin_active($e->wp_slug)) { ?>
                                <span><i class="fa fa-check" aria-hidden="true"></i> <?php _e('Plugin active', 'newsletter') ?></span>
                            <?php } elseif (file_exists(WP_PLUGIN_DIR . "/" . $e->wp_slug)) { ?>
                                <a href="<?php echo $e->activate_url ?>" class="tnp-extension-activate">
                                    <i class="fa fa-power-off" aria-hidden="true"></i> <?php _e('Activate', 'newsletter') ?>
                                </a>
                            <?php } elseif ($e->downloadable) { ?>
                                <a href="<?php echo $e->install_url ?>" class="tnp-extension-install">
                                    <i class="fa fa-download" aria-hidden="true"></i> Install Now
                                </a>
                            <?php } else { ?>
                                <a href="http://www.thenewsletterplugin.com/premium?utm_source=plugin&utm_medium=link&utm_campaign=extpanel" class="tnp-extension-buy" target="_blank">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy Now
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

            <?php } ?>

        <?php } else { ?>

            <p style="color: white;">No extensions available.</p>

        <?php } ?>


        <p class="clear"></p>

    </div>

    <?php include NEWSLETTER_DIR . '/tnp-footer.php'; ?>

</div>
