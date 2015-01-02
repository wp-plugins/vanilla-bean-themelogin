<?php
/*
Plugin Name: vanilla-bean-themelogin
Plugin URI: 
Description: 
Version: 1.0.0
Author:
Author URI: 
License: GPLv2
*/


            // If this file is called directly, abort.
            if ( ! defined( 'WPINC' ) ) {
                    die;
            }

            if ( !defined( 'VBEANTHEMELOGIN_PLUGIN_DIR' ) ) {
                    define( 'VBEANTHEMELOGIN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
            }
            if ( !defined( 'VBEANTHEMELOGIN_PLUGIN_URL' ) ) {
                    define( 'VBEANTHEMELOGIN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
            }
            if ( !defined( 'VBEANTHEMELOGIN_PLUGIN_FILE' ) ) {
                    define( 'VBEANTHEMELOGIN_PLUGIN_FILE', __FILE__ );
            }
            if ( !defined( 'VBEANTHEMELOGIN_PLUGIN_VERSION' ) ) {
                    define( 'VBEANTHEMELOGIN_PLUGIN_VERSION', '1.0.0' );
            }

            /*===========================================
                    Define Includes
            ===========================================*/
            $includes = array(
                'functions.php'
            );

            $frontend_includes = array(
                'themelogin.php'
            );


            $adminincludes= array(
                'settings.php'
            );

            /*===========================================
                    Load Includes
            ===========================================*/
            // Common
            foreach ( $includes as $include ) {
                    require_once( dirname( __FILE__ ) . '/inc/'. $include );
            }
            if(is_admin()){		
            //load admin part
                foreach ( $adminincludes as $admininclude ) {
                    require_once( dirname( __FILE__ ) . '/inc/admin/'. $admininclude );
                }
            }else{
            //load front part
                foreach ( $frontend_includes as $include ) {
                        require_once( dirname( __FILE__ ) . '/inc/'. $include );
                }
            }

            add_action('admin_menu', 'vbean_themelogin_create_menu');

            function vbean_themelogin_create_menu() {

                    //create new top-level menu
                    add_menu_page('Vanilla Bean Themelogin', 'Theme Login', 'administrator', __FILE__, 'VanillaBeans\Themelogin\vbean_rendersettings');

                    //call register settings function
                    add_action( 'admin_init', 'VanillaBeans\Themelogin\RegisterSettings' );
            }
