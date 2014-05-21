<?php defined('SYSPATH') or die('No direct script access.');?>

	
<?=Form::errors()?>
<div class="page-header">
	<h1><?=__('Product Configuration')?></h1>
    <p class=""><?=__('List of optional fields. To activate/deactivate select "TRUE/FALSE" in desired field.')?></p>

</div>


<div class="well">
	<?= FORM::open(Route::url('oc-panel',array('controller'=>'settings', 'action'=>'product')), array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data'))?>
		<fieldset>
			<?foreach ($config as $c):?>
			<?$forms[$c->config_key] = array('key'=>$c->config_key, 'value'=>$c->config_value)?>
			<?endforeach?>
            
            <div class="form-group">
                <?= FORM::label($forms['location']['key'], __("Locations"), array('class'=>'col-md-3 control-label', 'for'=>$forms['location']['key']))?>
                <div class="col-md-5">
                    <?= FORM::select($forms['location']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['location']['value'], array(
                    'placeholder' => "TRUE or FALSE", 
                    'class' => 'tips form-control', 
                    'id' => $forms['location']['key'], 
                    'data-content'=> __("Displays location select"),
                    'data-trigger'=>"hover",
                    'data-placement'=>"right",
                    'data-toggle'=>"popover",
                    'data-original-title'=>__("Displays the Select Location in the Ad form."),
                    ))?> 
                </div>
            </div>
            
            <div class="form-group">
                <?= FORM::label($forms['products_in_home']['key'], __('Products in home'), array('class'=>'col-md-3 control-label', 'for'=>$forms['products_in_home']['key']))?>
                <div class="col-md-5">
                    <?= FORM::select($forms['products_in_home']['key'], array(0=>__('Latest'),1=>__('Featured'),2=>__('Popular last month'),3=>__('Best rated'),4=>__('None')), $forms['products_in_home']['value'], array(
                    'placeholder' => $forms['products_in_home']['value'], 
                    'class' => 'tips form-control', 
                    'id' => $forms['products_in_home']['key'],
                    'data-content'=> __("You can choose what products you want to display in home."),
                    'data-trigger'=>"hover",
                    'data-placement'=>"right",
                    'data-toggle'=>"popover",
                    'data-original-title'=>__("Products in home"), 
                    ))?> 
                </div>
            </div>

			<div class="form-group">
				<?= FORM::label($forms['num_images']['key'], __('Number of images'), array('class'=>'col-md-3 control-label', 'for'=>$forms['num_images']['key']))?>
				<div class="col-md-5">
					<?= FORM::input($forms['num_images']['key'], $forms['num_images']['value'], array(
					'placeholder' => "4", 
					'class' => 'tips form-control', 
					'id' => $forms['num_images']['key'], 
					'data-content'=> __("Number of images"),
					'data-trigger'=>"hover",
					'data-placement'=>"right",
					'data-toggle'=>"popover",
					'data-original-title'=>__("Number of images displayed"),
					))?> 
				</div>
			</div>

            <div class="form-group">
                <?= FORM::label($forms['related']['key'], __('Related products'), array('class'=>'col-md-3 control-label', 'for'=>$forms['related']['key']))?>
                <div class="col-sm-5">
                    <?= FORM::input($forms['related']['key'], $forms['related']['value'], array(
                    'placeholder' => $forms['related']['value'], 
                    'class' => 'tips form-control ', 
                    'id' => $forms['related']['key'],
                    'data-content'=> __("You can choose if theres random related products displayed at the product page"),
                    'data-trigger'=>"hover",
                    'data-placement'=>"right",
                    'data-toggle'=>"popover",
                    'data-original-title'=>__("Related products"), 
                    ))?> 
                </div>
            </div>

			<div class="form-group">
				<?= FORM::label($forms['max_size']['key'], __('Size of the file'), array('class'=>'col-md-3 control-label', 'for'=>$forms['max_size']['key']))?>
				<div class="col-md-5">
					<?= FORM::input($forms['max_size']['key'], $forms['max_size']['value'], array(
					'placeholder' => "4", 
					'class' => 'tips form-control', 
					'id' => $forms['max_size']['key'], 
					'data-content'=> __("Size of the file"),
					'data-trigger'=>"hover",
					'data-placement'=>"right",
					'data-toggle'=>"popover",
					'data-original-title'=>__("Size of the product file, limit on upload in MB"),
					))?> 
				</div>
			</div>

			<div class="form-group">
				<?= FORM::label($forms['formats']['key'], __('Allowed product formats'), array('class'=>'col-md-3 control-label', 'for'=>$forms['formats']['key']))?>
				<div class="col-md-5">
					<?= FORM::select("formats[]", array("txt" => "txt", "doc" => "doc", "docx" => "docx", "pdf" => "pdf", 
														"tif" => "tif", "tiff" => "tiff", "gif" => "gif", "psd" => "psd", 
														"raw" => "raw", "wav" => "wav", "aif" => "aif", "mp3" => "mp3", "rm" => "rm ", 
														"ram" => "ram", "wma" => "wma", "ogg" => "ogg", "avi" => "avi", "wmv" => "wmv", 
														"mov" => "mov", "mp4" => "mp4", "mkv" => "mkv", "jpeg" => "jpeg", "jpg" => "jpg", "png" => "png", 
														"zip" => "zip", "7z" => "7z ", "7zip" => "7zip", "rar" => "rar", "rar5" => "rar5", 
														"gzip" => "gzip" ), 
					explode(',', $forms['formats']['value']), array(
					'placeholder' => $forms['formats']['value'],
					'multiple' => 'true',
					'class' => 'tips form-control', 
					'id' => $forms['formats']['key'],
					'data-content'=> __("Set this up to restrict product formats that are being uploaded to your server."),
					'data-trigger'=>"hover",
					'data-placement'=>"right",
					'data-toggle'=>"popover",
					'data-original-title'=>__("Allowed product formats"), 
					))?> 
				</div>
			</div>
            <div class="form-group">
                <?= FORM::label($forms['disqus']['key'], __('Disqus'), array('class'=>'col-md-3 control-label', 'for'=>$forms['disqus']['key']))?>
                <div class="col-md-5">
                    <?= FORM::input($forms['disqus']['key'], $forms['disqus']['value'], array(
                    'placeholder' => "", 
                    'class' => 'tips form-control', 
                    'id' => $forms['disqus']['key'], 
                    'data-content'=> __("Disqus Comments"),
                    'data-trigger'=>"hover",
                    'data-placement'=>"right",
                    'data-toggle'=>"popover",
                    'data-original-title'=>__("You need to write your disqus ID to enable the service."),
                    ))?> 
                </div>
            </div>
            <div class="form-group">
                <?= FORM::label($forms['reviews']['key'], __("Product Reviews"), array('class'=>'col-md-3 control-label', 'for'=>$forms['reviews']['key']))?>
                <div class="col-md-5">
                    <?= FORM::select($forms['reviews']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['reviews']['value'], array(
                    'placeholder' => "TRUE or FALSE", 
                    'class' => 'tips form-control', 
                    'id' => $forms['reviews']['key'], 
                    'data-content'=> __("Enables users to review purchased products"),
                    'data-trigger'=>"hover",
                    'data-placement'=>"right",
                    'data-toggle'=>"popover",
                    'data-original-title'=>__("Product Reviews"),
                    ))?> 
                </div>
            </div>

            <div class="form-group">
                <?= FORM::label($forms['demo_theme']['key'], __('Demo Bar Theme'), array('class'=>'col-md-3 control-label', 'for'=>$forms['demo_theme']['key']))?>
                <div class="col-md-5">
                    <?= FORM::select($forms['demo_theme']['key'], array( 'amelia'    => 'Amelia',
                                                            'cerulean'  => 'Cerulean',
                                                            'cosmo'     => 'Cosmo',
                                                            'cyborg'    => 'Cyborg',
                                                            'journal'   => 'Journal',
                                                            'flatly'    => 'Flatly',
                                                            'readable'  => 'Readable',
                                                            'simplex'   => 'Simplex',
                                                            'slate'     => 'Slate',
                                                            'spacelab'  => 'Space Lab',
                                                            'united'    => 'United',
                                                            'yeti'      => 'Yeti',
                                                                ),  $forms['demo_theme']['value'], array(
                    'placeholder' => $forms['demo_theme']['value'], 
                    'class' => 'tips form-control', 
                    'id' => $forms['demo_theme']['key'],
                    'data-content'=> __("You can choose what theme to use in the demo bar."),
                    'data-trigger'=>"hover",
                    'data-placement'=>"right",
                    'data-toggle'=>"popover",
                    'data-original-title'=>__("Demo Bar Theme"), 
                    ))?> 
                </div>
            </div>
            <div class="form-group">
                <?= FORM::label($forms['demo_resize']['key'], __("Demo resize buttons"), array('class'=>'col-md-3 control-label', 'for'=>$forms['demo_resize']['key']))?>
                <div class="col-md-5">
                    <?= FORM::select($forms['demo_resize']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['demo_resize']['value'], array(
                    'placeholder' => "TRUE or FALSE", 
                    'class' => 'tips form-control', 
                    'id' => $forms['demo_resize']['key'], 
                    'data-content'=> __("Enables buttons to resize the demo"),
                    'data-trigger'=>"hover",
                    'data-placement'=>"right",
                    'data-toggle'=>"popover",
                    'data-original-title'=>__("Demo resize"),
                    ))?> 
                </div>
            </div>
            
            <div class="form-group">
                <?= FORM::label($forms['qr_code']['key'], __("Show QR code"), array('class'=>'col-md-3 control-label', 'for'=>$forms['qr_code']['key']))?>
                <div class="col-md-5">
                    <?= FORM::select($forms['qr_code']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['qr_code']['value'], array(
                    'placeholder' => "TRUE or FALSE", 
                    'class' => 'tips form-control', 
                    'id' => $forms['qr_code']['key'], 
                    'data-content'=> __("Show QR code in Product"),
                    'data-trigger'=>"hover",
                    'data-placement'=>"right",
                    'data-toggle'=>"popover",
                    'data-original-title'=>__("Show QR code"),
                    ))?> 
                </div>
            </div>
			<div class="page-header"></div>
				<?= FORM::button('submit', 'Update', array('type'=>'submit', 'class'=>'btn btn-primary col-md-offset-3', 'action'=>Route::url('oc-panel',array('controller'=>'settings', 'action'=>'product'))))?>
	
		</fieldset>
	<?= FORM::close()?>
</div><!--end well-->
