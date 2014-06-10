<form id="customer-signup-form">
    <div class="form-group"><span class="col-sm-3 mandatory-label">* Denotes required field</span></div>
    <div class="form-group">
        <label for="email-address" class="col-sm-3 control-label">First Name *</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" data="required">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-3 control-label">Family Name *</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" data="required">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Email Address *</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="email" name="email" placeholder="" data="email">
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-3 control-label">Description *</label>
        <div class="col-sm-5">
            <select class="form-control custom-select" id="description" name="description" data="required">
            	<option value="">Please Select</option>
                <option value="VET Teacher">VET Teacher</option>
                <option value="Careers Teacher/Counsellor">Careers Teacher/Counsellor</option>
                <option value="Trainer">Trainer</option>
                <option value="Librarian">Librarian</option>
                <option value="Assessor">Assessor</option>
                <option value="Training Consultant">Training Consultant</option>
                <option value="Trainee/Student">Trainee/Student</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>
    <div id="description-other-wrap" class="form-group hidden">
    	<label for="description-other" class="col-sm-3 control-label">Description (other) *</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="description-other" name="description_other" placeholder="" maxlength="255">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-3 control-label">Password *</label>
        <div class="col-sm-5">
            <input type="password" class="form-control" id="password" name="password" placeholder="" data="required">
        </div>
    </div>
   <!-- <div class="form-group">
        <label for="repassword" class="col-sm-3 control-label">Retype Password *</label>
        <div class="col-sm-5">
            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="">
        </div>
    </div>-->
    <div class="form-group">
        <label for="company" class="col-sm-3 control-label">Company - School *</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="company" name="company" placeholder="" data="required">
        </div>
    </div>
    <div class="form-group">
        <label for="type" class="col-sm-3 control-label">Type *</label>
        <div class="col-sm-5">
            <select class="form-control custom-select" id="type" name="type" data="required">
            	<option value="">Please Select</option>
            	<option value="High School">High School</option>
                <option value="TAFE">TAFE</option>
                <option value="University">University</option>
                <option value="Registered Training Organisation (RTO)">Registered Training Organisation (RTO)</option>
                <option value="Government Department - State">Government Department - State</option>
                <option value="Government Department - Federal">Government Department - Federal</option>
                <option value="Employer">Employer</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>
    <div id="type-other-wrap" class="form-group hidden">
    	<label for="type-other" class="col-sm-3 control-label">Type (other) *</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="type-other" name="type_other" placeholder="" maxlength="255">
        </div>
    </div>
    <div class="form-group">
        <label for="telephone" class="col-sm-3 control-label">Telephone *</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="" data="required">
        </div>
    </div>
    <div class="form-group">
        <label for="facsimile" class="col-sm-3 control-label">Facsimile</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="facsimile" name="facsimile" placeholder="">
        </div>
    </div>
    <div class="form-group">
        <label for="address1" class="col-sm-3 control-label">Address1 *</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="address1" name="address1" placeholder="" data="required">
        </div>
    </div>
    <div class="form-group">
        <label for="address2" class="col-sm-3 control-label">Address2 </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="address2" name="address2" placeholder="">
        </div>
    </div>
    <div class="form-group">
        <label for="country" class="col-sm-3 control-label">Your Country *</label>
        <div class="col-sm-5">
            <select class="form-control custom-select" id="country" name="country" data="required">
            	<option value="13">Australia</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="state" class="col-sm-3 control-label">Your State *</label>
        <div class="col-sm-5">
            <select class="form-control custom-select" id="state" name="state" data="required">
            	<option value="">Please Select</option>
            	<?php if($states){ ?>
                <?php foreach($states as $state){ ?>
                	<option value="<?=$state['id'];?>"><?=$state['name'];?></option>
                <?php } ?>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="suburb" class="col-sm-3 control-label">Suburb *</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="suburb" name="suburb" placeholder="" data="required">
        </div>
    </div>
    <div class="form-group">
        <label for="postcode" class="col-sm-3 control-label">Postcode *</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="postcode" name="postcode" placeholder="" data="required" onkeypress="return help.check_numeric(this, event,'n');">
        </div>
    </div>
    <div class="form-group">
    	<div class="alert alert-danger hide add-gutters" id="msg-profile-creation-failed"><i class="fa fa-check"></i> &nbsp; This email already exist in our system. Please choose a different email and try again.</div>
        <div class="col-sm-5 col-sm-offset-3">
            <button id="create-customer" type="button" class="btn btn-primary pull"><i class="fa fa-plus-circle"></i> CREATE</button>
        </div>
    </div>
</form>

<script>
$j(function(){
	//init select2
	$j('.custom-select').select2();
	
	//toggle hidden form group when user selects other
	$j('#type').on('change',function(){
		toggle_other('type');	
	});
	$j('#description').on('change',function(){
		toggle_other('description');	
	});
	
	//form validate and submit	
	$j('#create-customer').click(function(){
		if(help.validate_form('customer-signup-form')){
			validate_other_fields();	
		} 
	});
	
});

function validate_other_fields()
{
	var valid = true;
	//other description
	if($j('#description').val() == 'other'){
		if(!$j('#description-other').val()){
			valid = false;
			$j('#description-other').parent().addClass('has-error');	
		}else{
			$j('#description-other').parent().removeClass('has-error');
		}
	}
	//other type
	if($j('#type').val() == 'other'){
		if(!$j('#type-other').val()){
			valid = false;
			$j('#type-other').parent().addClass('has-error');	
		}else{
			$j('#type-other').parent().removeClass('has-error');
		}
	}
	
	//repassword
	/* if($j('#password').val() != $j('#repassword').val()){
		valid = false;
		$j('#repassword').parent().addClass('has-error');	
	}else{
		$j('#repassword').parent().removeClass('has-error');
	} */
	
	if(valid){
		create_customer();	
	}
}

function create_customer()
{
	help.loading();
	$j.ajax({
	type: "POST",
	url: "<?=base_url();?>customer/ajax/create_new_customer",
	data: $j('#customer-signup-form').serialize(),
	success: function(html) {
		help.remove_loading();
		if(html == 'email exists'){
			$j('#msg-profile-creation-failed').removeClass('hide');
			setTimeout(function(){
				$j('#msg-profile-creation-failed').addClass('hide');
			}, 4000);
		
		}else if(html == 'success'){
			window.location.href = "<?=$redirect_after_login_url;?>";	
		}
	  }
	});	 
}

function toggle_other(element_id)
{
	if($j('#'+element_id).val() == 'other'){
		$j('#'+element_id+'-other-wrap').removeClass('hidden');	
	}else{
		$j('#'+element_id+'-other-wrap').addClass('hidden');		
	}
}

</script>