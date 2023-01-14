<?php
use EB\WPNotice\Notices;
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class EssentialAdmin
{

    private $insights = null;

    public function __construct()
    {
        $this->migration_options_db();
        $this->plugin_usage_insights();
        add_action('admin_init', array($this, 'notices'));
        add_action('admin_menu', array($this, 'add_menu_page'));
        add_action('wp_ajax_save_eb_admin_options', [$this, 'eb_save_blocks']);
        register_activation_hook(ESSENTIAL_BLOCKS_FILE, array($this, 'activate'));
    }

	/**
	 * Admin notices for Review and others.
	 *
	 * @return void
	 */
	public function notices(){
		if( ! class_exists('\EB\WPNotice\Notices') ) {
            require_once ESSENTIAL_BLOCKS_DIR_PATH . '/includes/wp-notice/wpnotice.php';
        }

		$notices = new Notices([
            'id'          => 'essential_blocks',
            'store'       => 'options',
            'storage_key' => 'notices',
            'version'     => '1.0.0',
            'lifetime'    => 3,
            'styles'      => ESSENTIAL_BLOCKS_URL . 'assets/css/notices.css',
        ]);

        /**
         * Review Notice
         * @var mixed $message
         */



        $message = __(
            'We hope you\'re enjoying Essential Block for Gutenberg! Could you please do us a BIG favor and give it a 5-star rating on WordPress to help us spread the word and boost our motivation?',
            'essential-blocks'
        );

        $_review_notice = [
            'thumbnail' => ESSENTIAL_BLOCKS_URL . 'assets/images/eb-logo.svg',
            'html' => '<p>'. $message .'</p>',
            'links' => [
                'later' => array(
                    'link' => 'https://wordpress.org/support/plugin/essential-blocks/reviews/#new-post',
                    'label' => __( 'Sure, you deserve it!', 'essential-blocks' ),
                    'icon_class' => 'dashicons dashicons-external',
                    'attributes' => [
                        'target' => '_blank',
                        'class' => 'btn',
                        'data-dismiss' => false
                    ],
                ),
                'allready' => array(
                    'label' => __( 'I already did', 'essential-blocks' ),
                    'icon_class' => 'dashicons dashicons-smiley',
                    'attributes' => [
                        'data-dismiss' => true
                    ],
                ),
                'maybe_later' => array(
                    'label' => __( 'Maybe Later', 'essential-blocks' ),
                    'icon_class' => 'dashicons dashicons-calendar-alt',
                    'attributes' => [
                        'data-later' => true,
                        'class' => 'dismiss-btn'
                    ],
                ),
                'support' => array(
                    'link' => 'https://wpdeveloper.com/support',
                    'attributes' => [
                        'target' => '_blank',
                    ],
                    'label' => __( 'I need help', 'essential-blocks' ),
                    'icon_class' => 'dashicons dashicons-sos',
                ),
                'never_show_again' => array(
                    'label' => __( 'Never show again', 'essential-blocks' ),
                    'icon_class' => 'dashicons dashicons-dismiss',
                    'attributes' => [
                        'data-dismiss' => true
                    ],
                )
            ]
        ];

        $notices->add(
            'review',
            $_review_notice,
            [
                'start'       => $notices->strtotime('+10 days'),
                // 'start'       => $notices->time(),
                'recurrence'  => 15,
                'dismissible' => true,
                'refresh'     => ESSENTIAL_BLOCKS_VERSION,
                'screens'     => [
                    'dashboard', 'plugins', 'themes', 'edit-page',
                    'edit-post', 'users', 'tools', 'options-general',
                    'nav-menus'
                ]
            ]
        );

        /**
         * Opt-In Notice
         */
        if( $this->insights != null ) {
            $notices->add(
                'opt_in',
                [ $this->insights, 'notice' ],
                [
                    'classes'     => 'updated put-dismiss-notice',
                    'start'       => $notices->time(),
                    'dismissible' => true,
                    'do_action'   => 'wpdeveloper_notice_clicked_for_essential-blocks',
                ]
            );
        }

		$notices->init();
	}

    public function plugin_usage_insights(){
        if( ! class_exists('EBPluginInsights') ) {
            require_once ESSENTIAL_BLOCKS_DIR_PATH . '/includes/class-plugin-usage-tracker.php';
        }

        $this->insights = EBPluginInsights::get_instance( ESSENTIAL_BLOCKS_FILE, [
			'opt_in'       => true,
			'goodbye_form' => true,
			'item_id'      => 'fa45e4a52a650579e98c'
		] );
		$this->insights->set_notice_options(array(
			'notice' => __( 'Congratulations, you’ve successfully installed <strong>Essential Blocks for Gutenberg</strong>. We got <strong style="color: #a022ff;">1000+ FREE Gutenberg ready Templates</strong> waiting for you <span class="gift-icon">&#127873;</span>', 'essential-blocks' ),
			'extra_notice' => __( 'We collect non-sensitive diagnostic data and plugin usage information.
			Your site URL, WordPress & PHP version, plugins & themes and email address to send you exciting deals. This data lets us make sure this plugin always stays compatible with the most
			popular plugins and themes.', 'essential-blocks' ),
            'yes'=> __( 'Send me FREE Templates', 'wpinsight' ),
            'no'=> __( 'I don\'t want FREE Templates', 'wpinsight' ),
		));
		$this->insights->init();
    }

    public function migration_options_db()
    {
        $opt_db_migration = get_option('eb_opt_migration', false);
        if (version_compare(ESSENTIAL_BLOCKS_VERSION, '1.3.1', '==') && $opt_db_migration === false) {
            update_option('eb_opt_migration', true);
            $all_blocks = get_option('essential_all_blocks', []);
            $blocks = [];
            if (!empty($all_blocks)) {
                foreach ($all_blocks as $block) {
                    $blocks[$block['value']] = $block;
                }
            }
            update_option('essential_all_blocks', $blocks);
        }
    }

    public function add_menu_page()
    {
        add_menu_page(
            __('Essential Blocks', 'essential-blocks'),
            __('Essential Blocks', 'essential-blocks'),
            'delete_user',
            'essential-blocks',
            array($this, 'menu_page_display'),
            ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/images/eb-icon-21x21.svg',
            100
        );
    }

    public function menu_page_display()
    {
        include ESSENTIAL_BLOCKS_DIR_PATH . 'includes/menu-page-display.php';
    }

    public function activate()
    {
        update_option('essential_all_blocks', EBBlocks::get_default_blocks());
    }

    public function eb_save_blocks()
    {
        if (!wp_verify_nonce($_POST['_wpnonce'], 'eb-save-admin-options')) {
            die('Security check');
        } else {
            update_option('essential_all_blocks', $_POST['all_blocks']);
        }
        die();
    }

    /**
     * Get the version number
     */
    public static function get_version($path)
    {
        if (defined('EB_DEV') && EB_DEV === true) {
            return filemtime($path);
        } else {
            return ESSENTIAL_BLOCKS_VERSION;
        }
    }
}
