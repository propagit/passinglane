<link href="<?=base_url()?>assets/lightbox/magnific-popup.css" rel="stylesheet" media="screen">
<script src="<?=base_url()?>assets/lightbox/jquery.magnific-popup.js"></script>
<script>
$j(function(){

	$j('.popup-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		}
	});
	
	
});//ready

</script>
<div class="container">
	<div class="pagewrap">
		<div id="pagewrapper">        
            <div class="row">
                <div class="col-xs-12">
                    <div class="img-page-wrapper">
                        <? 												
						if($page->image!=''){?>
                    			<img src="<?=base_url()?>uploads/page/<?=md5('page'.$page->id)?>/<?=$page->image?>" >
                               	<div class="page-text-background">
                                    <div class="page-title"><?=$page->title?></div>
                                    <div class="page-description"><p>
                                        <?=$page->description?></p>
                                    </div>
                                </div> 
                        <? } ?>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <!--<div class="col-xs-7">
                    <p>
                    All resources for accredited courses are developed in line with the Australian Qualifications Framework units of competencies and performance criteria.
                    <br /><br />
                    The resources come in both written and video formats.
                    <br /><br />
                    The Passing Lane product line is constantly being expanded so we encourage all VET teachers and trainers to visit this website for the most recent releases.
                    <br /><br />
                    <span class="highlight">BENEFITS OF THE PASSING LANE LICENCE AGREEMENTS</span>
                    <br /><br />
                    The Passing Lane written materials licence ensures schools, TAFEs or RTOs avoid costly per student charges.
                    <br /><br />
                    The Passing Lane written materials licence ensures schools, TAFEs or RTOs avoid costly educational reproduction fees under the Copyright Statutory Licences during the licence period.
                    <br /><br />
                    The Passing Lane video licence ensures schools, TAFEs or RTOs have unlimited use of the videos for effective and unencumbered training. 
                    </p>
                </div>
                <div class="col-xs-5">
                    <ul>
                        <li><span class="arrow"><i class="fa fa-chevron-circle-right"></i></span><a href="#" class="blue-link">PASSING LANE WRITTEN RESOURCES FEATURES </a></li>
                        <li><span class="arrow"><i class="fa fa-chevron-circle-right"></i></span><a href="#" class="blue-link">PASSING LANE VIDEO RESOURCES FEATURES</a></li>
                        <li><span class="arrow"><i class="fa fa-chevron-circle-right"></i></span><a href="#" class="blue-link">LICENCE AGREEMENT OVERVIEW</a></li>
                    </ul>
                </div>-->
                <div class="col-xs-12">
                	<div class="page-editor">
                		<?=$page->content?>
                        
                        <?php if($page->gallery){?>   
                     <?php
                        //get gallery here
                        $setting = $this->page_model->get_gallery_setting(1);
                        if($setting['regenerate']==0){$folder_init='galleries'; $folder_pic = 'thumbnails';}else{$folder_init='regenerate'; $folder_pic = $setting['size'];}
                        $gallery = $this->page_model->get_gallery($page->gallery);
                        $dir = $this->page_model->get_gallery_folder($page->gallery);
                    ?>
                        
						<link rel="stylesheet" href="<?=base_url()?>assets/frontend-assets/flexjs/flexslider.css" type="text/css" media="screen" />
                        <script src="<?=base_url()?>assets/frontend-assets/flexjs/modernizr.js"></script>
                        <script defer src="<?=base_url()?>assets/frontend-assets/flexjs/jquery.flexslider.js"></script>
                        <script>
						jQuery(window).load(function() {
						  // The slider being synced must be initialized first
						  jQuery('#carousel').flexslider({
							animation: "slide",
							controlNav: false,
							animationLoop: false,
							slideshow: false,
							itemWidth: <?=$setting['width']?>+10,
							itemMargin: 5,
							asNavFor: '#slider'
						  });
				
						});
						</script>
                        
                        <style>
						.popup-gallery {
							border:none!important;
						}
						.slides li:before {
							content:""!important;
						}
						
						.flex-direction-nav li:before{
							content:""!important;
						}
						.slides{
							padding: 0!important;
						}
						.flex-direction-nav{
							padding: 0!important;
							height: 0!important;
						}
						</style>
                        
                        <div class="gallery-box" style="width:100%!important;">
                            <span>Click Image For Larger View</span>
                            <div class="gallery-img-box">           
                        <div id="carousel" class="flexslider">
                          <ul class="slides popup-gallery">
                            <? if($gallery){
                                foreach($gallery as $photo){
                                    $photo_src_full = base_url().'uploads/galleries/'.$dir.'/'.$photo->name;                                    
                                    $thumb_src = base_url().'uploads/'.$folder_init.'/'.$dir.'/'.$folder_pic.'/'.$photo->name;
                                ?>
                                    <li><a title="<?=$photo->name;?>" href="<?=$photo_src_full?>"><img style="width:auto!important;" src="<?=$thumb_src;?>" /></a></li>
                                <?
                                }
                             }?>
                            <!-- items mirrored twice, total of 12 -->
                          </ul>
                        </div>
                        </div>
                        </div>
	                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
			 	<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>
                <!-- Syntax Highlighter -->
				<script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/flexjs/shCore.js"></script>
                <script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/flexjs/shBrushXml.js"></script>
                <script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/flexjs/shBrushJScript.js"></script>
                
                <!-- Optional FlexSlider Additions -->
                <script src="<?=base_url()?>assets/frontend-assets/flexjs/jquery.easing.js"></script>
                <script src="<?=base_url()?>assets/frontend-assets/flexjs/jquery.mousewheel.js"></script>
                <script defer src="<?=base_url()?>assets/frontend-assets/flexjs/demo.js"></script>   
                 <?php }?>                           
                        
                        
                    </div>
                </div>
            </div>
     	</div>
     </div>
 </div>
 <div class="shadow-line"></div>