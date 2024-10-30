<?php

defined('ABSPATH') or exit;

class HeaderCode
{

    const DOMAIN = 'header-code';

    public function __construct()
    {
        add_action('init', [$this, 'load_textdomain']);
        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('admin_init', [$this, 'admin_init']);
    }

    public function load_textdomain()
    {
        load_plugin_textdomain(self::DOMAIN, false,
            basename(__DIR__) . '/languages');
    }

    public function admin_menu()
    {
        $title = __('Header Code', self::DOMAIN);
        add_options_page($title, $title, 'manage_options', 'header-code',
            [$this, 'admin_page']);
    }

    public function admin_init()
    {        
        register_setting('header_code', 'header_code');
        add_settings_section('default', false, false, 'header-code');
        add_settings_field('header_code', __('Insert code:', self::DOMAIN),
            [$this, 'field_callback'], 'header-code', 'default');
    }

    public function admin_page()
    {
        echo '<div class="wrap">'
            . '<h2>' . __('Header Code', self::DOMAIN) . '</h2>'
            . '<form method="post" action="options.php">';
        settings_fields('header_code');
        do_settings_sections('header-code');
        submit_button(); 
        echo '</form></div>';
    }

    public function field_callback()
    {
        echo '<textarea name="header_code" style="width: 100%; height: 200px;">'
            . esc_attr(get_option('header_code')) . '</textarea>';
    }

}

new HeaderCode;
