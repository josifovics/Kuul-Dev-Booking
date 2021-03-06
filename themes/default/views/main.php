<?php defined('SYSPATH') or die('No direct script access.');?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="<?=i18n::html_lang()?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?=i18n::html_lang()?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?=i18n::html_lang()?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?=i18n::html_lang()?>"> <!--<![endif]-->
<head>
	<meta charset="<?=Kohana::$charset?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?=$title?></title>
    <meta name="keywords" content="<?=$meta_keywords?>" >
    <meta name="description" content="<?=$meta_description?>" >
    <meta name="copyright" content="<?=$meta_copyright?>" >
	

    <?if (Controller::$image!==NULL):?>
    <meta property="og:image"   content="<?=core::config('general.base_url').Controller::$image?>"/>
    <?endif?>
    <meta property="og:title"   content="<?=$title?>"/>
    <meta property="og:description"   content="<?=$meta_description?>"/>
    <meta property="og:url"     content="<?=URL::current()?>"/>
    <meta property="og:site_name" content="<?=core::config('general.site_name')?>"/>
	<meta name="viewport" content="width=device-width,initial-scale=1">

    <?if (core::config('general.blog')==1):?>
    <link rel="alternate" type="application/atom+xml" title="RSS Blog <?=Core::config('general.site_name')?>" href="<?=Route::url('rss-blog')?>" />
    <?endif?>
    <link rel="alternate" type="application/atom+xml" title="RSS <?=Core::config('general.site_name')?>" href="<?=Route::url('rss')?>" />
    
    <?if (Model_Category::current()->loaded()):?>
    <link rel="alternate" type="application/atom+xml"  title="RSS <?=Core::config('general.site_name')?> - <?=Model_Category::current()->name?>"  href="<?=Route::url('rss',array('category'=>Model_Category::current()->seoname))?>" />
    <?endif?>     
        
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
    <!--[if lt IE 9]>
      <?=HTML::script('http://html5shim.googlecode.com/svn/trunk/html5.js')?>
    <![endif]-->
    
    <?=Theme::styles($styles)?>	
	<?=Theme::scripts($scripts)?>

    <link rel="shortcut icon" href="<?=core::config('general.base_url').'images/favicon.ico'?>">
    <?if ( core::config('general.analytics')!='' AND Kohana::$environment === Kohana::PRODUCTION ): ?>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', '<?=Core::config('general.analytics')?>']);
      _gaq.push(['_setDomainName', '<?=$_SERVER['SERVER_NAME']?>']);
      _gaq.push(['_setAllowLinker', true]);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script> 
    <?endif?>
    </head>

    <body data-spy="scroll" data-target=".subnav" data-offset="50" class="<?=((Request::current()->controller()!=='faq') AND Theme::get('fixed_toolbar')==1)?'':'body_fixed'?>">
    <?if(!isset($_COOKIE['accept_terms']) AND core::config('general.alert_terms') != ''):?>
        <?=View::factory('alert_terms')?>
    <?endif?>
	<?=$header?>
    
    <div class="container bs-docs-container" id="main">
    <div class="alert alert-warning off-line" style="display:none;"><strong><?=__('Warning')?>!</strong> <?=__('We detected you are currently off-line, please login to gain full experience.')?></div>
        <div class="row">
            
            <?if(Theme::get('sidebar_position')!='none'):?>
                <?=(Theme::get('sidebar_position')=='left')?View::fragment('sidebar_front','sidebar'):''?>
            <?endif?>
            
            <section class="<?=(Theme::get('sidebar_position')!='none')?'col-lg-9 col-md-9 col-sm-12 col-xs-12':'col-lg-12 col-md-12 col-sm-12 col-xs-12'?>" id="page">
                <?=(Theme::get('breadcrumb')==1)?Breadcrumbs::render('breadcrumbs'):''?>
                <?=Alert::show()?>

                <div class="row">
                    <?foreach ( widgets::get('header') as $widget):?>
                    <div class="<?=(Theme::get('sidebar_position')!='none')?'col-lg-9 col-md-9 col-sm-12 col-xs-12':'col-lg-12 col-md-12 col-sm-12 col-xs-12'?>">
                        <?=$widget->render()?>
                    </div>
                    <?endforeach?>
                </div>

                <?=(Theme::get('header_ad')!='')?Theme::get('header_ad'):''?>
                <?=$content?>
            </section>
            
            <?if(Theme::get('sidebar_position')!='none'):?>
            <?=(Theme::get('sidebar_position')=='right')?View::fragment('sidebar_front','sidebar'):''?>
            <?endif?>
            
            <div class="container">
                <?foreach ( widgets::get('footer') as $widget):?>
                <div class="col-lg-3">
                    <?=$widget->render()?>
                </div>
                <?endforeach?>
            </div>


            <?=$footer?>
       </div>     
    </div><!--/.fluid-container-->


	<?=Theme::scripts($scripts,'footer')?>
	
    
	
	<!--[if lt IE 7 ]>
		<?=HTML::script('http://ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js')?>
		<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
	<![endif]-->
  <?//=(Kohana::$environment === Kohana::DEVELOPMENT)? View::factory('profiler'):''?>
  </body>
</html>