<?php defined('SYSPATH') or die('No direct script access.');?>

<section class="well categories clearfix">

    <?$i=0;
    foreach($categs as $c):?>
    <?if($c['id_category_parent'] == 1 && $c['id_category'] != 1):?>

    <ul class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <li class="cathead">
            <?if (file_exists(DOCROOT.'images/categories/'.$c['seoname'].'.png')):?>
            <a title="<?=$c['name']?>" href="<?=Route::url('list', array('category'=>$c['seoname']))?>">
            <img src="<?=URL::base().'images/categories/'.$c['seoname'].'.png'?>" >
            </a>
            <?endif?>
            <a title="<?=$c['name']?>" href="<?=Route::url('list', array('category'=>$c['seoname']))?>"><?=mb_strtoupper($c['name']);?> <span class="badge badge-success pull-right"><?=$c['count']?></span></a>
        </li>
        
        <?foreach($categs as $chi):?>
            <?if($chi['id_category_parent'] == $c['id_category']):?>
            <li><a title="<?=$chi['name']?>" href="<?=Route::url('list', array('category'=>$chi['seoname']))?>">
                <?=$chi['name'];?> <span class="badge pull-right"><?=$chi['count']?></span></a>
            </li>
            <?endif?>
         <?endforeach?>
    </ul>
    <?
    $i++;
        if ($i%3 == 0) echo '<div class="clear"></div>';
        endif?>
    <?endforeach?>

</section>
