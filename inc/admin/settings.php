<?php

/* 
 * Copyright (C) 2014 Velvary Pty Ltd
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
// upgrade plan to provide autocomplete
namespace VanillaBeans\ThemeLogin;
            // If this file is called directly, abort.
            if ( ! defined( 'WPINC' ) ) {
                    die;
            }

function RegisterSettings(){
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_override' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_logo' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_sitename' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_css' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_cssfiles' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_cssfilesrelative' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_background' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_bglayout' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_background_fixed' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_bg_width' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_bg_width_unit' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_bg_height' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_bg_height_unit' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_maskit' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_mask' );
	register_setting( 'vbean-themelogin-settings', 'vbean_themelogin_bg_colour' );
}



function vbean_themelogin_admin_scripts() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('jquery');
}

function vbean_themelogin_admin_styles() {
    wp_enqueue_style('thickbox');
}

    add_action('admin_print_scripts', 'VanillaBeans\ThemeLogin\vbean_themelogin_admin_scripts');
    add_action('admin_print_styles', 'VanillaBeans\ThemeLogin\vbean_themelogin_admin_styles');    


function vbean_rendersettings(){
    ?>

<style>
    .statuscolour{
        
    }
    .colourbox{
        position:relative;
        display:inline-block;
        width:100px;
    }
    .colourboxes{
        position:relative;
        display:inline-block;
    }
</style>
<script language="javascript" type="text/javascript" >
    jQuery(document).ready(function(){
        jQuery(".statuscolour").spectrum({
            showInput: true,
            preferredFormat: "hex",
            allowEmpty:true
        });
        
    });
</script>

        <div class="wrap">
        <h2>Vanilla Bean Custom Login Settings</h2>
            <form method="post" action="options.php">
    <?php settings_fields( 'vbean-themelogin-settings' ); ?>
    <?php do_settings_sections( 'vbean-themelogin-settings' ); ?>

                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Override</th>
                        <td><input type="checkbox" class="checkbox" name="vbean_themelogin_override"  id="vbean_themelogin_override" value="1" <?php echo checked(1, get_option('vbean_themelogin_override'), false)   ?>/>Override the default login page
                            <div class="description">Check this to implement overrides specified below.</div>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Site Name</th>
                        <td><input type="text" class="text" name="vbean_themelogin_sitename"  id="vbean_themelogin_sitename" value="<?php echo get_option('vbean_themelogin_sitename')   ?>" style="width:300px;" />
                            <div class="description">The name and info about your site.</div>
                        </td>
                    </tr>

                    <tr valign="top">
                            <th>Logo</th>
                            <td><label for="upload_image">
                                    <input id="vbean_themelogin_logo" type="text" size="36" name="vbean_themelogin_logo" value="<?php echo  \VanillaBeans\vbean_setting('vbean_themelogin_logo',''); ?>" />
                                    <input id="upload_image_button" type="button" value="Choose Logo" />
                                    <br />Enter an URL or upload an image for the banner Logo.
                                    </label>
                            </td>
                    </tr>                
                
                    <tr valign="top">
                            <th>Page Background</th>
                            <td><label for="upload_image">
                                    <input id="vbean_themelogin_background" type="text" size="36" style="width:300px;" name="vbean_themelogin_background" value="<?php echo  \VanillaBeans\vbean_setting('vbean_themelogin_background',''); ?>" />
                                    <input id="upload_background_button" type="button" value="Choose Background" /></label>
                                    <select name="vbean_themelogin_bglayout" id="vbean_themelogin_bglayout">
                                        <option value="no-repeat" <?php if(get_option('vbean_themelogin_bglayout')=='no-repeat'){echo ' SELECTED';} ?>  >Singular</option>
                                        <option value="repeat" <?php if(get_option('vbean_themelogin_bglayout')=='repeat'){echo ' SELECTED';} ?>  >Tiled</option>
                                        <option value="repeat-x" <?php if(get_option('vbean_themelogin_bglayout')=='repeat-x'){echo ' SELECTED';} ?>  >Tiled left to right only</option>
                                        <option value="repeat-y" <?php if(get_option('vbean_themelogin_bglayout')=='repeat-y'){echo ' SELECTED';} ?>  >Tiled top to bottom only</option>
                                    </select>
                                    <input type="checkbox" class="checkbox" name="vbean_themelogin_background_fixed"  id="vbean_themelogin_background_fixed" value="1" <?php echo checked(1, get_option('vbean_themelogin_background_fixed'), false)   ?>/>&nbsp;Background should not scroll with page
                                    <br />Width:<input id="vbean_themelogin_bg_width" type="number" class="number" size="36" style="width:50px;" name="vbean_themelogin_bg_width" value="<?php echo  \VanillaBeans\vbean_setting('vbean_themelogin_bg_width',''); ?>" /><select name="vbean_themelogin_bg_width_unit" id="vbean_themelogin_bg_width_unit">
                                        <option value="percent" <?php if(get_option('vbean_themelogin_bg_width_unit')=='no-repeat'){echo ' SELECTED';} ?>  >%</option>
                                        <option value="pixels" <?php if(get_option('vbean_themelogin_bg_width_unit')=='no-repeat'){echo ' SELECTED';} ?>  >pixels</option></select>
                                        Height:<input id="vbean_themelogin_bg_height" type="number" class="number" size="36" style="width:50px;" name="vbean_themelogin_bg_height" value="<?php echo  \VanillaBeans\vbean_setting('vbean_themelogin_bg_height',''); ?>" /><select name="vbean_themelogin_bg_height_unit" id="vbean_themelogin_bg_height_unit">
                                        <option value="percent" <?php if(get_option('vbean_themelogin_bg_height_unit')=='no-repeat'){echo ' SELECTED';} ?>  >%</option>
                                        <option value="pixels" <?php if(get_option('vbean_themelogin_bg_height_unit')=='no-repeat'){echo ' SELECTED';} ?>  >pixels</option>
                                    </select>
                                    <br />You may choose an image for the page background, and specify how it looks.
                                    
                                    <br />
                <div class="colourboxes">
                <div class="colourbox">
                    <div class="colourtitle" style="width:140px;">Colour: </div>
                    <input type="text" name="vbean_themelogin_bg_colour" id="vbean_themelogin_bg_colour" value="<?php echo esc_attr(\VanillaBeans\vbean_setting('vbean_themelogin_bg_colour','') ); ?>" class="statuscolour" />
                </div>
                                    
                                    
                            </td>
                    </tr>                

                            
                
                    <tr valign="top">
                            <th>CSS Override</th>
                            <td>
                                <textarea cols="60" rows="6" name="vbean_themelogin_css" id="vbean_themelogin_css"><?php echo get_option('vbean_themelogin_css')?></textarea>

                                <div class="description">Styles to override the login page styles. <button id="showstylesbutton">Show Login Styles</button> </div>

                                    
                            </td>
                    </tr>                
                
                    <tr valign="top">
                            <th>CSS files</th>
                            <td><input type="checkbox" class="checkbox" name="vbean_themelogin_cssfilesrelative"  id="vbean_themelogin_cssfilesrelative" value="1" <?php echo checked(1, get_option('vbean_themelogin_cssfilesrelative'), false)   ?>/>Relative to theme<br /> 
                                <textarea cols="60" rows="6" name="vbean_themelogin_cssfiles" id="vbean_themelogin_cssfiles"><?php echo get_option('vbean_themelogin_cssfiles')?></textarea>

                                                                <div class="description">Path to css files you would like to load for login page.</div>

                                    
                            </td>
                    </tr>                
                
                </table>
            <?php submit_button(); ?>
            </form>
            </div>

<pre>
    <?php 
//    echo get_stylesheet_directory_uri();
//    echo PHP_EOL;
//        $theme = get_theme_root_uri();
//        var_dump($theme);
    
    ?>
    
</pre>


<div style="display:none;" id="loginstyleshiddendiv">
        <pre id="csscodeforlogin">
/* below are styles specified in wordpress css
    be sure to use !important */
    body.login {}
    body.login div#login {}
    body.login div#login h1 {}
    body.login div#login h1 a {}
    body.login div#login form#loginform {}
    body.login div#login form#loginform p {}
    body.login div#login form#loginform p label {}
    body.login div#login form#loginform input {}
    body.login div#login form#loginform input#user_login {}
    body.login div#login form#loginform input#user_pass {}
    body.login div#login form#loginform p.forgetmenot {}
    body.login div#login form#loginform p.forgetmenot input#rememberme {}
    body.login div#login form#loginform p.submit {}
    body.login div#login form#loginform p.submit input#wp-submit {}
    body.login div#login p#nav {}
    body.login div#login p#nav a {}
    body.login div#login p#backtoblog {}
    body.login div#login p#backtoblog a {}    
    </pre>
    <div><button id="hidestylesusedforlogin">Hide</button></div>
