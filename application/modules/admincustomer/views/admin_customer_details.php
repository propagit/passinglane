

<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div class="title-page">EDIT CUSTOMER</div>
        <div class="sub-title">Upload new customer or edit and manage existing customers.</div>
		<div class="grey-box">
        	<button class="btn btn-info" onclick="window.location = '<?=base_url()?>admin/customer';"><i class="fa fa-hand-o-left"></i> To Customer List</button>
        </div>
        
		
		<form enctype="multipart/form-data" method="post" action="<?=base_url()?>admin/customer/update" autocomplete="off" id="customer-admin-add">
		<div class="row">
			<div class="col-md-10">
				
					<input type="hidden" name="id" value="<?=$user['id']?>"/>
					<div>
						<div class="form-common-label">First Name <span style="color:#F00">*</span></div>
						<div class="form-common-input">
							<input type="text" class="form-control input-text" id="firstname" name="firstname" data="required"  value="<?=$customer['firstname']?>"/>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Last Name <span style="color:#F00">*</span></div>
						<div class="form-common-input">
							<input type="text" class="form-control input-text" id="lastname" name="lastname" data="required" value="<?=$customer['lastname']?>"/>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					
					<div>
						<div class="form-common-label">Email Address <span style="color:#F00">*</span></div>
						<div class="form-common-input">
							<input class="pc_txt form-control input-text" readonly="readonly" value="<?=$customer['email']?>" id="email" name="email" />
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Phone Number</div>
						<div class="form-common-input">
							<input value="<?=$customer['phone']?>" type="text" class="form-control input-text" id="phone" name="phone"/>
						</div>
					</div>
                    <div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Fax</div>
						<div class="form-common-input">
							<input value="<?=$customer['fax'];?>" type="text" class="form-control input-text" id="fax" name="fax"/>
						</div>
					</div>
		            <div class="form-common-gap">&nbsp;</div>					
					<div>
						<div class="form-common-label">Address 1</div>
						<div class="form-common-input">
							<input value="<?=$customer['address']?>" type="text" class="form-control input-text" id="address" name="address"/>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Address 2</div>
						<div class="form-common-input">
							<input value="<?=$customer['address2']?>" type="text" class="form-control input-text" id="address2" name="address2"/>
						</div>
					</div>
                    <div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Description</div>
						<div class="form-common-input">
							<select id="description" name="description" class="custom-select">
                                <option value="other">Other</option>
                                <option value="VET Teacher" <?=$customer['description'] == 'VET Teacher' ? 'selected="selected"' : '';?>>VET Teacher</option>
                                <option value="Careers Teacher/Counsellor" <?=$customer['description'] == 'Careers Teacher/Counsellor' ? 'selected="selected"' : '';?>>Careers Teacher/Counsellor</option>
                                <option value="Trainer" <?=$customer['description'] == 'Trainer' ? 'selected="selected"' : '';?>>Trainer</option>
                                <option value="Librarian" <?=$customer['description'] == 'Librarian' ? 'selected="selected"' : '';?>>Librarian</option>
                                <option value="Assessor" <?=$customer['description'] == 'Assessor' ? 'selected="selected"' : '';?>>Assessor</option>
                                <option value="Training Consultant" <?=$customer['description'] == 'Training Consultant' ? 'selected="selected"' : '';?>>Training Consultant</option>
                                <option value="Trainee/Student" <?=$customer['description'] == 'Trainee/Student' ? 'selected="selected"' : '';?>>Trainee/Student</option>
                            </select>
						</div>
					</div>
                    <div id="description-other-wrap" class="hidden">
                    	<div class="form-common-gap">&nbsp;</div>
                        <div>
                            <div class="form-common-label">Description (other)</div>
                            <div class="form-common-input">
                                <input value="<?=$customer['description']?>" type="text" class="form-control input-text" id="description-other" name="description_other"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Company</div>
						<div class="form-common-input">
							<input value="<?=$customer['company']?>" type="text" class="form-control input-text" id="address2" name="address2"/>
						</div>
					</div>
                    <div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Type</div>
						<div class="form-common-input">
							<select id="type" name="type" class="custom-select">
                            	<option value="other">Other</option>
                                <option value="High School" <?=$customer['type'] == 'High School' ? 'selected="selected"' : '';?>>High School</option>
                                <option value="TAFE" <?=$customer['type'] == 'TAFE' ? 'selected="selected"' : '';?>>TAFE</option>
                                <option value="University" <?=$customer['type'] == 'University' ? 'selected="selected"' : '';?>>University</option>
                                <option value="Registered Training Organisation (RTO)" <?=$customer['type'] == 'Registered Training Organisation (RTO)' ? 'selected="selected"' : '';?>>Registered Training Organisation (RTO)</option>
                                <option value="Government Department - State" <?=$customer['type'] == 'Government Department - State' ? 'selected="selected"' : '';?>>Government Department - State</option>
                                <option value="Government Department - Federal" <?=$customer['type'] == 'Government Department - Federal' ? 'selected="selected"' : '';?>>Government Department - Federal</option>
                                <option value="Employer" <?=$customer['type'] == 'Employer' ? 'selected="selected"' : '';?>>Employer</option>
                            </select>
						</div>
					</div>
                    <div id="type-other-wrap" class="hidden">
                    	<div class="form-common-gap">&nbsp;</div>
                        <div>
                            <div class="form-common-label">Type (other)</div>
                            <div class="form-common-input">
                                <input value="<?=$customer['type']?>" type="text" class="form-control input-text" id="type-other" name="type_other"/>
                            </div>
                        </div>
                    </div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">State</div>
						<div class="form-common-input">
							<input name="state" id="state" type="hidden" value="<?=$customer['state']?>">
							<?
							$state = $this->lookup_model->get_state($customer['state']);
							?>
							<input class="pc_txt form-control input-text" type="text" id="search_state" name="search_state" onblur="if(this.value==''){this.value='enter state';}" onfocus="if (this.value=='enter state'){this.value='';} lookup.load_state();" onclick="if (this.value=='enter state'){this.value='';}" value="<?=$state?>" onkeyup="lookup.load_state();" />
			
			                <div class="lookup-list" id="ajax_lookup_state_list"></div>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Suburb</div>
						<div class="form-common-input">
                        	<input class="pc_txt form-control input-text" type="text" name="suburb" id="suburb"  value="<?=$customer['suburb']?>">
						</div>
					</div>
					
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Country</div>
						<div class="form-common-input">
							<input name="country" id="country" type="hidden" value="<?=$customer['country']?>">
							<?
							$country = $this->lookup_model->get_country($customer['country']);
							?>
							<input class="pc_txt form-control input-text" type="text" id="search_country" name="search_country" onblur="if(this.value==''){this.value='Australia';}" onfocus="if (this.value=='Australia'){this.value='';} lookup.load_country();" onclick="if (this.value=='Australia'){this.value='';}" value="<?=$country;?>" onkeyup="lookup.load_country();" />
			
			                <div class="lookup-list" id="ajax_lookup_country_list"></div>
		                	
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Postcode</div>
						<div class="form-common-input">
							<input value="<?=$customer['postcode']?>" readonly="readonly" type="text" class="form-control input-text" id="postcode" name="postcode"/>
						</div>
					</div>
		            <div class="form-common-gap">&nbsp;</div>
					
					<div>
						<div class="form-common-label">Username</div>
						<div class="form-common-input" style="line-height: 30px;">
							<span id="email-copy"><?=$customer['email']?></span>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Password</div>
						<div class="form-common-input">
							<input type="password" class="form-control input-text" id="password" name="password"/>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">30 Day Trading Account</div>
						<div class="form-common-input">
							<input type="checkbox" name="is_trading" <?=($customer['is_trading']) ? ' checked' : '';?> />
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">&nbsp;</div>
						<div class="form-common-input">
							<button class="btn btn-info" type="button" onclick="help.validate_form('customer-admin-add');"><i class="fa fa-plus"></i> Save</button>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					
				
			</div>
			
			
		</div>
		</form>

		
	</div>
