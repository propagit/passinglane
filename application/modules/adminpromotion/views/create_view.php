<div class="row row-bottom-margin">
    <div class="col-md-12">

        <div class="title-page">Create New Promotion</div>
        <div class="grey-box">
            <a class="btn btn-info" href="<?=base_url()?>admin/promotion">
                <i class="fa fa-arrow-left"></i> Back To Promotion List</a>
        </div>

        <!-- Nav tabs -->
        <button class="btn btn-default pull-right" onclick="create_promotion()"><i class="fa fa-plus"></i> Create Promotion</button>
        <ul class="nav nav-tabs" id="proTab">
            <li class="active"><a href="#general" data-toggle="tab">General</a></li>
            <li class="disabled"><a>Conditions</a></li>
        </ul>
        <br />
        <!-- Tab panes -->
        <form id="create-promotion-form">
        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <div>
                    <div class="form-common-label">Promotion Type:</div>
                    <div class="form-common-input">
                        <select name="promotion_type" class="custom-select">
                            <option value="cart">Cart Order</option>
                            <option value="catalog">Product Catalog</option>
                        </select>
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div id="create-catalog-promotion-form">
                    <div class="form-common-label">Name</div>
                    <div class="form-common-input" id="f_name">
                        <input type="text" class="form-control input-text" name="name" />
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label">Description</div>
                    <div class="form-common-input">
                        <textarea class="form-control input-text" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label">Discount type:</div>
                    <div class="form-common-input">
                        <select name="discount_type" class="custom-select pull-left">
                            <option value="percentage">Percentage</option>
                            <option value="fixed">Fixed Amount</option>
                        </select>
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label">Discount value:</div>
                    <div class="form-common-input">
                        <div class="input-group" id="discount_fixed">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" name="discount_value[fixed]" />

                        </div>
                        <div class="input-group" id="discount_percentage">
                            <input type="text" class="form-control" name="discount_value[percentage]" />
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label">Use Valid period:</div>
                    <div class="form-common-input">
                        <input type="checkbox" class="textfield rounded" name="valid_period" /> &nbsp;
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
                            <input type="text" class="form-control date-picker" name="date_from" style="width:auto;" />

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
                            <input type="text" class="form-control date-picker" name="date_to" style="width:auto;">

                        </div>
                    </div>
                </div>
                <div class="form-common-gap">&nbsp;</div>
                <div>
                    <div class="form-common-label">Status:</div>
                    <div class="form-common-input">
                        <select name="status" class="custom-select">
                            <option value="<?=PROMOTION_ACTIVED;?>">Active</option>
                            <option value="<?=PROMOTION_DISABLED;?>">Disabled</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        </form>



    </div>
</div>

<script>
$j(function () {
    //init datepicker
    $j('.date-picker').datepicker({
        format: 'dd/mm/yyyy'
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
function add_condition() {
    var condition_type = $j('select[name="condition_type"]').val();
    $j.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/promotion/ajax/add_condition",
        data: {condition_type: condition_type},
        success: function(html) {
            alert(html);
        }
    })
}
function create_promotion() {
    $j.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/promotion/ajax/create_promotion",
        data: $j("#create-promotion-form").serialize(),
        success: function(html) {
            window.location = "<?=base_url();?>admin/promotion/edit/" + html + '#conditions';
        }
    })
}
</script>
