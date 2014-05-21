<?php defined('SYSPATH') or die('No direct script access.');?>

<?=View::factory('oc-panel/elasticemail')?>
	
		 <?=Form::errors()?>
		<div class="page-header">
			<h1><?=__('Email Configuration')?></h1>
		<p><?=__('List of general configuration values. Replace input fields with new desired values')?></p>
            <p>How to configure <a href="http://open-classifieds.com/2014/02/12/configure-elasticemail-open-classifieds/">ElasticEmail</a></p>
        </div>


		<div class="well">
		<?= FORM::open(Route::url('oc-panel',array('controller'=>'settings', 'action'=>'email')), array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data'))?>
			<fieldset>
				<?foreach ($config as $c):?>
					<?$forms[$c->config_key] = array('key'=>$c->config_key, 'value'=>$c->config_value)?>
				<?endforeach?>
				<div class="form-group">
					<?= FORM::label($forms['notify_email']['key'], __('Notify email'), array('class'=>'col-md-3 control-label', 'for'=>$forms['notify_email']['key']))?>
					<div class="col-md-5">
						<?= FORM::input($forms['notify_email']['key'], $forms['notify_email']['value'], array(
						'placeholder' => "youremail@mail.com", 
						'class' => 'tips form-control', 
						'id' => $forms['notify_email']['key'], 
						'data-content'=> __("Email from where we send the emails, also used for software communications."),
						'data-trigger'=>"hover",
						'data-placement'=>"right",
						'data-toggle'=>"popover",
						'data-original-title'=>__("Email From"),
						))?> 
					</div>
				</div>
				<div class="form-group">
					<?= FORM::label($forms['smtp_active']['key'], __('Smtp active'), array('class'=>'col-md-3 control-label', 'for'=>$forms['smtp_active']['key']))?>
					<div class="col-md-5">
						<?= FORM::select($forms['smtp_active']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['smtp_active']['value'], array(
						'placeholder' => "TRUE or FALSE", 
						'class' => 'tips form-control', 
						'id' => $forms['smtp_active']['key'], 
						'data-content'=> '',
						'data-trigger'=>"hover",
						'data-placement'=>"right",
						'data-toggle'=>"popover",
						'data-original-title'=>'',
						))?> 
					</div>
				</div>
                <div class="form-group">
                    <?= FORM::label($forms['smtp_ssl']['key'], __('Smtp ssl'), array('class'=>'col-md-3 control-label', 'for'=>$forms['smtp_ssl']['key']))?>
                    <div class="col-md-5">
                        <?= FORM::select($forms['smtp_ssl']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['smtp_ssl']['value'], array(
                        'placeholder' => "TRUE or FALSE", 
                        'class' => 'tips form-control', 
                        'id' => $forms['smtp_ssl']['key'], 
						'data-content'=> '',
						'data-trigger'=>"hover",
						'data-placement'=>"right",
						'data-toggle'=>"popover",
						'data-original-title'=>'',                     
						))?> 
                    </div>
                </div>
				<div class="form-group">
					<?= FORM::label($forms['smtp_host']['key'], __('Smtp host'), array('class'=>'col-md-3 control-label', 'for'=>$forms['smtp_host']['key']))?>
					<div class="col-md-5">
						<?= FORM::input($forms['smtp_host']['key'], $forms['smtp_host']['value'], array(
						'placeholder' => '', 
						'class' => 'tips form-control', 
						'id' => $forms['smtp_host']['key'], 
						'data-content'=> '',
						'data-trigger'=>"hover",
						'data-placement'=>"right",
						'data-toggle'=>"popover",
						'data-original-title'=>'',				
						))?> 
					</div>
				</div>
				<div class="form-group">
					<?= FORM::label($forms['smtp_port']['key'], __('Smtp port'), array('class'=>'col-md-3 control-label', 'for'=>$forms['smtp_port']['key']))?>
					<div class="col-md-5">
						<?= FORM::input($forms['smtp_port']['key'], $forms['smtp_port']['value'], array(
						'placeholder' => "", 
						'class' => 'tips form-control', 
						'id' => $forms['smtp_port']['key'], 
						'data-content'=> '',
						'data-trigger'=>"hover",
						'data-placement'=>"right",
						'data-toggle'=>"popover",
						'data-original-title'=>'',			
						))?> 
					</div>
				</div>
				<div class="form-group">
					<?= FORM::label($forms['smtp_auth']['key'], __('Smtp auth'), array('class'=>'col-md-3 control-label', 'for'=>$forms['smtp_auth']['key']))?>
					<div class="col-md-5">
							<?= FORM::select($forms['smtp_auth']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['smtp_auth']['value'], array(
							'placeholder' => "", 
							'class' => 'tips form-control', 
							'id' => $forms['smtp_auth']['key'], 
							'data-content'=> '',
							'data-trigger'=>"hover",
							'data-placement'=>"right",
							'data-toggle'=>"popover",
							'data-original-title'=>'',					
							))?> 
						</div>
				</div>
				<div class="form-group">
					<?= FORM::label($forms['smtp_user']['key'], __('Smtp user'), array('class'=>'col-md-3 control-label', 'for'=>$forms['smtp_user']['key']))?>
					<div class="col-md-5">
						<?= FORM::input($forms['smtp_user']['key'], $forms['smtp_user']['value'], array(
						'placeholder' => "", 
						'class' => 'tips form-control', 
						'id' => $forms['smtp_user']['key'], 
						'data-content'=> '',
						'data-trigger'=>"hover",
						'data-placement'=>"right",
						'data-toggle'=>"popover",
						'data-original-title'=>'',				
						))?> 
					</div>
				</div>
				<div class="form-group">
					<?= FORM::label($forms['smtp_pass']['key'], __('Smtp password'), array('class'=>'col-md-3 control-label', 'for'=>$forms['smtp_pass']['key']))?>
					<div class="col-md-5">
						<?= FORM::input($forms['smtp_pass']['key'], $forms['smtp_pass']['value'], array(
						'placeholder' => "",
						'type' => "password", 
						'class' => 'tips form-control', 
						'id' => $forms['smtp_pass']['key'], 
						'data-content'=> '',
						'data-trigger'=>"hover",
						'data-placement'=>"right",
						'data-toggle'=>"popover",
						'data-original-title'=>'',				
						))?> 
					</div>
				</div>
				<div class="form-group">
					<?= FORM::label($forms['new_sale_notify']['key'], __('Notify me on new sale'), array('class'=>'col-md-3 control-label', 'for'=>$forms['new_sale_notify']['key']))?>
					<div class="col-md-5">
						<?= FORM::select($forms['new_sale_notify']['key'], array(FALSE=>'FALSE',TRUE=>'TRUE'), $forms['new_sale_notify']['value'], array(
						'placeholder' => "TRUE or FALSE",
						'class' => 'tips form-control', 
						'id' => $forms['new_sale_notify']['key'], 
						'data-content'=> '',
						'data-trigger'=>"hover",
						'data-placement'=>"right",
						'data-toggle'=>"popover",
						'data-original-title'=>'',
						))?> 
					</div>
				</div>
				<div class="form-actions">
					<?= FORM::button('submit', 'Update', array('type'=>'submit', 'class'=>'btn btn-primary', 'action'=>Route::url('oc-panel',array('controller'=>'settings', 'action'=>'email'))))?>
				</div>
			</fieldset>	
	</div><!--end col-md-10-->
