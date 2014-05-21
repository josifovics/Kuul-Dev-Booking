<?php defined('SYSPATH') or die('No direct script access.');?>
<?=Form::errors()?>

<div class="page-header">
    <h1><?=__('New Product')?></h1>
</div>


<?= FORM::open(Route::url('oc-panel',array('controller'=>'product','action'=>'create')), array('class'=>'form-horizontal product_form', 'enctype'=>'multipart/form-data'))?>
	<fieldset>
	
	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="panel panel-primary product-panel">
			<div class="panel-heading">
				<h3 class="panel-title"><span class="glyphicon glyphicon-cog"></span> <?=__('General information')?></h3>
			</div>
  			<div class="panel-body">
					<!-- drop down selector -->
		            <div class="form-group">
                        <div class="col-md-4">
                        	<?= FORM::label('category', __('category'), array('class'=>'control-label', 'for'=>'category' ))?>
                            <select data-placeholder="<?=__('category')?>" name="id_category" id="category" class="form-control" required>
                            <option></option>
                            <?function caca($item, $key,$locs){?>
                            <option value="<?=$key?>"><?=$locs[$key]['name']?></option>
                                <?if (count($item)>0):?>
                                <optgroup label="<?=$locs[$key]['name']?>">    
                                    <? if (is_array($item)) array_walk($item, 'caca', $cats);?>
                                    </optgroup>
                                <?endif?>
                            <?}array_walk($order_categories, 'caca',$categories);?>
                            </select>
                        </div>
                    </div>
		            <?if(count($locations) > 1 AND core::config('product.location')):?>
	                    <div class="form-group">
	                        
	                        <div class="col-md-4">
	                        	<?= FORM::label('location', __('Location'), array('class'=>'control-label', 'for'=>'location' ))?>
	                            <select data-placeholder="<?=__('Location')?>" name="id_location" id="location" class="form-control" required>
	                            <option></option>
	                            <?function lolo($item, $key,$locs){?>
	                            <option value="<?=$key?>"><?=$locs[$key]['name']?></option>
	                                <?if (count($item)>0):?>
	                                <optgroup label="<?=$locs[$key]['name']?>">    
	                                    <? if (is_array($item)) array_walk($item, 'lolo', $locs);?>
	                                    </optgroup>
	                                <?endif?>
	                            <?}array_walk($order_locations, 'lolo',$locations);?>
	                            </select>
	                        </div>
	                    </div>
					<?endif?>
					<div class="form-group">
						<label for="price" class="col-md-12"><?=__('Price')?> <span class="star-required">*</span></label>
						<div class="col-md-12">
							<?= FORM::input('price', Request::current()->post('price'), array('placeholder' => i18n::money_format(1), 'class' => 'form-control', 'id' => 'price', 'type'=>'text', 'required'))?>
						</div>
					</div>
					<div class="form-group">
					<label for="currency" class="col-md-12"><?=__('Currency')?> <span class="star-required">*</span></label>
		            	<div class="col-md-12">
				            <select name="currency" id="currency" class="form-control" REQUIRED>
								<option></option>
								<?foreach ($currency as $curr):?>
									<option value="<?=$curr?>"><?=$curr?></option>
								<?endforeach?>
							</select>
						</div>
					</div>

					<div class="form-group">
					<label for="title" class="col-md-12"><?=__('Title')?> <span class="star-required">*</span></label>
						<div class="col-md-12">
							<?= FORM::input('title', Request::current()->post('title'), array('placeholder' => __('Title'), 'class' => 'form-control', 'id' => 'title', 'required'))?>
						</div>
					</div>

					<div class="form-group">
						<label for="description" class="col-md-12"><?=__('Description')?> <span class="star-required">*</span></label>
						<div class="col-md-12">
							<?= FORM::textarea('description', Request::current()->post('description'), array('class'=>'form-control', 'name'=>'description', 'id'=>'description' ,  'rows'=>10, 'required'))?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-sm-6 col-xs-6">
			<div class="panel panel-primary product-panel">
				<div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> <?=__('Details')?></div>
	  			<div class="panel-body">

                    <?if(Core::config('affiliate.active')==1 AND Theme::get('premium')==1):?>
                    <div class="form-group">
                        <?= FORM::label('affiliate_percentage', __('Affiliate commission %'), array('class'=>'col-md-12 ', 'for'=>'affiliate_percentage'))?>
                        <div class="col-md-12">
                            <?= FORM::input('affiliate_percentage', Request::current()->post('affiliate_percentage'), array('placeholder' => i18n::money_format(1), 'class' => 'form-control', 'id' => 'affiliate_percentage', 'type'=>'text'))?>
                        </div>
                    </div>
                    <?endif?>

					<div class="form-group">
						<?= FORM::label('price_offer', __('Price Offer'), array('class'=>'col-md-12 ', 'for'=>'price_offer'))?>
						<div class="col-md-12">
							<?= FORM::input('price_offer', Request::current()->post('price_offer'), array('placeholder' => i18n::money_format(1), 'class' => 'form-control', 'id' => 'price_offer', 'type'=>'text'))?>
						</div>
					</div>

					<div class="form-group">
						<?= FORM::label('offer_valid', __('Offer Valid'), array('class'=>'col-md-12', 'for'=>'offer_valid'))?>
						<div class="col-md-8">	
							<input  type="text" size="16" id="offer_valid" name="offer_valid"  value="" class="form-control " data-date="" data-date-format="yyyy-mm-dd">
		                </div>
		            </div>

		            <div class="form-group">
						<?= FORM::label('url_demo', __('Url demo'), array('class'=>'col-md-12 ', 'for'=>'url_demo'))?>
						<div class="col-md-12">
							<?= FORM::input('url_demo', Request::current()->post('url_demo'), array('placeholder' => __('http://open-eshop.com'), 'class' => 'form-control', 'id' => 'url_demo', 'type' => 'url'))?>
						</div>
					</div>

		            <div class="form-group">
		                <?= FORM::label('featured', __('Feature product'), array('class'=>'col-md-12 ', 'for'=>'featured'))?>
		                <div class="col-md-8">  
		                    <input  type="text" size="16" id="featured" name="featured"  value="" class="form-control" data-date="" data-date-format="yyyy-mm-dd">
		                </div>
		            </div>

					<div class="form-group">
						<?= FORM::label('email_purchase_notes', __('Purchase notes, sent via email'), array('class'=>'col-md-12 ', 'for'=>'email_purchase_notes', 'spellcheck'=>TRUE))?>
						<div class="col-md-12">
							<?= FORM::textarea('email_purchase_notes', Request::current()->post('email_purchase_notes'), array('class'=>'form-control', 'name'=>'email_purchase_notes', 'id'=>'email_purchase_notes' , 'rows'=>10))?>
						</div>
					</div>
	  			</div>
	  		</div>
	  	</div>

		<!-- PRODUCT FILES -->
		<div class="clearfix"></div>
		<div class="col-md-12">
			<div class="panel panel-primary product-panel">
				<div class="panel-heading">
					<h3 class="panel-title"><span class="glyphicon glyphicon-file"></span> <?=__('Upload files')?></h3>
				</div>
	  			<div class="panel-body">
					
					<div class="panel-title">
				    	<h2><small><?=__('Select product images')?></small></h2> 
				  	</div>
					<?for ($i=0; $i < core::config('product.num_images') ; $i++):?>
					
						<div class="fileinput fileinput-new" data-provides="fileinput">
						  	<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
						    	<img src="http://www.placehold.it/200x150&text=Image" alt="<?=__('Image')?>">
						  	</div>
						  	<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
						  	<div>
						    	<span class="btn btn-default btn-file">
						    	<span class="fileinput-new"><?=__('Select image')?></span>
						    	<span class="fileinput-exists"><?=__('Change')?></span>
						    	<input type="file" name="<?='image'.$i?>" id="<?='fileInput'.$i?>"></span>
						    	<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=__('Remove')?></a>
						  	</div>
						</div>
					<?endfor?>
					<hr>
					<div class="panel-title">
				    	<h2><small><?=__('Digital file')?></small></h2> 
                        <p>upload_max_filesize: <?=ini_get('upload_max_filesize')?>, max_execution_time:<?=ini_get('max_execution_time')?></p>
				  	</div>
					
				    <div class="col-md-12">
					    <div class="clearfix"></div> <br>
						<span class="btn btn-success fileinput-button">
					        <i class="glyphicon glyphicon-plus"></i>
					        <span><?=__('Add File')?></span>  
					        <input id="fileupload" type="file" data-url="upload" name="fileupload" data-size="<?=core::config('product.max_size')*1024*1024?>">
					    </span>
					    <div class="clearfix"></div><br>
					
						<div class="drop-down-box"><span class="fileinput-new"><?=__('Drag & Drop file here')?></span></div>
					
						<div class="clearfix"></div> <br>
						<div id="progress" class="progress">
					        <div class="bar progress-bar progress-bar-success" style="width: 0%;"></div>
					    </div>

						<input id="uploadedfile" type="hidden" name="confirm_file">
						<div id="name-files" class="name-files"></div>
						<div id="files" class="files"></div>
						<button id="delete-button-file" class="hide btn btn-danger"><?=__('Delete')?></button>
					</div>
					

					<div class="clearfix"></div><br>
					<div class="pull-right">
						<?= FORM::button('submit', __('Save'), array('type'=>'submit', 'class'=>'btn btn-primary btn-lg', 'action'=>Route::url('oc-panel',array('controller'=>'product','action'=>'create'))))?>
						<div class="">
							<div class="checkbox ">
						        <label>
						          	<input type="checkbox" name="status" value="" checked="checked">  &nbsp; <?=__('Active')?>?
						        </label>
					      	</div>
				      	</div>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
<?= FORM::close()?>
