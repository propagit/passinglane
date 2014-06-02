<div class="form-group"><span class="col-sm-10 remove-right-gutter mandatory-label">* Denotes required field</span></div>
<div class="form-group">
    <label for="delivery-name" class="col-sm-4 remove-right-gutter control-label">Delivery Name *</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="delivery-name" name="delivery_name" placeholder="" data="required" value="<?=(isset($customer['firstname']) && isset($customer['lastname']) ? $customer['firstname'] .' '.$customer['lastname'] : '');?>">
    </div>
</div>
<div class="form-group">
    <label for="telephone" class="col-sm-4 remove-right-gutter control-label">Telephone *</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="" data="required" value="<?=(isset($customer['phone']) ? $customer['phone'] : '');?>">
    </div>
</div>
<div class="form-group">
    <label for="address1" class="col-sm-4 remove-right-gutter control-label">Address1 *</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="address1" name="address1" placeholder="" data="required" value="<?=(isset($customer['address']) ? $customer['address'] : '');?>">
    </div>
</div>
<div class="form-group">
    <label for="address2" class="col-sm-4 remove-right-gutter control-label">Address2 </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="address2" name="address2" placeholder="" value="<?=(isset($customer['address2']) ? $customer['address2'] : '');?>">
    </div>
</div>
<div class="form-group">
    <label for="country" class="col-sm-4 remove-right-gutter control-label">Your Country *</label>
    <div class="col-sm-8">
        <select class="form-control custom-select" id="country" name="country" data="required">
            <option value="13">Australia</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="state" class="col-sm-4 remove-right-gutter control-label">Your State *</label>
    <div class="col-sm-8">
        <select class="form-control custom-select" id="state" name="state" data="required">
            <option value="">Please Select</option>
            <?php if($states){ ?>
            <?php foreach($states as $state){ ?>
                <option value="<?=$state['id'];?>" <?=(isset($customer['state']) ? ($customer['state'] == $state['id'] ? 'selected="selected"' : '') : '');?>><?=$state['name'];?></option>
            <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="suburb" class="col-sm-4 remove-right-gutter control-label">Suburb *</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="suburb" name="suburb" placeholder="" data="required" value="<?=(isset($customer['suburb']) ? $customer['suburb'] : '');?>">
    </div>
</div>
<div class="form-group">
    <label for="postcode" class="col-sm-4 remove-right-gutter control-label">Postcode *</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="postcode" name="postcode" placeholder="" data="required" onkeypress="return cart.check_numeric(this, event,'n');" value="<?=(isset($customer['postcode']) ? $customer['postcode'] : '');?>">
    </div>
</div>