</div>
<div style="display:none;" id="wordpresscss">
    /* used for login header */
    .login h1 a {
	background-image: url('../images/w-logo-blue.png?ver=20131202');
	background-image: none, url('../images/wordpress-logo.svg?ver=20131107');
	background-size: 80px 80px;
	background-position: center top;
	background-repeat: no-repeat;
	color: #999;
	height: 80px;
	font-size: 20px;
	font-weight: normal;
	line-height: 1.3em;
	margin: 0 auto 25px;
	padding: 0;
	text-decoration: none;
	width: 80px;
	text-indent: -9999px;
	outline: none;
	overflow: hidden;
	display: block;
    }
</div>



<script language="JavaScript">
    var theformfield;
jQuery(document).ready(function() {
    
    jQuery("#vbean_themelogin_css").attr('placeholder',jQuery('#csscodeforlogin').text());
    jQuery("#showstylesbutton").on('click touchend',function(e){
        
        jQuery("#loginstyleshiddendiv").show();
        e.preventDefault();
    });
    
    
    jQuery("#hidestylesusedforlogin").on('click touchend',function(e){
        e.preventDefault();
        jQuery("#loginstyleshiddendiv").hide();
    });
    
        
        
    jQuery('#upload_image_button').click(function() {
        theformfield = '#vbean_themelogin_logo';
        formfield = jQuery('#vbean_themelogin_logo').attr('name');
        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
        
    jQuery('#upload_background_button').click(function() {
        theformfield = '#vbean_themelogin_background';
        formfield = jQuery('#vbean_themelogin_background').attr('name');
        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });

    window.send_to_editor = function(html) {
            imgurl = jQuery('img',html).attr('src');
            jQuery(theformfield).val(imgurl);
            tb_remove();
    };
});



</script>

<?php            }