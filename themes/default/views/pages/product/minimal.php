<?php defined('SYSPATH') or die('No direct script access.');?>

    <h2><?=$product->title?>
        <?if ($product->has_offer()):?>
            <span class="label label-success mb-20 "><?=__('Offer')?> <?=$product->formated_price()?> <del><?=$product->price.' '.$product->currency?></del></span>
            <p><?=__('Offer valid until')?> <?=(Date::format((Model_Coupon::current()->loaded())?Model_Coupon::current()->valid_date:$product->offer_valid))?></p>
        <?else:?>
            <?if($product->final_price() != 0):?>
                <span class="label label-success mb-20 "><?=$product->formated_price()?></span>
            <?else:?>
                <span class="label label-success mb-20 "><?=__('Free')?></span>
            <?endif?>
        <?endif?>
    </h2>

    
    <?=View::factory('coupon')?>
          
    
