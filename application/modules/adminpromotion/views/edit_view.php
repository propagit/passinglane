<div class="row row-bottom-margin">
    <div class="col-md-12">

        <div class="title-page">Edit Promotion</div>
        <div class="grey-box">
            <a class="btn btn-info" href="<?=base_url()?>admin/promotion">
                <i class="fa fa-arrow-left"></i> Back To Promotion List</a>
        </div>

        <!-- Nav tabs -->
        <div class="pull-right">
            <span id="update-msg"></span> &nbsp;
            <button class="btn btn-default" onclick="update_promotion()"><i class="fa fa-save"></i> Update Promotion</button>
        </div>


        <ul class="nav nav-tabs" id="proTab">
            <li class="active"><a href="#general" data-toggle="tab">General</a></li>
            <li><a href="#conditions" data-toggle="tab">Conditions</a></li>
        </ul>
        <br />
        <!-- Tab panes -->
        <form id="update-promotion-form">
        <input type="hidden" name="promotion_id" value="<?=$promotion['promotion_id'];?>" />
        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <div id="create-catalog-promotion-form">
                    <div class="form-common-label">Name</div>
                    <div class="form-common-input">
                        <input type="text" class="form-control input-text" name="name" value="<?=$promotion['name'];?>" />
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label">Description</div>
                    <div class="form-common-input">
                        <textarea class="form-control input-text" name="description" rows="3"><?=$promotion['description'];?></textarea>
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label">Discount type:</div>
                    <div class="form-common-input">
                        <select name="discount_type" class="custom-select pull-left">
                            <option value="percentage"<?=($promotion['discount_type'] == 'percentage') ? ' selected="selected"' : ''; ?>>Percentage</option>
                            <option value="fixed"<?=($promotion['discount_type'] == 'fixed') ? ' selected="selected"' : ''; ?>>Fixed Amount</option>
                        </select>
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label">Discount value:</div>
                    <div class="form-common-input">
                        <div class="input-group" id="discount_fixed">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" name="discount_value[fixed]" value="<?=($promotion['discount_type'] == 'fixed') ? $promotion['discount_value'] : ''; ?>" />

                        </div>
                        <div class="input-group" id="discount_percentage">
                            <input type="text" class="form-control" name="discount_value[percentage]" value="<?=($promotion['discount_type'] == 'percentage') ? $promotion['discount_value'] : ''; ?>" />
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label">Use Valid period:</div>
                    <div class="form-common-input">
                        <input type="checkbox" class="textfield rounded" name="valid_period"<?=($promotion['valid_period']) ? ' checked' : ''; ?> /> &nbsp;
                        (If not ticked, this promotion will be valid as long as it is actived)
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label">Valid from:</div>
                    <div class="form-common-input">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control date-picker" name="date_from" value="<?=($promotion['valid_period']) ? date('m/d/Y', strtotime($promotion['date_from'])) : ''; ?>" style="width:auto;" />

                        </div>
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label">Valid to:</div>
                    <div class="form-common-input">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control date-picker" name="date_to" value="<?=($promotion['valid_period']) ? date('m/d/Y', strtotime($promotion['date_to'])) : ''; ?>" style="width:auto;">

                        </div>
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label">Status:</div>
                    <div class="form-common-input">
                        <select name="status" class="custom-select">
                            <option value="<?=PROMOTION_ACTIVED;?>">Active</option>
                            <option value="<?=PROMOTION_DISABLED;?>"<?=(!$promotion['status']) ? ' selected="selected"' : ''; ?>>Disabled</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="conditions">
                <div>
                    <div class="form-common-label">Promotion Type:</div>
                    <div class="form-common-input">
                        <select name="promotion_type" class="custom-select pull-left">
                            <option value="cart">Cart Order</option>
                            <option value="catalog"<?=($promotion['promotion_type'] == 'catalog') ? ' selected="selected"' : ''; ?>>Product Catalog</option>
                        </select>

                        <span class="help-block pull-left">&nbsp; Change of promotion type will affect the promotion conditions.</span>
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div id="list-conditions"></div>
                <div>
                    <div class="form-common-label">Select Condition:</div>
                    <div class="form-common-input">
                        <select name="condition_type" class="custom-select">
                        <? if($promotion['promotion_type'] == 'catalog') { ?>
                            <option value="product">Products</option>
                            <option value="customer">Customer</option>
                        <? } else { ?>
                            <option value="order">Order Subtotal</option>
                            <option value="coupon">Coupon code</option>
                        <? } ?>
                        </select>
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label"></div>
                    <div class="form-common-input">
                        <button class="btn btn-default" type="button" onclick="add_condition()"><i class="fa fa-plus"></i> Add condition</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<script>
$j(function () {
    if (window.location.hash == '#conditions') {
        $j('#proTab a:last').tab('show');
    }

    //init datepicker
    $j('.date-picker').datepicker({
        format: 'mm/dd/yyyy'
    });
    $j('.custom-select').selectpicker();
    check_discount_type();
    $j('select[name="discount_type"]').change(function(){
        check_discount_type();
    });
    check_valid_period();
    $j('input[name="valid_period"]').click(function(){
        check_valid_period();
    });
    list_conditions();
    $j('select[name="promotion_type"]').change(function(){
        $j.ajax({
            type: "POST",
            url: "<?=base_url();?>admin/promotion/ajax/reset_conditions",
            data: $j("#update-promotion-form").serialize(),
            success: function(html) {
                window.location.href = "<?=base_url();?>admin/promotion/edit/<?=$promotion['promotion_id'];?>#conditions";
                location.reload();
            }
        })
    })
});
function check_valid_period() {
    var valid_period = $j('input[name="valid_period"]').is(':checked');
    if(valid_period) {
        $j('.date-picker').prop('disabled', false);
    } else {
        $j('.date-picker').prop('disabled', true);
    }
}
function check_discount_type() {
    var discount_type = $j('select[name="discount_type"]').val();
    if (discount_type == 'percentage') {
        $j('#discount_percentage').show();
        $j('#discount_fixed').hide();
    } else {
        $j('#discount_fixed').show();
        $j('#discount_percentage').hide();
    }
}
function update_promotion() {
    $j.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/promotion/ajax/update_promotion",
        data: $j("#update-promotion-form").serialize(),
        success: function(html) {
            if (html == 'true') {
                $j('#update-msg').html('<span class="text-success"><i class="fa fa-check"></i> Updated successfully!</span>');
            } else {
                $j('#update-msg').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> ' + html + '</span>');
            }
            list_conditions();
            setTimeout(function(){
                $j('#update-msg').html('');
            }, 2000);
        }
    })
}
function add_condition() {
    var condition_type = $j('select[name="condition_type"]').val();
    var promotion_id = $j('input[name="promotion_id"]').val();
    $j.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/promotion/ajax/add_condition",
        data: {promotion_id: promotion_id, condition_type: condition_type},
        success: function(html) {
            list_conditions();
        }
    })
}
function list_conditions() {
    var promotion_id = $j('input[name="promotion_id"]').val();
    $j.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/promotion/ajax/list_conditions",
        data: {promotion_id: promotion_id},
        success: function(html) {
            $j('#list-conditions').html(html);
        }
    })
}
function delete_condition(condition_id) {
    help.confirm_delete('Delete condition', 'Are you sure you want to delete this condition?', function(){
            $j.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/promotion/ajax/delete_condition",
                data: {condition_id: condition_id},
                success: function(html) {
                    list_conditions();
                }
            })
    });
}
</script>
