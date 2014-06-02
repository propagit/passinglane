
<style>
#hero-image{width:auto;}
@media(min-width: 320px) and (max-width:766px)
{
	#hero-image{width:100%}
}

h1{
	font-size: 20px !important;
    font-weight: 900;
    color: #000;
}
h2{
	font-weight : 700;
	font-size:18px!important;
	color: #333
}
.line-between
{
	height: 0px; 
	clear: both; 
	border-top:1px solid #ccc;
}
th
{
	font-weight : 700 !important;
	font-size:15px!important;
}
.product-gallery-wrap{
	margin-top:25px;	
}
</style>
<script>
function upload() {
	document.uploadForm.submit();
	centerPopup();
	loadPopup();
}
function deletephoto(id) {
	if(confirm('Are you sure you want to delete this photo?')) {
		window.location = '<?=base_url()?>admin/product/deletephoto/' + id;
	}
}
</script>
<div class="row row-bottom-margin product-gallery-wrap">
	<div class="col-xs-12">
		<div class="title-page">ADD NEW IMAGE</div>
		<p class="desc">Add new image by browsing your computer and uploading them. Please upload an image<br/>with size of <b>770 pixel width</b> and <b>587 pixel height</b> for the best view.</p>
		<form name="uploadForm" method="post" enctype="multipart/form-data" action="<?=base_url()?>admin/product/uploadimage">
            <input type="hidden" name="product_id" value="<?=$product['id']?>" />
            <div style="padding-left: 0px;">
                <div style="width: 20%; float: left; height: 30px; line-height: 30px;">Upload image</div>
                <div style="width: inherit; float: left">                                        
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="input-append">
                    <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
                    <span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
                    <input type="file" name="userfile" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                    </div>
                    </div>
                </div>
            </div>
            
            
            
            
            
            <div style="height: 5px; clear: both">&nbsp;</div>
            <div style="padding-left: 0px;">
                <div style="width: 20%; float: left; height: 30px; line-height: 30px;">&nbsp;</div>
                <div style="width: 80%; float: right">						
                    <button class="btn btn-info" type="button" onClick="upload()">Upload</button>
                </div>
            </div>
            <div style="height: 5px; clear: both">&nbsp;</div>                
            
            <?php if($this->session->flashdata('error_upload')) { ?>
            <div class="error"><?=$this->session->flashdata('error_upload')?></div> <?php } ?>
            
    	</form>
    	
    	<div style="height:25px;">&nbsp;</div>
    	<?php if($hero) { ?>
        <img id="hero-image" style="border: 1px solid #ccc; margin-left: 7px;" src="<?=base_url()?>uploads/products/<?=md5('mbb'.$product['id'])?>/thumb1/<?=$hero['name']?>" />
        <?php } else { ?>
        	<!-- <p>No hero image</p> -->
        	<img class="hidden-phone" src="http://placehold.it/770x587"/>
        <?php } ?>
        <div style="height:25px;">&nbsp;</div>
        <h2 class="subtitle-page">Product images</h2>
        <p class="desc">Your "Hero Image" is resized to accommodate all thumbnail images in the site and will be the main large image used on the product details page.You can add as many images as you like although only the hero image and the first three images will be displayed on the product details page. Other images will be available for view when a thumbnail image is clicked and the full product gallery is available.</p>
        <?php $n = 0; foreach($photos as $photo) { $n++; ?>
      	<div style="float: left; margin-right: 10px" class="photo<?php if($n>3) print ' extend'; ?>">
        	<img  src="<?=base_url()?>uploads/products/<?=md5('mbb'.$product['id'])?>/thumb2/<?=$photo['name']?>" />
            <div class="nav" style="text-align: center">
            	<a style="text-decoration: none" href="<?=base_url()?>admin/product/makeheroimage/<?=$photo['id']?>" title="Make this hero image">                		
            		<i class="fa fa-heart"></i>
            	</a>
            	<a style="text-decoration: none" href="<?=base_url()?>admin/product/makemodal/<?=$photo['id']?>" title="Make this image shoot model">
            		<i <?php if($photo['modal'] == 1){echo "style='color:green'";}?> class="icon icon-flag"></i>
            	</a>
            	<a style="text-decoration: none" href="javascript:deletephoto(<?=$photo['id']?>)" title="Delete this image">
            		<i class="fa  fa-times"></i>
            	</a>
            	<?php if($n>1) { ?>
            		<a style="text-decoration: none" href="<?=base_url()?>admin/product/movephoto/<?=$photo['id']?>/-1" title="Move this image to left">
            			<i class="fa  fa-arrow-circle-left"></i>
            		</a>
            	<?php } if($n < count($photos)) { ?>
            		<a style="text-decoration: none" href="<?=base_url()?>admin/product/movephoto/<?=$photo['id']?>/1" title="Move this image to right">
            			<i class="fa  fa-arrow-circle-right"></i>
            		</a>
            	<?php } ?>
            </div>
      	</div>
        <?php } ?>
        <div style="clear: both"></div>
	</div>
</div>
