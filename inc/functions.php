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
        echo('<a href="'.admin_url().'admin.php?page=vanilla-bean-errormailer/vanillabean-errormailer.php">Error Mailer</a> (installed)');
    }else{
        echo('<a href="'.admin_url().'plugin-install.php?tab=search&type=term&s=vanilla+bean+error+mailer">Error Mailer</a>');
        
    }?>
        <div class="small-text">Facilitates email notification of php errors on your site. Configurable to avoid unnecessary spamming of known errors.</div>
    </li>
    <li>
    <?php if(defined( 'VBEANTHEMELOGIN_PLUGIN_VERSION' )){ 
        echo('<a href="'.admin_url().'admin.php?page=vanilla-bean-themelogin/vanilla-bean-themelogin.php">Theme Login</a> (installed)');
        }else {
        echo('<a href="'.admin_url().'plugin-install.php?tab=search&type=term&s=vanilla+bean+theme+login">Theme Login</a>');
     }?>
        <div class="small-text">Themify your login and password recovery pages.</div>
    </li>
   <li>
    <?php if(defined( 'VBEANFAVICON_PLUGIN_VERSION' )){ 
       echo('<a href="'.admin_url().'admin.php?page=vanilla-bean-icon-setter/vanilla-bean-icon-setter.php">Icon Setter</a> (installed)');
    }else {
        echo('<a href="'.admin_url().'plugin-install.php?tab=search&type=term&s=vanilla+bean+icon+setter">Icon Setter</a>');
     }?>
        <div class="small-text">Add your site's icon to each page, and across all devices.</div>

    </li>
</ul>

</div>
            <?php

    }
}

