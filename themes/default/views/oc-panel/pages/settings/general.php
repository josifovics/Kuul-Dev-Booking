<?php defined('SYSPATH') or die('No direct script access.');?>


 <?=Form::errors()?>
<div class="page-header">
	<h1><?=__('General Configuration')?></h1>
    <p class="">
        <?=__('General site settings.')?>
        <a class="btn btn-default pull-right" href="<?=Route::url('oc-panel',array('controller'=>'config'))?>"><?=__('All configurations')?></a>

    </p>
</div>

<div class="well">
<?= FORM::open(Route::url('oc-panel',array('controller'=>'settings', 'action'=>'general')), array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data'))?>
	<fieldset>
		
		
        <div class="form-group">
            <?= FORM::label($forms['maintenance']['key'], "<a target='_blank' href='http://open-classifieds.com/2013/10/11/activate-access-terms-alert/'>".__("Maintenance Mode")."</a>", array('class'=>'col-md-3 control-label', 'for'=>$forms['maintenance']['key']))?>
            <div class="col-md-5">
                <?= FORM::select($forms['maintenance']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['maintenance']['value'], array(
                'placeholder' => "TRUE or FALSE", 
                'class' => 'tips form-control', 
                'id' => $forms['maintenance']['key'], 
                'data-content'=> __("Enables the site to maintenance"),
                'data-trigger'=>"hover",
                'data-placement'=>"right",
                'data-toggle'=>"popover",
                'data-original-title'=>__("Maintenance Mode"),
                ))?> 
            </div>
        </div>

        <div class="form-group">
            <?= FORM::label($forms['landing_page']['key'], __('Landing page'), array('class'=>'col-md-3 control-label', 'for'=>$forms['landing_page']['key']))?>
            <div class="col-md-5">
                <?= FORM::select($forms['landing_page']['key'], $pages, $forms['landing_page']['value'], array( 
                'class' => 'tips form-control', 
                'id' => $forms['landing_page']['key'], 
                'data-content'=> __("If you choose to use alert terms, you can select page you want to render. And to edit content, select link 'Content' on your admin panel sidebar. Find page named <name_you_specified> click 'Edit'. In section 'Description' add content that suits you."),
                'data-trigger'=>"hover",
                'data-placement'=>"right",
                'data-toggle'=>"popover",
                'data-original-title'=>__("Accept Terms Alert"),
                ))?> 
            </div>
        </div>

        <div class="form-group">
            <?= FORM::label($forms['site_name']['key'], __('Site name'), array('class'=>'col-md-3 control-label', 'for'=>$forms['site_name']['key']))?>
            <div class="col-md-5">
                <?= FORM::input($forms['site_name']['key'], $forms['site_name']['value'], array(
                'placeholder' => 'Open-classifieds', 
                'class' => 'tips form-control', 
                'id' => $forms['site_name']['key'],
                'data-content'=> __("Here you can declare your display name. This is seen by everyone!"),
                'data-trigger'=>"hover",
                'data-placement'=>"right",
                'data-toggle'=>"popover",
                'data-original-title'=>__("Site Name"), 
                ))?> 
            </div>
        </div>

        <div class="form-group">
            <?= FORM::label($forms['site_description']['key'], __('Site description'), array('class'=>'col-md-3 control-label', 'for'=>$forms['site_description']['key']))?>
            <div class="col-md-5">
                <?= FORM::input($forms['site_description']['key'], $forms['site_description']['value'], array(
                'placeholder' => '', 
                'class' => 'tips form-control', 
                'id' => $forms['site_description']['key'],
                ))?> 
            </div>
        </div>

		<div class="form-group">
			<?= FORM::label($forms['base_url']['key'], __('Base URL'), array('class'=>'col-md-3 control-label', 'for'=>$forms['base_url']['key']))?>
			<div class="col-md-5">
				<?= FORM::input($forms['base_url']['key'], $forms['base_url']['value'], array(
				'placeholder' => "http://foo.com/", 
				'class' => 'tips form-control', 
				'id' => $forms['base_url']['key'],
				'data-content'=> __("Is a base path of your site (e.g. http://open-classifieds.com/). Everything else is built based on this field."),
				'data-trigger'=>"hover",
				'data-placement'=>"right",
				'data-toggle'=>"popover",
				'data-original-title'=>__("Base URL path"), 
				))?> 
			</div>
		</div>
		
		<div class="form-group">
			<?= FORM::label($forms['products_per_page']['key'], __('Products per page'), array('class'=>'col-md-3 control-label', 'for'=>$forms['products_per_page']['key']))?>
			<div class="col-md-5">
				<?= FORM::input($forms['products_per_page']['key'], $forms['products_per_page']['value'], array(
				'placeholder' => "20", 
				'class' => 'tips form-control', 
				'id' => $forms['products_per_page']['key'], 
				'data-content'=> __("This is to control how many products are being displayed per page. Insert an integer value, as a number limit."),
				'data-trigger'=>"hover",
				'data-placement'=>"right",
				'data-toggle'=>"popover",
				'data-original-title'=>__("Number of ads per page"),
				))?> 
			</div>
		</div>
		<div class="form-group">		
                <?= FORM::label($forms['number_format']['key'], "<a target='_blank' href='http://open-classifieds.com/2013/08/06/how-to-currency-format/'>".__('Money format')."</a>", array('class'=>'col-md-3 control-label','for'=>$forms['number_format']['key']))?>
			<div class="col-md-5">
				<?= FORM::input($forms['number_format']['key'], $forms['number_format']['value'], array(
				'placeholder' => "20", 
				'class' => 'tips form-control', 
				'id' => $forms['number_format']['key'],
				'data-content'=> __("Number format is how you want to display numbers related to advertisements. More specific advertisement price. Every country have a specific way of dealing with decimal digits."),
				'data-trigger'=>"hover",
				'data-placement'=>"right",
				'data-toggle'=>"popover",
				'data-original-title'=>__("Decimal representation"), 
				))?> 
			</div>
		</div>
		<div class="form-group">
           <?= FORM::label($forms['feed_elements']['key'], __('Products in RSS'), array('class'=>'col-md-3 control-label', 'for'=>$forms['feed_elements']['key']))?>
           <div class="col-md-5">
               <?= FORM::input($forms['feed_elements']['key'], $forms['feed_elements']['value'], array(
               'placeholder' => "20", 
               'class' => 'tips form-control', 
               'id' => $forms['feed_elements']['key'], 
               'data-content'=> __("Number of Ads"),
               'data-trigger'=>"hover",
               'data-placement'=>"right",
               'data-toggle'=>"popover",
               'data-original-title'=>__("How many products are going to appear in the RSS of your site."),
               ))?> 
           </div>
       	</div>
		<div class="form-group">
			<?= FORM::label($forms['date_format']['key'], __('Date format'), array('class'=>'col-md-3 control-label', 'for'=>$forms['date_format']['key']))?>
			<div class="col-md-5">
				<?= FORM::input($forms['date_format']['key'], $forms['date_format']['value'], array(
				'placeholder' => "d/m/Y", 
				'class' => 'tips form-control', 
				'id' => $forms['date_format']['key'], 
				'data-content'=> __("Each product have a publish date. By selecting format, you can change how it is shown on your website."),
				'data-trigger'=>"hover",
				'data-placement'=>"right",
				'data-toggle'=>"popover",
				'data-original-title'=>__("Date format"),
				))?> 
			</div>
		</div>
		<div class="form-group">
			<?= FORM::label($forms['analytics']['key'], __('Analytics'), array('class'=>'col-md-3 control-label', 'for'=>$forms['analytics']['key']))?>
			<div class="col-md-5">
				<?= FORM::input($forms['analytics']['key'], $forms['analytics']['value'], array(
				'placeholder' => 'UA-XXXXX', 
				'class' => 'tips form-control', 
				'id' => $forms['analytics']['key'],
				'data-content'=> __(""),
				'data-trigger'=>"hover",
				'data-placement'=>"right",
				'data-toggle'=>"popover",
				'data-original-title'=>__("Analytics"), 
				))?> 
			</div>
		</div>
		<div class="form-group">
			<?= FORM::label($forms_img['allowed_formats']['key'], __('Allowed image formats'), array('class'=>'col-md-3 control-label', 'for'=>$forms_img['allowed_formats']['key']))?>
			<div class="col-md-5">
				<?= FORM::select("allowed_formats[]", array('jpeg'=>'jpeg','jpg'=>'jpg','png'=>'png','raw'=>'raw','gif'=>'gif'), explode(',', $forms_img['allowed_formats']['value']), array(
				'placeholder' => $forms_img['allowed_formats']['value'],
				'multiple' => 'true',
				'class' => 'tips form-control', 
				'id' => $forms_img['allowed_formats']['key'],
				'data-content'=> __("Set this up to restrict image formats that are being uploaded to your server."),
				'data-trigger'=>"hover",
				'data-placement'=>"right",
				'data-toggle'=>"popover",
				'data-original-title'=>__("Allowed image formats"), 
				))?> 
			</div>
		</div>
		<div class="form-group">
			<?= FORM::label($forms_img['max_image_size']['key'], __('Max image size'), array('class'=>'col-md-3 control-label', 'for'=>$forms_img['max_image_size']['key']))?>
			<div class="col-md-5">
				<div class="input-group">
					<?= FORM::input($forms_img['max_image_size']['key'], $forms_img['max_image_size']['value'], array(
					'placeholder' => "5", 
					'class' => 'tips form-control', 
					'id' => $forms_img['max_image_size']['key'],
					'data-content'=> __("Control the size of images being uploaded. Enter an integer value to set maximum image size in mega bites(Mb)."),
					'data-trigger'=>"hover",
					'data-placement'=>"right",
					'data-toggle'=>"popover",
					'data-original-title'=>__("Image size in mega bites(Mb)"), 
					))?>
					<span class="input-group-addon">MB</span>
				</div> 
			</div>
		</div>
		<div class="form-group">
			<?= FORM::label($forms_img['height']['key'], __('Image height'), array('class'=>'col-md-3 control-label', 'for'=>$forms_img['height']['key']))?>
			<div class="col-md-5">
				<div class="input-group">
					<?= FORM::input($forms_img['height']['key'], $forms_img['height']['value'], array(
					'placeholder' => "700", 
					'class' => 'tips form-control', 
					'id' => $forms_img['height']['key'], 
					'data-content'=> __("Each image is resized when uploaded. This is the height of big image. Note: you can leave this field blank to set AUTO height resize."),
					'data-trigger'=>"hover",
					'data-placement'=>"right",
					'data-toggle'=>"popover",
					'data-original-title'=>__("Image height in pixels(px)"),
					))?>
					<span class="input-group-addon">px</span>
				</div> 
			</div>
		</div>
		<div class="form-group">
			<?= FORM::label($forms_img['width']['key'], __('Image width'), array('class'=>'col-md-3 control-label', 'for'=>$forms_img['width']['key']))?>
			<div class="col-md-5">
				<div class="input-group">
					<?= FORM::input($forms_img['width']['key'], $forms_img['width']['value'], array(
					'placeholder' => "1024", 
					'class' => 'tips form-control', 
					'id' => $forms_img['width']['key'],
					'data-content'=> __("Each image is resized when uploaded. This is the width of big image."),
					'data-trigger'=>"hover",
					'data-placement'=>"right",
					'data-toggle'=>"popover",
					'data-original-title'=>__("Image width in pixels(px)"), 
					))?>
					<span class="input-group-addon">px</span>
				</div> 
			</div>
		</div>
		<div class="form-group">
			<?= FORM::label($forms_img['height_thumb']['key'], __('Thumb height'), array('class'=>'col-md-3 control-label', 'for'=>$forms_img['height_thumb']['key']))?>
			<div class="col-md-5">
				<div class="input-group">
					<?= FORM::input($forms_img['height_thumb']['key'], $forms_img['height_thumb']['value'], array(
					'placeholder' => "200", 
					'class' => 'tips form-control', 
					'id' => $forms_img['height_thumb']['key'],
					'data-content'=> __("Thumb is a small image resized to fit certain elements. This is height of this image."),
					'data-trigger'=>"hover",
					'data-placement'=>"right",
					'data-toggle'=>"popover",
					'data-original-title'=>__("Thumb height in pixels(px)"), 
					))?>
					<span class="input-group-addon">px</span>
				</div> 
			</div>
		</div>
		<div class="form-group">
			<?= FORM::label($forms_img['width_thumb']['key'], __('Thumb width'), array('class'=>'col-md-3 control-label', 'for'=>$forms_img['width_thumb']['key']))?>
			<div class="col-md-5">
				<div class="input-group">
					<?= FORM::input($forms_img['width_thumb']['key'], $forms_img['width_thumb']['value'], array(
					'placeholder' => "200", 
					'class' => 'tips form-control', 
					'id' => $forms_img['width_thumb']['key'],
					'data-content'=> __("Thumb is a small image resized to fit certain elements. This is width of this image."),
					'data-trigger'=>"hover",
					'data-placement'=>"right",
					'data-toggle'=>"popover",
					'data-original-title'=>__("Thumb width in pixels(px)"),

					))?>
					<span class="input-group-addon">px</span>
				</div> 
			</div>
		</div>
        <div class="form-group">
            <?= FORM::label($forms_img['quality']['key'], __('Image quality'), array('class'=>'col-md-3 control-label', 'for'=>$forms_img['quality']['key']))?>
            <div class="col-md-5">
                <div class="input-group">
                    <?= FORM::input($forms_img['quality']['key'], $forms_img['quality']['value'], array(
                    'placeholder' => "95", 
                    'class' => 'tips form-control', 
                    'id' => $forms_img['quality']['key'],
                    'data-content'=> __("Choose the quality of the stored images (1-100% of the original)."),
                    'data-trigger'=>"hover",
                    'data-placement'=>"right",
                    'data-toggle'=>"popover",
                    'data-original-title'=>__("Image Quality"),

                    ))?>
                    <span class="input-group-addon">%</span>
                </div> 
            </div>
        </div>
        
        <div class="form-group">
            <?= FORM::label($forms_img['watermark']['key'], __('Watermark'), array('class'=>'col-md-3 control-label', 'for'=>$forms_img['watermark']['key']))?>
            <div class="col-md-5">
                <?= FORM::select($forms_img['watermark']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms_img['watermark']['value'], array(
                'placeholder' => "TRUE or FALSE", 
                'class' => 'tips form-control', 
                'id' => $forms_img['watermark']['key'], 
                'data-content'=> __("Appends watermark to images"),
                'data-trigger'=>"hover",
                'data-placement'=>"right",
                'data-toggle'=>"popover",
                'data-original-title'=>__("Watermark"),
                ))?> 
            </div>
        </div>
        
        <div class="form-group">
			<?= FORM::label($forms_img['watermark_path']['key'], __('Watermark path'), array('class'=>'col-md-3 control-label', 'for'=>$forms_img['watermark_path']['key']))?>
			<div class="col-md-5">
				<?= FORM::input($forms_img['watermark_path']['key'], $forms_img['watermark_path']['value'], array(
				'placeholder' => "images/watermark.png", 
				'class' => 'tips form-control', 
				'id' => $forms_img['watermark_path']['key'],
				'data-content'=> __(""),
				'data-trigger'=>"hover",
				'data-placement'=>"right",
				'data-toggle'=>"popover",
				'data-original-title'=>__("Watermark path"), 
				))?> 
			</div>
		</div>
		<div class="form-group">
			<?= FORM::label($forms_img['watermark_position']['key'], __('Watermark position'), array('class'=>'col-md-3 control-label', 'for'=>$forms_img['watermark_position']['key']))?>
			<div class="col-md-5">
				<?= FORM::select($forms_img['watermark_position']['key'], array(0=>"Center",1=>"Bottom",2=>"Top"), $forms_img['watermark_position']['value'], array(
				'placeholder' => $forms_img['watermark_position']['value'], 
				'class' => 'tips form-control', 
				'id' => $forms_img['watermark_position']['key'],
				'data-content'=> __(""),
				'data-trigger'=>"hover",
				'data-placement'=>"right",
				'data-toggle'=>"popover",
				'data-original-title'=>__("Watermark possition"), 
				))?> 
			</div>
		</div>

		<div class="form-group">
			<?= FORM::label($forms['alert_terms']['key'], "<a target='_blank' href='http://open-classifieds.com/2013/10/11/activate-access-terms-alert/'>".__('Accept Terms Alert')."</a>", array('class'=>'col-md-3 control-label', 'for'=>$forms['alert_terms']['key']))?>
			<div class="col-md-5">
				<?= FORM::select($forms['alert_terms']['key'], $pages, $forms['alert_terms']['value'], array( 
				'class' => 'tips form-control', 
				'id' => $forms['alert_terms']['key'], 
				'data-content'=> __("If you choose to use alert terms, you can select page you want to render. And to edit content, select link 'Content' on your admin panel sidebar. Find page named <name_you_specified> click 'Edit'. In section 'Description' add content that suits you."),
				'data-trigger'=>"hover",
				'data-placement'=>"right",
				'data-toggle'=>"popover",
				'data-original-title'=>__("Accept Terms Alert"),
				))?> 
			</div>
		</div>

        <div class="form-group">
            <?= FORM::label($forms['blog']['key'], __("Activates Blog posting"), array('class'=>'col-md-3 control-label', 'for'=>$forms['blog']['key']))?>
            <div class="col-md-5">
                <?= FORM::select($forms['blog']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['blog']['value'], array(
                'placeholder' => "TRUE or FALSE", 
                'class' => 'tips form-control', 
                'id' => $forms['blog']['key'], 
                'data-content'=> __("Once set to TRUE, enables blog posts"),
                'data-trigger'=>"hover",
                'data-placement'=>"right",
                'data-toggle'=>"popover",
                'data-original-title'=>__("Activates Blog posting"),
                ))?> 
            </div>
        </div>
        <div class="form-group">
                <?= FORM::label($forms['blog_disqus']['key'], __('Disqus for blog'), array('class'=>'col-md-3 control-label', 'for'=>$forms['blog_disqus']['key']))?>
                <div class="col-md-5">
                    <?= FORM::input($forms['blog_disqus']['key'], $forms['blog_disqus']['value'], array(
                    'placeholder' => "", 
                    'class' => 'tips form-control', 
                    'id' => $forms['blog_disqus']['key'], 
                    'data-content'=> __("Disqus for Blog Comments"),
                    'data-trigger'=>"hover",
                    'data-placement'=>"right",
                    'data-toggle'=>"popover",
                    'data-original-title'=>__("You need to write your disqus ID to enable the service."),
                    ))?> 
                </div>
            </div>
        <div class="form-group">
            <?= FORM::label($forms['faq']['key'], __("Activates FAQ"), array('class'=>'col-md-3 control-label', 'for'=>$forms['faq']['key']))?>
            <div class="col-md-5">
                <?= FORM::select($forms['faq']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['faq']['value'], array(
                'placeholder' => "TRUE or FALSE", 
                'class' => 'tips form-control', 
                'id' => $forms['faq']['key'], 
                'data-content'=> __("Once set to TRUE, enables FAQ"),
                'data-trigger'=>"hover",
                'data-placement'=>"right",
                'data-toggle'=>"popover",
                'data-original-title'=>__("Activates FAQ"),
                ))?> 
            </div>
        </div>
        <div class="form-group">
                <?= FORM::label($forms['faq_disqus']['key'], __('Disqus for FAQ'), array('class'=>'col-md-3 control-label', 'for'=>$forms['faq_disqus']['key']))?>
                <div class="col-md-5">
                    <?= FORM::input($forms['faq_disqus']['key'], $forms['faq_disqus']['value'], array(
                    'placeholder' => "", 
                    'class' => 'tips form-control', 
                    'id' => $forms['faq_disqus']['key'], 
                    'data-content'=> __("Disqus for FAQ Comments"),
                    'data-trigger'=>"hover",
                    'data-placement'=>"right",
                    'data-toggle'=>"popover",
                    'data-original-title'=>__("You need to write your disqus ID to enable the service."),
                    ))?> 
                </div>
            </div>
        <div class="form-group">
            <?= FORM::label($forms['forums']['key'], __("Activates Forums"), array('class'=>'col-md-3 control-label', 'for'=>$forms['forums']['key']))?>
            <div class="col-md-5">
                <?= FORM::select($forms['forums']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['forums']['value'], array(
                'placeholder' => "TRUE or FALSE", 
                'class' => 'tips form-control', 
                'id' => $forms['forums']['key'], 
                'data-content'=> __("Once set to TRUE, enables forums posts"),
                'data-trigger'=>"hover",
                'data-placement'=>"right",
                'data-toggle'=>"popover",
                'data-original-title'=>__("Activates Forums"),
                ))?> 
            </div>
        </div>

        <div class="form-group">
            <?= FORM::label($forms['minify']['key'], __("Minify CSS/JS"), array('class'=>'col-md-3 control-label', 'for'=>$forms['minify']['key']))?>
            <div class="col-sm-5">
                <?= FORM::select($forms['minify']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['minify']['value'], array(
                'placeholder' => "TRUE or FALSE", 
                'class' => 'tips form-control', 
                'id' => $forms['minify']['key'], 
                'data-content'=> __("Once set to TRUE, enables minify CSS and JS to speed up your site"),
                'data-trigger'=>"hover",
                'data-placement'=>"right",
                'data-toggle'=>"popover",
                'data-original-title'=>__("Activates Minify CSS/JS"),
                ))?> 
            </div>
        </div>

        <div class="form-group">
			<?= FORM::label($forms['sort_by']['key'], __('Sort by in listing'), array('class'=>'control-label col-sm-3', 'for'=>$forms['sort_by']['key']))?>
			<div class="col-sm-4">
				<?= FORM::select($forms['sort_by']['key'], array('title-asc'=>"Name (A-Z)",
																	 'title-desc'=>"Name (Z-A)",
																	 'price-asc'=>"Price (Low)",
																	 'price-desc'=>"Price (High)",
																	 'featured'=>"Featured",
																	 'published-asc'=>"Newest",
																	 'published-desc'=>"Oldest"), 
				$forms['sort_by']['value'], array(
				'placeholder' => $forms['sort_by']['value'], 
				'class' => 'tips form-control input-sm ', 
				'id' => $forms['sort_by']['key'],
				'data-content'=> __("Sort by in listing"),
				'data-trigger'=>"hover",
				'data-placement'=>"right",
				'data-toggle'=>"popover",
				'data-original-title'=>__("Sort by in listing"), 
				))?> 
			</div>
		</div>

		<div class="form-actions">
			<?= FORM::button('submit', 'Update', array('type'=>'submit', 'class'=>'btn btn-primary', 'action'=>Route::url('oc-panel',array('controller'=>'settings', 'action'=>'general'))))?>
		</div>
	</fieldset>	
</div><!--end well-->
