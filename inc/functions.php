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

if(function_exists('VanillaBeans\vbean_ListPhp')) {
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

if(!function_exists('VanillaBeans\vbean_endsWith')) {
    function vbean_endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    $lcneedle = strtolower($needle);
    $lchaystack = strtolower($haystack);
            
    return $lcneedle === "" || strpos($lchaystack, $lcneedle, strlen($lchaystack) - strlen($lcneedle)) !== FALSE;
}
}

if(!function_exists('VanillaBeans\vbean_startsWith')) {
    function vbean_startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        $lcneedle = strtolower($needle);
        $lchaystack = strtolower($haystack);
    return $lcneedle === "" || strrpos($lchaystack, $lcneedle, -strlen($lchaystack)) !== FALSE;
    }
}


if(!function_exists('VanillaBeans\vbean_setting')){
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

if(!function_exists('VanillaBeans\vbean_setting')){
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