if(!function_exists('\VanillaBeans\LiveSettings')){
    
    function LiveSettings(){
	global $wpdb,$current_user,$user_role_permission,$wp_version;
	if(is_super_admin())
	{
		$role = "administrator";
	}
        
        if (!current_user_can('manage_options'))
        {
                return;
        }        
	if (file_exists(ABSPATH . "wp-admin/includes/plugin-install.php"))
	{
		include( ABSPATH . "wp-admin/includes/plugin-install.php" );
	}
	global $tabs, $tab, $paged, $type, $term;
	$tabs = array();
	$tab = "search";
	$per_page = 10;
	$args = array
	(
		"author"=> "vsmash",
		"page" => $paged,
		"per_page" => $per_page,
		"fields" => array( "last_updated" => true, "downloaded" => true, "icons" => true ),
		"locale" => get_locale(),
	);        
	$arges = apply_filters( "install_plugins_table_api_args_$tab", $args );
	$api = plugins_api( "query_plugins", $arges );
	$item = $api->plugins;
	?>
	<div class="fluid-layout" style="width:1000px;">
<h2>Vanilla Beans for Wordpress</h2>
<p>Vanilla Beans are part of Velvary's ever evolving library of plugins and modules for Wordpress and other Open Source Web Applications.</p>
<p>Created with the simplistic yet tasty vanilla approach, our beans are here to help the creative concentrate on creative, and the technical people minimize the mundane.  </p>            
            
            
		<div class="layout-span12">
			<div class="widget-layout">
				<div class="widget-layout-title">
					<h4>Other Beans for your Beanstalk</h4>
				</div>
				<div class="widget-layout-body">
					<div class="fluid-layout wpcb-page-width">
						<div class="layout-span12">
							<div class="wp-list-table plugin-install">
								<div id="the-list">
									<?php 
									foreach ((array) $item as $plugin) 
									{
										if (is_object( $plugin))
										{
											$plugin = (array) $plugin;
										}
										if (!empty($plugin["icons"]["svg"]))
										{
											$plugin_icon_url = $plugin["icons"]["svg"];
										} 
										elseif (!empty( $plugin["icons"]["2x"])) 
										{
											$plugin_icon_url = $plugin["icons"]["2x"];
										} 
										elseif (!empty( $plugin["icons"]["1x"]))
										{
											$plugin_icon_url = $plugin["icons"]["1x"];
										} 
										else 
										{
											$plugin_icon_url = $plugin["icons"]["default"];
										}
										$plugins_allowedtags = array
										(
											"a" => array( "href" => array(),"title" => array(), "target" => array() ),
											"abbr" => array( "title" => array() ),"acronym" => array( "title" => array() ),
											"code" => array(), "pre" => array(), "em" => array(),"strong" => array(),
											"ul" => array(), "ol" => array(), "li" => array(), "p" => array(), "br" => array()
										);
										$title = wp_kses($plugin["name"], $plugins_allowedtags);
										$description = strip_tags($plugin["short_description"]);
										$author = wp_kses($plugin["author"], $plugins_allowedtags);
										$version = wp_kses($plugin["version"], $plugins_allowedtags);
										$name = strip_tags( $title . " " . $version );
										$details_link   = self_admin_url( "plugin-install.php?tab=plugin-information&amp;plugin=" . $plugin["slug"] .
										"&amp;TB_iframe=true&amp;width=600&amp;height=550" );
										
										/* translators: 1: Plugin name and version. */
										$action_links[] = '<a href="' . esc_url( $details_link ) . '" class="thickbox" aria-label="' . esc_attr( sprintf("More information about %s", $name ) ) . '" data-title="' . esc_attr( $name ) . '">' . __( 'More Details' ) . '</a>';
										$action_links = array();
										if (current_user_can( "install_plugins") || current_user_can("update_plugins"))
										{
											$status = install_plugin_install_status( $plugin );
											switch ($status["status"])
											{
												case "install":
													if ( $status["url"] )
													{
														/* translators: 1: Plugin name and version. */
														$action_links[] = '<a class="install-now button" href="' . $status['url'] . '" aria-label="' . esc_attr( sprintf("Install %s now", $name ) ) . '">' . __( 'Install Now' ) . '</a>';
													}
												break;
												case "update_available":
													if ($status["url"])
													{
														/* translators: 1: Plugin name and version */
														$action_links[] = '<a class="button" href="' . $status['url'] . '" aria-label="' . esc_attr( sprintf( "Update %s now", $name ) ) . '">' . __( 'Update Now' ) . '</a>';
													}
												break;
												case "latest_installed":
												case "newer_installed":
													$action_links[] = '<span class="button button-disabled" title="' . esc_attr__( "This plugin is already installed and is up to date" ) . ' ">' . _x( 'Installed', 'plugin' ) . '</span>';
												break;
											}
										}
										?>
										<div class="plugin-div plugin-div-settings">
											<div class="plugin-div-top plugin-div-settings-top">
												<div class="plugin-div-inner-content">
													<a href="<?php echo esc_url( $details_link ); ?>" class="thickbox plugin-icon plugin-icon-custom">
														<img class="custom_icon" src="<?php echo esc_attr( $plugin_icon_url ) ?>" />
													</a>
													<div class="name column-name">
														<h4>
															<a href="<?php echo esc_url( $details_link ); ?>" class="thickbox"><?php echo $title; ?></a>
														</h4>
													</div>
													<div class="desc column-description">
														<p>
															<?php echo $description; ?>
														</p>
														<p class="authors">
															<cite>
																By <?php echo $author;?>
															</cite>
														</p>
													</div>
												</div>
												<div class="action-links">
													<ul class="plugin-action-buttons-custom">
														<li>
															<?php
																if ($action_links)
																{
																	echo implode("</li><li>", $action_links);
																}
																	
																
															?>
														</li>
													</ul>
												</div>
											</div>
											<div class="plugin-card-bottom plugin-card-bottom_settings">
												<div class="vers column-rating">
													<?php wp_star_rating( array( "rating" => $plugin["rating"], "type" => "percent", "number" => $plugin["num_ratings"] ) ); ?>
													<span class="num-ratings">
														(<?php echo number_format_i18n( $plugin["num_ratings"] ); ?>)
													</span>
												</div>
												<div class="column-updated">
													<strong><?php _e("Last Updated:"); ?></strong> <span title="<?php echo esc_attr($plugin["last_updated"]); ?>">
														<?php printf("%s ago", human_time_diff(strtotime($plugin["last_updated"]))); ?>
													</span>
												</div>
												<div class="column-downloaded">
													<?php echo sprintf( _n("%s download", "%s downloads", $plugin["downloaded"]), number_format_i18n($plugin["downloaded"])); ?>
												</div>
												<div class="column-compatibility">
													<?php
													if ( !empty($plugin["tested"]) && version_compare(substr($GLOBALS["wp_version"], 0, strlen($plugin["tested"])), $plugin["tested"], ">"))
													{
														echo '<span class="compatibility-untested">' . __( "<strong>Untested</strong> with your version of WordPress" ) . '</span>';
													} 
													elseif (!empty($plugin["requires"]) && version_compare(substr($GLOBALS["wp_version"], 0, strlen($plugin["requires"])), $plugin["requires"], "<")) 
													{
														echo '<span class="compatibility-incompatible">' . __("Incompatible with your version of WordPress") . '</span>';
													} 
													else
													{
														echo '<span class="compatibility-compatible">' . __("Compatible with your version of WordPress") . '</span>';
													}
													?>
												</div>
											</div>
										</div>
									<?php
									}
									?>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php }
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
    $lcneedle = strtolower($needle.'');
    $lchaystack = strtolower($haystack.'');
    $startindex = (strlen($lchaystack) - strlen($lcneedle));
    if($startindex<0 || $startindex>=  strlen($lchaystack)){

        return false;
    }
            
    return $lcneedle === "" || strpos($lchaystack, $lcneedle, $startindex) !== FALSE;
}
}

if(!function_exists('\VanillaBeans\vbean_startsWith')) {
    function vbean_startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        $lcneedle = strtolower($needle).'';
        $lchaystack = strtolower($haystack).'';
    return $lcneedle === "" || strrpos($lchaystack, $lcneedle, 0) !== FALSE;
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

if(!function_exists('\VanillaBeans\vbean_urlexists')){

        
    function vbean_urlexists($url)
    {
        //$url=  str_replace('https', 'http', $url);
        $file = $url;
        if(empty($file)){
            return FALSE;
        }
        try{
            $file_headers = @get_headers($file);
        } catch (Exception $ex) {
            return FALSE;
        }

        
        if($file_headers[0] == 'HTTP/1.1 200 OK') {
            return TRUE;
        }
        else {
            return FALSE;
        }

    }        
    
    
}