<script>
$j(function(){
	//update banner count for first banner
	banner.update_view_count();
	$j('.carousel').carousel({
       interval: 7000
   	}).on('slid.bs.carousel', function () {
		banner.update_view_count();
	});
});

var banner = {
	update_view_count:function(){
		var active_banner_id = $j('.carousel-inner').find('.active').attr('data');
		$j.ajax({
		  type:'post',
		  url:'<?=base_url();?>passing/ajax/update_view_count',
		  data:{banner_id:active_banner_id},
		  success:function(data){
				
		  },error:function(){
			  //error
		  }
	  });	
	}
};

</script>
<div class="container">
	<div class="wrap">
        <div class="row">
            <div class="col-xs-12">
            	<div class="wrap-banners">
                    <div id="site-banners" class="carousel slide">                                                                  
                        <? if(count($banners)>1){?>
                   
                         <ol class="carousel-indicators">
                            <?
                            $i=0;
                            foreach($banners as $banner){
                            ?>
                                <li class="<?=($i==0 ? 'active' : '');?>" data-slide-to="<?=$i?>" data-target="#site-banners"></li>
                            <? 
                            $i++;
                            }?>                                         
                        </ol>
                        <? } ?>
                        <div class="carousel-inner">
                            <? $i=0; ?>
                            <? foreach($banners as $banner){?>     
                                    <div class="item <?=($i==0 ? 'active' : '');?>" data="<?=$banner['id'];?>">                                                               
                                        <a href="<?=base_url()?>passing/link/<?=$banner['id']?>"><img src="<?=base_url()?>uploads/banners/<?=$banner['name']?>" alt="" /></a>                           
                                    </div> 
                                <? 
                                $i++;
                            }
                               ?>                        
                        </div>                   
                        <? if(count($banners)>1){?>
                            <a class="left carousel-control" data-slide="prev" href="#site-banners"><i class="fa fa-angle-left"></i></a>
                            <a class="right carousel-control" data-slide="next" href="#site-banners"><i class="fa fa-angle-right"></i></a>
                        <? } ?>                                    
                       </div> 
                  </div>
            </div>
        </div>
    </div>
</div>
<div class="product-wrapper">
	<div class="blue-line">
        <div class="container">
            <div class="wrap">
                <div class="row">
                    <div class="col-xs-12">
                    	<div class="text-promotion bold">Vocational Education and Training Resources</div>
						<div class="text-promotion">Check out some of Passing Lane latest releases below</div>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <div class="clear"></div>
    <div class="container">
         <?=modules::run('product/load_feature_products');?>
    </div>
</div>

<div class="three-wrapper">
	<div class="blue-line">
        <div class="container">
            <div class="wrap">
                <div class="row">
                    <div class="col-xs-12">
                    	<div class="text-promotion bold">High Quality Comprehensive</div>
						<div class="text-promotion">Help accelerate your students or trainees learning using high quality and <br> comprehensive up to date training written resources, supported by training videos.</div>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <div class="clear"></div>
    <div class="container">
        <div class="wrap">
            <div class="row">
                <div class="col-xs-4">
                    <div class="promotion-wrapper">
                    	<div class="icon-wrapper"><i class="fa fa-question-circle"></i></div>
                        <div class="icon-title">Why<br /> Passing Lane</div>
                        <div class="icon-desc"><p class="p-description">Passing Lane is an Australian business offering comprehensive but affordable vocational education and training resources for teachers and trainers.</p></div>
                        <button type="button" class="btn btn-primary"><i class="fa fa-info-circle right5"></i> MORE INFO</button>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="promotion-wrapper">
                    	<div class="icon-wrapper"><i class="fa fa-download"></i></div>
                        <div class="icon-title">3 Year<br />Download Licence</div>
                        <div class="icon-desc"><p class="p-description">All resources purchased can be downloaded at any time over a three year licence period. This ensures you have the most up to date resources. </p></div>
                    	<button type="button" class="btn btn-primary"><i class="fa fa-info-circle right5"></i> MORE INFO</button>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="promotion-wrapper">
                    	<div class="icon-wrapper"><i class="fa fa-trophy"></i></div>
                        <div class="icon-title">Supporting the Accredited <br /> Training Framework</div>
                        <div class="icon-desc"><p class="p-description">The Passing Lane vocational education and training (VET) support resources are develop in line and to support the Australian Accredited Training Framework.</p></div>
                    	<button type="button" class="btn btn-primary"><i class="fa fa-info-circle right5"></i> MORE INFO</button>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
<div class="shadow-line"></div>