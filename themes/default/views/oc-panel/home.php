<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
    <h1><?=__('Welcome')?> <?=Auth::instance()->get_user()->name?></h1>
    <p><?=__('Thanks for using Open Booking.')?> 
        <?=__('Your installation version is')?> <span class="label label-info"><?=core::VERSION?></span> 
        <!-- <a class="btn btn-xs btn-primary pull-right" href="<?=Route::url('oc-panel',array('controller'=>'update','action'=>'index'))?>?reload=1">
                        <?=__('Check for updates')?></a> -->

    </p>
</div>

   
