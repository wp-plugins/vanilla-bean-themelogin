<?php
/* 
Copyright (C) Error: on line 4, column 33 in Templates/Licenses/license-wp-gpl20.txt
The string doesn't match the expected date/time format. The string to parse was: "31/12/2014". The expected format was: "MMM d, yyyy". Velvary Pty Ltd

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/
namespace VanillaBeans\ThemeLogin;
            // If this file is called directly, abort.

if(!function_exists('vbean_login_logo')){
    function vbean_login_logo() { 
    $uri = ''.get_option('vbean_themelogin_logo');
    
        
        if(\VanillaBeans\vbean_startsWith($uri, 'http') || \VanillaBeans\vbean_endsWith($uri, '.jpg') || \VanillaBeans\vbean_endsWith($uri, '.gif') || \VanillaBeans\vbean_endsWith($uri, '.png') || \VanillaBeans\vbean_endsWith($uri, '.jpeg') || \VanillaBeans\vbean_endsWith($uri, '.jpe') || \VanillaBeans\vbean_endsWith($uri, '.svg')){
            
        
            
            ?>
                <style type="text/css">
                    body.login div#login h1 a {
                        background-image: url(<?php echo($uri)?>);
                        padding-bottom: 30px;
                    }
                </style>
                <?php
            
            


//            <style type="text/css">
//            body.login div#login h1 a {
//                background-image: none !important;
//                padding-bottom: 10px;
//                text-indent:0 !important;
//            }
//            body.login div#login h1{display:none !important;}
//            </style>
            
          
        }else{ ?>  
            
        <style type="text/css">
            body.login div#login h1 a {
                background-image: none !important;
                padding-bottom: 0;
                text-indent:0 !important;
            }

            body.login div#login h1 {width:100% !important;}
            body.login h1 a{
                width:100% !important;
                background-size: 100% 114px !important;
            }
        </style>
        <script language="javascript" type="text/javascript">
            window.onload=function(){
                    var conti = top.document.getElementById('login');
                    if(conti!==undefined){
                        var atag = conti.getElementsByTagName('A');
                        if(atag!=null&&atag.length>0){
                            atag[0].innerHTML = <?php echo json_encode($uri)  ?>;
                        }
                    }
                
            };
        
        </script>


    <?php }
    return;
    }
}

if(!function_exists('vbean_login_logo_url')){
    function vbean_login_logo_url() {
    return home_url();
}
}

if(!function_exists('vbean_login_logo_url_title')){
    function vbean_login_logo_url_title() {
    return get_option('vbean_themelogin_sitename').'';
}
}

if(!function_exists('vbean_login_stylesheet')){
    function vbean_login_stylesheet() {
    $styles=  get_option('vbean_themelogin_cssfiles').'';
    if(strlen($styles)>5){
        $styles = explode("\n", $styles); 
        foreach ($styles as $css){
            if(\VanillaBeans\vbean_endsWith($css, '.css')){
                if(get_option('vbean_themelogin_cssfilesrelative')){
                    wp_enqueue_style( 'custom-login', get_template_directory_uri() . $css, 10 );
                }else{
                    wp_enqueue_style( 'custom-login', $css, 10);
                }
            }
        }
        
    }
}
}

if(!function_exists('')){
    function vbean_login_styles() {
    $bg = ''.get_option('vbean_themelogin_background');
    if(\VanillaBeans\vbean_endsWith($bg, '.jpg') || \VanillaBeans\vbean_endsWith($bg, '.gif') || \VanillaBeans\vbean_endsWith($bg, '.png') || \VanillaBeans\vbean_endsWith($bg, '.jpeg') || \VanillaBeans\vbean_endsWith($bg, '.jpe') || \VanillaBeans\vbean_endsWith($bg, '.svg')){
        $repeat=\VanillaBeans\vbean_setting('vbean_themelogin_bglayout','repeat');
        $fixed='inherit';
        if((string)get_option('vbean_themelogin_background_fixed')==='1'){
            $fixed='fixed';
        }
        $bgwidth = get_option('vbean_themelogin_bg_width');
        $bgheight = get_option('vbean_themelogin_bg_height');
        $bgwunit = get_option('vbean_themelogin_bg_width_unit');
        $bghunit = get_option('vbean_themelogin_bg_height_unit');
        
        // start the string
        
        $s = 'body.login { background-image : URL('.$bg.'); background-repeat:'.$repeat.'; background-attachment: '.$fixed.';';
        if(is_numeric($bgwidth)){
            $s.='background-size: '.$bgwidth.  str_replace('percent', '%', $bgwunit);
            if(is_int($bgheight)){
                $s.=' '.$bgheight.  str_replace('percent', '%', $bghunit);
            }
            $s.=';';
        }
        $s.='}';
    }
    
    
    $css = get_option('vbean_themelogin_css');
 ?>
    <style type="text/css">
        <?php echo $css ?>
        <?php echo $s; ?>
    </style>
<?php    
}
}


if(get_option('vbean_themelogin_override')){
    add_action( 'login_enqueue_scripts', '\VanillaBeans\ThemeLogin\vbean_login_stylesheet' );
    add_action( 'login_enqueue_scripts', '\VanillaBeans\ThemeLogin\vbean_login_logo' );
    add_action( 'login_enqueue_scripts', '\VanillaBeans\ThemeLogin\vbean_login_styles' );
    add_filter( 'login_headerurl', '\VanillaBeans\ThemeLogin\vbean_login_logo_url' );
    add_filter( 'login_headertitle', '\VanillaBeans\ThemeLogin\vbean_login_logo_url_title' );
}
