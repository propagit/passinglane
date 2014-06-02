<!-- production -->
<script type="text/javascript" src="<?=base_url();?>assets/js/plupload/plupload.full.min.js"></script>


<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div class="title-page">EDIT PRODUCT</div>
        <div class="grey-box">
			<button class="btn btn-info" onclick="window.location = '<?=base_url()?>admin/product';">Back To Product List</button>
            <button class="btn btn-info pull" onclick="window.open('<?=base_url()?>product_preview/<?=$product['id_title'];?>');">Preview</button>
        </div>
        <div class="grey-box">
			<div class="title-page">Basic Details</div>
        </div>
        <div class="sub-title add-bottom-margin">Enter the basic details of the product such as the name, price and description. The information you enter here will appear on the customer page.</div>
		<form id="addProduct" enctype="multipart/form-data" method="post" action="<?=base_url()?>admin/product/details/<?=$product['id'];?>">
			<input type="hidden" name="update_id" value="<?=$product['id']?>" />
			<div>
				<div class="form-common-label">Name</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="title" name="title" value="<?=$product['title']?>"/>
				</div>
			</div>
            <div class="form-common-gap">&nbsp;</div>
            <div>
				<div class="form-common-label">Subtitle</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="subtitle" name="subtitle" value="<?=$product['subtitle'];?>"/>
				</div>
			</div>
            <div class="form-common-gap">&nbsp;</div>
            <div>
				<div class="form-common-label">Price</div>
				<div class="input-group">
  					<span class="input-group-addon no-border-radius">$</span>
					<input type="text" class="form-control input-text" id="price" name="price" onkeypress="return help.check_numeric(this, event,'nd');" value="<?=$product['price']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
            <div>
				<div class="form-common-label">Sale Price</div>
				<div class="input-group">
               		<span class="input-group-addon no-border-radius">$</span>
					<input type="text" class="form-control input-text" id="sale_price" name="sale_price" onkeypress="return help.check_numeric(this, event,'nd');" value="<?=$product['sale_price']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Short Description</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="short_desc" name="short_desc" value="<?=$product['short_desc']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Long Description</div>
				<div class="form-common-input">		
					<textarea class="form-control input-text" id="long_desc" name="long_desc" rows="6"><?=$product['long_desc']?></textarea>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			
			<div>
				<div class="form-common-label">Modules</div>
				<div class="form-common-input">
					<textarea class="form-control input-text" id="modules" name="modules" rows="6"><?=$product['modules']?></textarea>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>   
            <div class="grey-box">
				<div class="title-page">Product Specification</div>
       		</div> 
            <div class="sub-title add-bottom-margin">
            	Specify the product delivery type such as the product will be downloaded or delivered by post.<br />
            	File types accepted: (PDF, DOC, DOCX, PPT, MP4, AVI)<br /> 
				File size restriction: (None)	    
            </div>    
			<div>
				<div class="form-common-label">Delivery Method</div>
				<div class="form-common-input">
                    <select id="product_collection" name="product_collection" class="custom-select">
                        <option value="download" <?=$product['product_collection'] == 'download' ? 'selected="selected"' : '';?>>Download</option>
                        <option value="postal" <?=$product['product_collection'] == 'postal' ? 'selected="selected"' : '';?>>Postal Delivery</option>
                    </select>
				</div>
			</div>       
            <div class="form-common-gap">&nbsp;</div>
            <div id="product-file-upload-wrap">
                <div>
                	
                    <div class="form-common-label"><?=$product['product_file_name'] ? 'Replace' : 'Upload';?> Product File</div>
                    <div class="form-common-input">
                    	<div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
                    	<div class="progress progress-striped active" style="visibility: hidden;">
						  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;" id="upload-progress">
						    0%
						  </div>
						</div>

                    	
                        <div id="upload_container">
						    <button id="pickfiles" href="javascript:;" class="btn btn-info">Select files</button>
						    <button id="uploadfiles" href="javascript:;" class="btn btn-info">Upload files</button>
						</div>
                        <!--
<div class="fileupload fileupload-new custom-fileupload" data-provides="fileupload">
                        <div class="input-append">
                        <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
                        <span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
                        <input type="file" name="product_file" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                        </div>
