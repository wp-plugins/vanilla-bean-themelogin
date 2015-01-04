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
namespace VanillaBeans;

if(function_exists('\VanillaBeans\vanillabeans_settings')){
  return  ;
}else{
    function vanillabeans_settings() {
        ?>
<style>
    .addendum{
        
    }
</style>
<div class="wrap">
<h2>Vanilla Beans for Wordpress</h2>
<p>Vanilla Beans are part of Velvary's ever evolving library of plugins and modules for Wordpress and other Open Source Web Applications.</p>
<p>Created with the simplistic yet tasty vanilla approach, our beans are here to help the creative concentrate on creative, and the technical people minimize the mundane.  </p>
<ul>
    <li>
    <?php if(defined( 'VBEANERRORMAILER_PLUGIN_VERSION' )){ 
        echo('<a href="'.admin_url().'admin.php?page='.VBEANERRORMAILER_PLUGIN_DIR.'/'.VBEANERRORMAILER_PLUGIN_FILE.'">Error Mailer</a> (installed)');
    }else{
        echo('<a href="'.admin_url().'plugin-install.php?tab=search&type=term&s=vanilla+bean+error+mailer">Error Mailer</a>');
        
    }?>
        <div class="small-text">Facilitates email notification of php errors on your site. Configurable to avoid unnecessary spamming of known errors.</div>
    </li>
    <li>
    <?php if(defined( 'VBEANTHEMELOGIN_PLUGIN_VERSION' )){ 
        echo('<a href="'.admin_url().'admin.php?page='.VBEANTHEMELOGIN_PLUGIN_DIR.'/'.VBEANTHEMELOGIN_PLUGIN_FILE.'">Theme Login</a> (installed)');
        }else {
        echo('<a href="'.admin_url().'plugin-install.php?tab=search&type=term&s=vanilla+bean+theme+login">Theme Login</a>');
     }?>
        <div class="small-text">Themify your login and password recovery pages.</div>
    </li>
<!--    <li>
    <?php if(defined( 'VBEANICONSETTER_PLUGIN_VERSION' )){ 
       echo('<a href="'.admin_url().'admin.php?page='.VBEANICONSETTER_PLUGIN_DIR.'/'.VBEANICONSETTER_PLUGIN_FILE.'">Icon Setter</a> (installed)');
    }else {
        echo('<a href="'.admin_url().'plugin-install.php?tab=search&type=term&s=vanilla+bean+icon+setter">Icon Setter</a>');
     }?>
        <div class="small-text">Add your site's icon to each page, and across all devices.</div>

    </li>-->
</ul>

</div>
            <?php

    }
}




if(function_exists('\VanillaBeans\vbean_ListPhp')) {
return;}else{
    function vbean_ListPhp($dir, $prefix = '') {
        $dir = rtrim($dir, '\\/');
        $result = array();

        $h = opendir($dir);
        try{
            while (($f = readdir($h)) !== false) {
              if ($f !== '.' and $f !== '..') {
                if (is_dir("$dir/$f")) {
                      $result = array_merge($result, vbean_ListPhp("$dir/$f", "$prefix$f/"));
                } else {
                 if(vbean_endsWith($f, '.php') &! vbean_startsWith($f, '.')){
                  $result[] = $prefix.$f;
                      }
                  }
                }
              }
        } catch (Exception $ex) {
            $e=$ex;
        }
        closedir($h);

        return $result;
    }
}

if(!function_exists('\VanillaBeans\vbean_endsWith')) {
    function vbean_endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    $lcneedle = strtolower($needle).'';
    $lchaystack = strtolower($haystack).'';
            
    return $lcneedle === "" || strpos($lchaystack, $lcneedle, (strlen($lchaystack) - strlen($lcneedle))) !== FALSE;
}
}

if(!function_exists('\VanillaBeans\vbean_startsWith')) {
    function vbean_startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        $lcneedle = strtolower($needle).'';
        $lchaystack = strtolower($haystack).'';
    return $lcneedle === "" || strrpos($lchaystack, $lcneedle, -strlen($lchaystack)) !== FALSE;
    }
}




if(!function_exists('\VanillaBeans\vbean_setting')){
    // returns a default val if get_option is empty
    function vbean_setting($name,$default){
        $sval = get_option($name);
        if(!isset($sval)||empty($sval)){
                return $default;
        }else{
            return get_option($name);
        }
    }
}

if(!function_exists('\VanillaBeans\vbean_setting')){
    // returns default if get_option not set, but returns empty if get_option is empty
    function vbean_textsetting($name,$default){
        $sval = get_option($name);
        if(!isset($sval)){
                return $default;
        }else{
            return get_option($name);
        }
    }
}