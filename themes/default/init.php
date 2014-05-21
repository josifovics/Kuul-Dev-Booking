<?php defined('SYSPATH') or die('No direct access allowed.');
/**
  * Theme Name: Kamaleon
  * Description: Our latest great theme with 14 different styles/color schemes included and multiple options of configuration. 
  * Tags: HTML5, Responsive, Mobile, Premium, Admin Themes, Advanced Confiuration, prettyPhoto, Slider.
  * Version: 1.5
  * Author: Chema <chema@open-classifieds.com>, Slobodan <slobodan@open-classifieds.com>
  * License: Commercial
  */


/**
 * placeholders & widgets for this theme
 */
Widgets::$theme_placeholders    = array('header','sidebar','footer');

/**
 * custom options for the theme
 * @var array
 */
Theme::$options = Theme::get_options();

//we load earlier the theme since we need some info
Theme::load();

/**
 * styles and themes, loaded in this order
 */
Theme::$skin = Theme::get('theme');

//if we allow the user to select the theme/skin, perfect for the demo

if (Core::config('appearance.allow_query_theme')=='1')
{
    if (Core::get('skin')!==NULL)
    {
        Theme::$skin = Core::get('skin');
    }
    elseif (Cookie::get('skin_kamaleon')!=='')
    {
        Theme::$skin = Cookie::get('skin_kamaleon');
    }

    //checking the skin they want to use actually exists...
    if (!in_array(Theme::$skin, array_keys(Theme::$options['theme']['options'])))
        Theme::$skin = Theme::get('theme');

    //we save the cookie for next time
    Cookie::set('skin_kamaleon', Theme::$skin, Core::config('auth.lifetime'));
}   


//local files

if (Theme::get('cdn_files') == FALSE)
{
    if (Theme::$skin!='bootstrap' AND Theme::$skin!='')
    {
        $theme_css = array( 'css/'.Theme::$skin.'-bootstrap.min.css' => 'screen',
                            
                            );
    }
    //default theme
    else
    {
        $theme_css = array('css/bootstrap.min.css' => 'screen',);
    }
    if(Theme::get('rtl'))
            $theme_css = array_merge($theme_css, array('css/bootstrap-rtl.min.css' => 'screen'));

    $common_css =  array('css/style.css?v=1.5' => 'screen',
                        'css/templates/'.Theme::$skin.'-style.css' => 'screen',
                        'css/prettyPhoto.css' => 'screen',
                        'css/chosen.min.css' => 'screen',
                        'css/slider.css' => 'screen',
                        'css/zocial.css' => 'screen'
                        );

    Theme::$styles = array_merge($theme_css,$common_css);


    Theme::$scripts['footer']   = array('js/jquery-1.10.2.js',
                                        'js/bootstrap.min.js',
                                        'js/bootstrap-slider.js',
                                        'js/jquery.validate.min.js',
                                        'js/jquery.prettyPhoto.js',
                                        'js/chosen.jquery.min.js',
                                        'js/theme.init.js?v=1.5',
                                        );
}
else
{
    if (Theme::$skin!='bootstrap' AND Theme::$skin!='')
    {
        $theme_css = array( 'http://netdna.bootstrapcdn.com/bootswatch/3.1.1/'.Theme::$skin.'/bootstrap.min.css' => 'screen',
                            );
    }
    //default theme
    else
    {
        $theme_css = array('http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css' => 'screen', );
    }
    if(Theme::get('rtl'))
            $theme_css = array_merge($theme_css, array('css/bootstrap-rtl.min.css' => 'screen'));
                                   
    $common_css =  array(
                        'http://cdn.jsdelivr.net/chosen/1.0.0/chosen.css' => 'screen',
                        'http://cdn.jsdelivr.net/prettyphoto/3.1.5/css/prettyPhoto.css' => 'screen',
                        'css/style.css?v=1.5' => 'screen',
                        'css/templates/'.Theme::$skin.'-style.css' => 'screen',
                        'css/slider.css' => 'screen',
                        'css/zocial.css' => 'screen'
                        );

    Theme::$styles = array_merge($theme_css,$common_css);


    Theme::$scripts['footer']   = array('http://code.jquery.com/jquery-1.10.2.min.js',
                                        'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js',
                                        'http://cdn.jsdelivr.net/prettyphoto/3.1.5/js/jquery.prettyPhoto.js',
                                        'http://cdn.jsdelivr.net/chosen/1.0.0/chosen.jquery.min.js',
                                        'js/bootstrap-slider.js',
                                        'js/jquery.validate.min.js',
                                        'js/theme.init.js?v=1.5',
                                        );
}
