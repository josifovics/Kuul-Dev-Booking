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
	<meta name="author" content="open-eshop.com">
	<meta name="viewport" content="width=device-width,initial-scale=1">

    <?if (isset($product)):?>
    <link rel="canonical" href="<?=Route::url('product', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>"/>
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

    <body>

    <section class="centered-box" id="page">
        <?=Alert::show()?>
        <?=$content?>
    </section>

    <?if (!Auth::instance()->logged_in()):?>
    <div id="login-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <a class="close" data-dismiss="modal" >&times;</a>
                  <h3><?=__('Login')?></h3>
                </div>
                
                <div class="modal-body">
                    <?=View::factory('pages/auth/login-form')?>
                </div>
            </div>
        </div>
    </div>
    
    <div id="forgot-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <a class="close" data-dismiss="modal" >&times;</a>
                  <h3><?=__('Forgot password')?></h3>
                </div>
                
                <div class="modal-body">
                    <?=View::factory('pages/auth/forgot-form')?>
                </div>
            </div>
        </div>
    </div>
    
     <div id="register-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <a class="close" data-dismiss="modal" >&times;</a>
                  <h3><?=__('Register')?></h3>
                </div>
                
                <div class="modal-body">
                    <?=View::factory('pages/auth/register-form')?>
                </div>
            </div>
        </div>
    </div>
    <?endif?>


	<?=Theme::scripts($scripts,'footer')?>
	
    
	<!--[if lt IE 7 ]>
		<?=HTML::script('http://ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js')?>
		<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
	<![endif]-->
  <?//=(Kohana::$environment === Kohana::DEVELOPMENT)? View::factory('profiler'):''?>
  </body>
</html>