</div>
<script>
$(function(){
	$j('.custom-select').selectpicker();
	
	//toggle hidden form group when user selects other
	$j('#type').on('change',function(){
		toggle_other('type');	
	});
	$j('#description').on('change',function(){
		toggle_other('description');	
	});
	
	toggle_other('type');
	toggle_other('description');	
	
});

function toggle_other(element_id)
{
	if($j('#'+element_id).val() == 'other'){
		$j('#'+element_id+'-other-wrap').removeClass('hidden');	
	}else{
		$j('#'+element_id+'-other-wrap').addClass('hidden');		
	}
}

function email_copy()
{
	var email = $('#email').val();
	$('#email-copy').html(email);
}

var lookup = {
    //load suburbs
    load_suburbs:function(){
        var entered_keyword = jQuery('#search_suburb').val();
        var state = jQuery('#state').val();
        if(entered_keyword){
            if(entered_keyword.length >= 3){
                jQuery.ajax({
                    type:'post',
                    url:'<?=base_url();?>admin/customer/ajax/suburbs_search',
                    data:{keyword:entered_keyword,state:state},
                    success:function(html){
                                    jQuery('#ajax_lookup_suburb_list').html(html).show();
                    },error:function(){
                                    //error message
                    }
                });          
            }
        }
    },

    //Select Suburb
    select_suburb:function(postcode_id,postcode,suburb_details){
		if(postcode_id){
            jQuery('#search_suburb').val(suburb_details);
            //jQuery('#postcode_id').val(postcode_id);     
            //hide ajax_pc_sub_list box
            jQuery('#suburb').val(postcode_id);
            jQuery('#ajax_lookup_suburb_list').hide();
            jQuery('#postcode').val(postcode);
	    }
    },
    
    load_state:function(){
        var entered_keyword = jQuery('#search_state').val();
        if(entered_keyword){
            if(entered_keyword.length >= 3){
                jQuery.ajax({
                    type:'post',
                    url:'<?=base_url();?>admin/customer/ajax/state_search',
                    data:{keyword:entered_keyword},
                    success:function(html){
                                    jQuery('#ajax_lookup_state_list').html(html).show();
                    },error:function(){
                                    //error message
                    }
                });          
            }
        }
    },

    //Select Suburb
    select_state:function(state_id,state_details){
		if(state_id){
            jQuery('#search_state').val(state_details);
            //jQuery('#postcode_id').val(postcode_id);     
            //hide ajax_pc_sub_list box
            jQuery('#state').val(state_id);
            jQuery('#ajax_lookup_state_list').hide();
	    }
    },
    
    load_country:function(){
        var entered_keyword = jQuery('#search_country').val();
        if(entered_keyword){
            if(entered_keyword.length >= 3){
                jQuery.ajax({
                    type:'post',
                    url:'<?=base_url();?>admin/customer/ajax/country_search',
                    data:{keyword:entered_keyword},
                    success:function(html){
                                    jQuery('#ajax_lookup_country_list').html(html).show();
                    },error:function(){
                                    //error message
                    }
                });          
            }
        }
    },

    //Select Suburb
    select_country:function(country_id,country_details){
		if(country_id){
            jQuery('#search_country').val(country_details);
            //jQuery('#postcode_id').val(postcode_id);     
            //hide ajax_pc_sub_list box
            jQuery('#country').val(country_id);
            jQuery('#ajax_lookup_country_list').hide();
	    }
    }
};

function copy_email_to_username()
{
	var email = $('#email').val();
	$('#email-copy').html(email);
}

</script>
