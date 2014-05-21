<?php defined('SYSPATH') or die('No direct script access.');?>
     
<?if ($category!==NULL):?>
<?if (strlen($category->description>0)):?>
<div class="well advise clearfix" id="advise">
    <p><?=Text::bb2html($category->description,TRUE)?></p> 
</div><!--end of advise-->
<?endif?>
<?endif?>

    <div class="btn-group pull-right">
        <a href="#" id="list" class="btn btn-default btn-sm <?=(core::cookie('list/grid')==1)?'active':''?>">
            <span class="glyphicon glyphicon-th-list"></span><?=__('List')?>
        </a> 
        <a href="#" id="grid" class="btn btn-default btn-sm <?=(core::cookie('list/grid')==0)?'active':''?>">
            <span class="glyphicon glyphicon-th"></span><?=__('Grid')?>
        </a>
        <button type="button" id="sort" data-sort="<?=core::request('sort')?>" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-list-alt"></span><?=__('Sort')?> <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" id="sort-list">
            <li><a href="?sort=title-asc"><?=__('Name (A-Z)')?></a></li>
            <li><a href="?sort=title-desc"><?=__('Name (Z-A)')?></a></li>
            <li><a href="?sort=price-asc"><?=__('Price (Low)')?></a></li>
            <li><a href="?sort=price-desc"><?=__('Price (High)')?></a></li>
            <li><a href="?sort=featured"><?=__('Featured')?></a></li>
            <li><a href="?sort=published-desc"><?=__('Newest')?></a></li>
            <li><a href="?sort=published-asc"><?=__('Oldest')?></a></li>
        </ul>
    </div>
<div class="clearfix"></div><br>
<?if(count($products)):?>
    <div id="products" class="list-group">
        <?$i=1;
        foreach($products as $product ):?>    
            <div class="item <?=(core::cookie('list/grid')==1)?'list-group-item':'grid-group-item'?> col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <div class="thumbnail">
                    <a title="<?= $product->title;?>" href="<?=Route::url('product', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>">
                    <?if($product->get_first_image() !== NULL):?>
                        <img width="300px" height="200px" src="<?=URL::base()?><?=$product->get_first_image()?>" class="" >
                    <?else:?>
                        <img src="http://www.placehold.it/200x200&text=<?=$product->category->name?>">  
                    <?endif?>
                    </a>
                    <div class="caption">
                        <h4><a href="<?=Route::url('product', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>"><?=substr($product->title, 0, 30)?></a></h4>
                        <p><?=Text::limit_chars(Text::removebbcode($product->description), (core::cookie('list/grid')==1)?255:30, NULL, TRUE)?></p>
                    </div>
                </div>
            </div>
            <?if($i%3==0):?><div class="clearfix"></div><?endif?>
        <?$i++?>
        <?endforeach?>
    </div>

<?=$pagination?>
<?elseif (count($products) == 0):?>
<!-- Case when we dont have products for specific category / location -->
<div class="page-header">
    <h3><?=__('We do not have any product in this category')?></h3>
</div>

<?endif?>
