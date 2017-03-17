<?php
if (!defined('ABSPATH')) exit;

require_once NEWSLETTER_INCLUDES_DIR . '/themes.php';
require_once NEWSLETTER_INCLUDES_DIR . '/module.php';

class NewsletterEmails extends NewsletterModule {

    static $instance;

    /**
     * @return NewsletterEmails
     */
    static function instance() {
        if (self::$instance == null) {
            self::$instance = new NewsletterEmails();
        }
        return self::$instance;
    }

    function __construct() {
        $this->themes = new NewsletterThemes('emails');
        parent::__construct('emails', '1.1.5');
        add_action('wp_loaded', array($this, 'hook_wp_loaded'));
    }

    function hook_wp_loaded() {
        global $wpdb;

        $newsletter = Newsletter::instance();

        switch ($newsletter->action) {
            case 'v':
                // TODO: Change to Newsletter::instance()->get:email(), not urgent
                $email = $this->get_email((int) $_GET['id']);
                if (empty($email)) {
                    die('Email not found');
                }

                if ($email->private == 1) {
                    die('No available for online view');
                }

                $user = NewsletterSubscription::instance()->get_user_from_request();
                header('Content-Type: text/html;charset=UTF-8');
                header('X-Robots-Tag: noindex,nofollow,noarchive');
                header('Cache-Control: no-cache,no-store,private');
                
                // TODO: To be removed
                if (is_file(WP_CONTENT_DIR . '/extensions/newsletter/view.php')) {
                    include WP_CONTENT_DIR . '/extensions/newsletter/view.php';
                    die();
                }

                echo $newsletter->replace($email->message, $user, $email->id);

                die();
                break;

            case 'emails-css':
                $email_id = (int) $_GET['id'];

                $body = Newsletter::instance()->get_email_field($email_id, 'message');

                $x = strpos($body, '<style');
                if ($x === false)
                    return;

                $x = strpos($body, '>', $x);
                $y = strpos($body, '</style>');

                header('Content-Type: text/css;charset=UTF-8');

                echo substr($body, $x + 1, $y - $x - 1);

                die();
                break;

            case 'emails-preview':
                if (!current_user_can('manage_categories')) {
                    die('Not enough privileges');
                }

                if (Newsletter::instance()->options['editor'] != 1 && !current_user_can('manage_options')) {
                    die('Not enough privileges');
                }
                if (!check_admin_referer('view')) {
                    die();
                }

                // Used by theme code
                $theme_options = $this->get_current_theme_options();
                $theme_url = $this->get_current_theme_url();
                header('Content-Type: text/html;charset=UTF-8');

                include($this->get_current_theme_file_path('theme.php'));

                die();
                break;

            case 'emails-preview-text':
                header('Content-Type: text/plain;charset=UTF-8');
                if (!current_user_can('manage_categories')) {
                    die('Not enough privileges');
                }

                if (Newsletter::instance()->options['editor'] != 1 && !current_user_can('manage_options')) {
                    die('Not enough privileges');
                }

                if (!check_admin_referer('view')) {
                    die();
                }

                // Used by theme code
                $theme_options = $this->get_current_theme_options();

                $file = $this->get_current_theme_file_path('theme-text.php');
                if (is_file($file)) {
                    include($this->get_current_theme_file_path('theme-text.php'));
                }

                die();
                break;


            case 'emails-create':

                if (!current_user_can('manage_categories')) {
                    die('Not enough privileges');
                }

                if ($newsletter->options['editor'] != 1 && !current_user_can('manage_options')) {
                    die('Not enough privileges');
                }

                require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
                $controls = new NewsletterControls();

                if ($controls->is_action('create')) {
                    $this->save_options($controls->data);

                    $email = array();
                    $email['status'] = 'new';
                    $email['subject'] = ''; //__('Here the email subject', 'newsletter');
                    $email['track'] = 1;

                    $theme_options = $this->get_current_theme_options();

                    $theme_url = $this->get_current_theme_url();
                    $theme_subject = '';

                    ob_start();
                    include $this->get_current_theme_file_path('theme.php');
                    $email['message'] = ob_get_clean();

                    if (!empty($theme_subject)) {
                        $email['subject'] = $theme_subject;
                    }

                    ob_start();
                    include $this->get_current_theme_file_path('theme-text.php');
                    $email['message_text'] = ob_get_clean();

                    $email['type'] = 'message';
                    $email['send_on'] = time();
                    $email = $newsletter->save_email($email);

                    header('Location: ' . $this->get_admin_page_url('edit') . '&id=' . $email->id);
                }
                die();
                break;
        }
    }