-->
                    </div>
                </div>  
                <div class="form-common-gap">&nbsp;</div>
				<?php if($product['product_file_name']){ ?>
                <div>
                    <div class="form-common-label">Current Product File</div>
                    <div class="form-common-input">	
                        <a target="_blank" href="<?=$dir;?>/product_file/<?=$product['product_file_name'];?>"><?=$product['product_file_name'];?></a>
                        <a class="delete-product-file pointer"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <?php } ?>
                <div class="form-common-gap">&nbsp;</div>
            </div>
            <div>
				<div class="form-common-label">Product Type</div>
				<div class="form-common-input">
                	<select id="product_type" name="product_type" class="custom-select">
                    	<option value="">Please Select</option>
                        <option value="written" <?=$product['product_type'] == 'written' ? 'selected="selected"' : '';?>>Written</option>
                        <option value="video" <?=$product['product_type'] == 'video' ? 'selected="selected"' : '';?>>Video</option>
                        <option value="other" <?=$product['product_type'] == 'other' ? 'selected="selected"' : '';?>>Other</option>
                    </select>
				</div>
			</div>
            <div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Product Active</div>
				<div class="form-common-input">
					<input type="checkbox" class="textfield rounded" id="status" name="status" value="1" <?=$product['status'] ? 'checked="checked"' : '';?>/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
             <div class="grey-box">
				<div class="title-page">Product Brochure</div>
       		</div>   
            <div class="sub-title add-bottom-margin">
            	Add a downloadable PDF document that your customers will be able to download.<br />
            	File types accepted: (PDF, DOC, DOCX, PPT, MP4, AVI, JPG, PNG, GIF)<br /> 
				File size restriction: (None)
            </div>        
            <div>
				<div class="form-common-label"><?=$product['product_brochure'] ? 'Replace' : 'Upload';?> Product Brochure</div>
				<div class="form-common-input">
					<div class="fileupload fileupload-new custom-fileupload" data-provides="fileupload">
                    <div class="input-append">
                    <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
                    <span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
                    <input type="file" name="product_brochure" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                    </div>
                    </div>
				</div>
			</div>  
            <div class="form-common-gap">&nbsp;</div>
            <?php if($product['product_brochure']){ ?>
            <div>
				<div class="form-common-label">Current Product Brochure</div>
				<div class="form-common-input">
                	<a target="_blank" href="<?=$dir;?>/doc/<?=$product['product_brochure'];?>"><?=$product['product_brochure'];?></a>	
                    <a class="delete-brochure pointer"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
            <?php } ?>
            <button class="btn btn-info" type="submit">Update</button>
		</form>
        
        
        
	</div>
</div>

<script>
// Custom example logic

var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles', // you can pass in id...
	container: document.getElementById('upload_container'), // ... or DOM Element itself
	url : '<?=base_url();?>admin/product/ajax/uploading/<?=$product['id'];?>',
	chunk_size: '400kb',
    max_retries: 5,
	flash_swf_url : '<?=base_url();?>assets/js/plupload/Moxie.swf',
	silverlight_xap_url : '<?=base_url();?>assets/js/plupload/Moxie.xap',

	filters : {
		max_file_size : '500mb',
		mime_types: [
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Zip files", extensions : "zip"},
			{title : "Movie files", extensions : "mov,mp4,avi"},
			{title : "Document files", extensions : "pdf,doc,docx,ppt"}
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('filelist').innerHTML = '';			
			document.getElementById('uploadfiles').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			$('#upload-progress').parent().css("visibility", "visible");
			
			plupload.each(files, function(file) {
				document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},

		UploadProgress: function(up, file) {
			//document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			$('#upload-progress').attr('aria-valuenow', 60);
			$('#upload-progress').css("width", file.percent + "%");
			$('#upload-progress').html(file.percent + '% completed');
		},
		UploadComplete: function() {
			location.reload();
		},

		Error: function(up, err) {
			document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		}
	}
});

uploader.init();

$j(function(){
	$j('.custom-select').selectpicker();
	
	toggle_product_collection();
	
	$j('#product_collection').on('change',function(){
		toggle_product_collection();
	});	
	
	//delete brochure
	$j('.delete-brochure').on('click',function(){
		var title = 'Delete Brochure';
		var message ='Are you sure you would like to delete this "Brochure"';
		var group_id = $(this).attr('delete-data-id');
		help.confirm_delete(title,message,function(confirmed){
			 if(confirmed){
				window.location.href = "<?=base_url();?>admin/product/delete_product_brochure/<?=$product['id'];?>"
			 }
		});
	});
	
	//delete product file
	$j('.delete-product-file').on('click',function(){
		var title = 'Delete Product File';
		var message ='Are you sure you would like to delete this "Product File"';
		var group_id = $(this).attr('delete-data-id');
		help.confirm_delete(title,message,function(confirmed){
			 if(confirmed){
				window.location.href = "<?=base_url();?>admin/product/delete_product_file/<?=$product['id'];?>"
			 }
		});
	});
	
	
});

function toggle_product_collection()
{
	var cur_val = $j('#product_collection').val();	
	if(cur_val == 'download'){
		$j('#product-file-upload-wrap').show();	
	}else{
		$j('#product-file-upload-wrap').hide();		
	}
}
</script>