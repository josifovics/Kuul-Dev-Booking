<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
    <h1><?=__('Create slot')?></h1>
</div>

<?= FORM::open(Route::url('oc-panel',array('controller'=>'slot','action'=>'create')), array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data'))?>
<fieldset>
	<div class="form-group">
        <?= FORM::label('product', __('product'), array('class'=>'col-md-3 control-label', 'for'=>'product'))?>
        <div class="col-md-5">
            <select name="id_product" id="product" required>
            	<option></option>
            	<?foreach($product as $p):?>
            		<option value="<?=$p->id_product?>"><?=$p->title?></option>
            	<?endforeach?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <?= FORM::label('spaces', __('spaces'), array('class'=>'col-md-3 control-label', 'for'=>'spaces'))?>
        <div class="col-md-5">
            <?= FORM::input('spaces', '', array('placeholder' => __('spaces'), 'class' => '', 'id' => 'spaces', 'required'))?>
        </div>
    </div>
    <div class="form-group">
        <?= FORM::label('extra_price', __('extra_price'), array('class'=>'col-md-3 control-label', 'for'=>'extra_price'))?>
        <div class="col-md-5">
            <?= FORM::input('extra_price', '', array('placeholder' => __('extra_price'), 'type'=>'numeric' ,'class' => '', 'id' => 'extra_price'))?>
        </div>
    </div>
    <div class="form-actions">
        <?= FORM::button('submit', __('Create'), array('type'=>'submit', 'class'=>'btn btn-success', 'action'=>Route::url('oc-panel',array('controller'=>'slot','action'=>'create'))))?>
    </div>
</fieldset>
<?= FORM::close()?>