<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="col-xs-8">
	<?if($images):?>
		<div class="carousel slide article-slide" id="article-photo-carousel">
		  	<!-- Wrapper for slides -->
		  	<div class="carousel-inner cont-slider">
			    <?$i=0;
	            foreach ($images as $path => $value):?>
	                <?if($images = $product->get_images()):?>
                        <?if( isset($value['thumb']) AND isset($value['image']) ):?>
	                        <div class="item <?=($i == 0)?'active':''?>">
		                        <a rel="prettyPhoto[gallery]" href="<?=URL::base()?><?= $value['image']?>">             
		                            <img class="main-image" src="<?=URL::base()?><?= $value['image']?>" >
		                        </a>
	                        </div>               
                        <?endif?>   
	                <?endif?>
	            <?$i++;
	            endforeach?>
		  	</div>
		  	<!-- Indicators -->
		  	<ol class="carousel-indicators">
		  		<?$j=0;
		        foreach ($images as $path => $value):?>
			        <li class="<?=($j == 0)?'active':'item'?>" data-slide-to="<?=$j?>" data-target="#article-photo-carousel">
			            <?if($images = $product->get_images()):?>        
			                <?if( isset($value['thumb']) AND isset($value['image']) ):?>
			                    <img src="<?=URL::base()?><?= $value['thumb']?>" >
			                <?endif?>   
			            <?endif?>
			        </li>
		        <?$j++;
		        endforeach?>
		  	</ol>
		</div>
	<?else:?>
		<img src="http://www.placehold.it/300x300&text=No Image">
	<?endif?>
</div>

<div class="col-xs-4">

	<?if ($product->has_offer()):?>
	    <span class="offer">
	    	<h4><span class="label label-success">
	    		<i class="glyphicon glyphicon-bullhorn"></i>
	    	</span> <?=__('Offer')?> <?=$product->formated_price()?> 
	    	<del><?=$product->price.' '.$product->currency?></del> </h4>
	    </span>
		<span class="offer-valid"><?=__('Offer valid until')?> <?=(Date::format((Model_Coupon::current()->loaded())?Model_Coupon::current()->valid_date:$product->offer_valid))?></span>
	<?else:?>
	    <?if($product->final_price() != 0):?>
	        <h4><?=__('Price')?> : <?=$product->formated_price()?></span></h4>
	    <?else:?>
	        <h4><?=__('Free')?></h4>
	    <?endif?>
	<?endif?>

	<?if (!empty($product->url_demo)):?>
    	<a class="btn btn-warning btn-xs pull-right" href="<?=Route::url('product-demo', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>" >
        <i class="glyphicon glyphicon-eye-open"></i> <?=__('Demo')?></a>
	<?endif?>
<script src="http://book.ok/embed.js?v=1.5"></script>
		<a class="oe_button" href="http://book.ok/hostel-5-stars/8-beds-room.html">Buy Now €0,00</a>
	

</div>

<div class="col-xs-12">
	<ul class="nav nav-tabs mb-30">
	  	<li class="active">
	  		<a href="#description" data-toggle="tab"><?=__('Description')?></a>	
	  	</li>
	  	<li><a href="#details" data-toggle="tab"><?=__('Details')?></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="description">
			<?=Text::bb2html($product->description,TRUE)?>
		</div>
		<div class="tab-pane" id="details">
			<?if(core::config('product.number_of_orders')):?>
				<p><span class="glyphicon glyphicon-shopping-cart"></span> <?=$number_orders?></p>
			<?endif?>
			<p><?=__('Hits')?> : <?=$hits?></p>

		    <?if ($product->has_file()==TRUE):?>
			    <p><?=__('Product format')?> : <?=mb_strtoupper(strrchr($product->file_name, '.'))?> <?=__('file')?> </p>
			    <p><?=__('Product size')?> : <?=round(filesize(DOCROOT.'data/'.$product->file_name)/pow(1024, 2),2)?>MB</p>
		    <?endif?>

		</div>
	</div>
</div>
<div class="clearfix"></div>
<br/>
<div class="coupon">
<?=View::factory('coupon')?>
</div>
<div class="clearfix"></div><br>
<?=$product->qr()?>
<?=$product->related()?>
<?=$product->disqus()?>