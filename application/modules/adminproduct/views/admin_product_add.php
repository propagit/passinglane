<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div class="title-page">CREATE PRODUCT</div>
        <div class="grey-box">
			<button class="btn btn-info" onclick="window.location = '<?=base_url()?>admin/product';">Back To Product List</button>
        </div>
        <div class="grey-box">
			<div class="title-page">Basic Details</div>
        </div>
        <div class="sub-title add-bottom-margin">Enter the basic details of the product such as the name, price and description. The information you enter here will appear on the customer page.</div>
		<form id="addProduct" enctype="multipart/form-data" method="post" action="<?=base_url()?>admin/product/add">
			<div>
				<div class="form-common-label">Name</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="title" name="title" value=""/>
				</div>
			</div>
            <div class="form-common-gap">&nbsp;</div>
            <div>
				<div class="form-common-label">Subtitle</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="subtitle" name="subtitle" value=""/>
				</div>
			</div>
            <div class="form-common-gap">&nbsp;</div>
            <div>
				<div class="form-common-label">Price</div>
				<div class="input-group">
  					<span class="input-group-addon no-border-radius">$</span>
					<input type="text" class="form-control input-text" id="price" name="price" onkeypress="return help.check_numeric(this, event,'nd');" value=""/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
            <div>
				<div class="form-common-label">Sale Price</div>
				<div class="input-group">
               		<span class="input-group-addon no-border-radius">$</span>
					<input type="text" class="form-control input-text" id="sale_price" name="sale_price" onkeypress="return help.check_numeric(this, event,'nd');" value=""/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Short Description</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="short_desc" name="short_desc" value=""/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Long Description</div>
				<div class="form-common-input">		
					<textarea class="form-control input-text" id="long_desc" name="long_desc" rows="6"></textarea>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			
			<div>
				<div class="form-common-label">Modules</div>
				<div class="form-common-input">
					<textarea class="form-control input-text" id="modules" name="modules" rows="6"></textarea>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>   
            <div class="grey-box">
				<div class="title-page">Product Specifications</div>
       		</div> 
            <div class="sub-title add-bottom-margin">Specify the product delivery type such as the product will be downloaded or delivered by post.</div>  
			<div>
				<div class="form-common-label">Delivery Method</div>
				<div class="form-common-input">
                    <select id="product_collection" name="product_collection" class="custom-select">
                        <option value="download">Download</option>
                        <option value="postal">Postal Delivery</option>
                    </select>
				</div>
			</div>       
            <div class="form-common-gap">&nbsp;</div>
			<div id="product-file-upload-wrap">
                <div>
                    <div class="form-common-label">Upload Product File</div>
                    <div class="form-common-input">
                        
                        <div class="fileupload fileupload-new custom-fileupload" data-provides="fileupload">
                        <div class="input-append">
                        <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
                        <span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
                        <input type="file" name="product_file" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                        </div>
                    </div>
                </div>  
                <div class="form-common-gap">&nbsp;</div>
            </div>
			<div>
				<div class="form-common-label">Product Type</div>
				<div class="form-common-input">
                	<select id="product_type" name="product_type" class="custom-select">
                    	<option value="">Please Select</option>
                        <option value="written">Written</option>
                        <option value="video">Video</option>
                        <option value="other">Other</option>
                    </select>
				</div>
			</div>
            <div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Product Active</div>
				<div class="form-common-input">
					<input type="checkbox" class="textfield rounded" id="status" name="status" value="1" />
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
             <div class="grey-box">
				<div class="title-page">Product Brochure</div>
       		</div> 
            <div class="sub-title add-bottom-margin">
            	Add a downloadable PDF document that your customers will be able to download.<br />
            	File types accepted: (PDF, DOC, DOCX, PPT, MP4, AVI) <br />
				File size restriction: (None)
            </div>       
            <div>
				<div class="form-common-label">Upload Product Brochure</div>
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
            <button class="btn btn-info" type="submit">Create</button>
		</form>
        
        
        
	</div>
</div>

<script>
$j(function(){
	$j('.custom-select').selectpicker();
	
	toggle_product_collection();
	
	$j('#product_collection').on('change',function(){
		toggle_product_collection();
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