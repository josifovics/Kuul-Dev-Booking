<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
	<h1><?=ucfirst(__($name))?></h1>
	
	<a class="btn btn-primary pull-right" href="<?=Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'create')) ?>">
		<i class="glyphicon glyphicon-pencil"></i>
		<?=__('New')?>
	</a>				
</div>

<div class="table-responsive">
<table class="table table-hover">
	<thead>
		<tr>
			<th><?=__('Id_slot')?></th>
			<th><?=__('Spaces')?></th>
			<th><?=__('Extra price')?></th>
			<th><?=__('Product')?></th>			
		</tr>
	</thead>
	<tbody>
		<?foreach($elements as $element):?>
			<tr id="tr<?=$element->pk()?>">
				
				<td><?=$element->id_slot?></td>
                <td><?=$element->spaces?></td>
                <td><?=$element->extra_price?></td>
                <td><?=$element->product->title?></td>
                
		<?endforeach?>
	</tbody>
</table>
</div>

<?=$pagination?>