    function upgrade() {
        global $wpdb, $charset_collate;

        parent::upgrade();

        $this->upgrade_query("alter table " . NEWSLETTER_EMAILS_TABLE . " change column `type` `type` varchar(50) not null default ''");
        $this->upgrade_query("alter table " . NEWSLETTER_EMAILS_TABLE . " add column token varchar(10) not null default ''");
        $this->upgrade_query("alter table " . NEWSLETTER_EMAILS_TABLE . " drop column visibility");
        $this->upgrade_query("alter table " . NEWSLETTER_EMAILS_TABLE . " add column private tinyint(1) not null default 0");

        // Force a token to email without one already set.
        //$token = self::get_token();
        //$wpdb->query("update " . NEWSLETTER_EMAILS_TABLE . " set token='" . $token . "' where token=''");
        if ($this->old_version < '1.1.5') {
            $this->upgrade_query("update " . NEWSLETTER_EMAILS_TABLE . " set type='message' where type=''");
            $wpdb->query("update " . NEWSLETTER_EMAILS_TABLE . " set token=''");
        }
        $wpdb->query("update " . NEWSLETTER_EMAILS_TABLE . " set total=sent where status='sent' and type='message'");

        return true;
    }

    function admin_menu() {
        $this->add_menu_page('index', 'Newsletters');
        $this->add_admin_page('list', 'Email List');
        $this->add_admin_page('new', 'Email New');
        $this->add_admin_page('edit', 'Email Edit');
        $this->add_admin_page('theme', 'Email Themes');
        $this->add_admin_page('composer', 'The Composer');
        $this->add_admin_page('cpreview', 'The Composer Preview');
    }

    /**
     * Returns the current selected theme.
     */
    function get_current_theme() {
        $theme = $this->options['theme'];
        if (empty($theme))
            return 'blank';
        else
            return $theme;
    }

    function get_current_theme_options() {
        $theme_options = $this->themes->get_options($this->get_current_theme());
        // main options merge
        $main_options = Newsletter::instance()->options;
        foreach ($main_options as $key => $value) {
            $theme_options['main_' . $key] = $value;
        }
        return $theme_options;
    }

    /**
     * Returns the file path to a theme using the theme overriding rules.
     * @param type $theme
     * @param type $file
     */
    function get_theme_file_path($theme, $file) {
        return $this->themes->get_file_path($theme);
    }

    function get_current_theme_file_path($file) {
        return $this->themes->get_file_path($this->get_current_theme(), $file);
    }

    function get_current_theme_url() {
        return $this->themes->get_theme_url($this->get_current_theme());
    }

    /**
     * Returns true if the emails database still contain old 2.5 format emails.
     *
     * @return boolean
     */
    function has_old_emails() {
        return $this->store->get_count(NEWSLETTER_EMAILS_TABLE, "where type='email'") > 0;
    }

    function convert_old_emails() {
        global $newsletter;
        $list = $newsletter->get_emails('email', ARRAY_A);
        foreach ($list as &$email) {
            $email['type'] = 'message';
            $query = "select * from " . NEWSLETTER_USERS_TABLE . " where status='C'";

            if ($email['list'] != 0)
                $query .= " and list_" . $email['list'] . "=1";
            $email['preferences'] = $email['list'];

            if (!empty($email['sex'])) {
                $query .= " and sex='" . $email['sex'] . "'";
            }
            $email['query'] = $query;

            $newsletter->save_email($email);
        }
    }

}

NewsletterEmails::instance();
