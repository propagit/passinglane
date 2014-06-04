<div class="row row-bottom-margin">
    <div class="col-md-12">

        <div class="title-page">Manage Promotions</div>
        <div class="sub-title">
            Promote products and offer discounts basing on customers memberships or order amount or special events.
        </div>
        <br />
        <a class="btn btn-info" href="<?=base_url();?>admin/promotion/create"><i class="fa fa-plus"></i> Create New Promotion</a>

        <div class="grey-box">
            <div class="title-page">Search Promotions</div>
        </div>

        <form id="search-promotions-form" class="form-horizontal custom-form" role="form">
        <div class="form-group">
            <label class="col-sm-2 control-label">Keyword</label>
            <div class="col-sm-3">
                <input type="text" class="form-control search-frm-input" name="keyword" placeholder="Promotion Name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Date From</label>
            <div class="col-sm-2">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" class="form-control date-picker" name="date_from">
                </div>
            </div>
            <label class="control-label col-sm-50">Date To</label>
            <div class="col-sm-2">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" class="form-control date-picker" name="date_to">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Order Status</label>
            <div class="col-sm-3">
                <select name="status" class="custom-select">
                    <option value="<?=PROMOTION_ACTIVED;?>">Active</option>
                    <option value="<?=PROMOTION_DISABLED;?>">Disabled</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-3">
                <button type="button" class="btn btn-info" onclick="search_promotions()"><i class="fa fa-search"></i> Search Promotions</button>
            </div>
        </div>
        </form>
        <div id="promotion-search-results"></div>
    </div>
</div>
<script>
$j(function(){
    //init selectpicker
    $j('.custom-select').selectpicker();

    //init datepicker
    $j('.date-picker').datepicker({});
    search_promotions();
});
function search_promotions() {
    $j.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/promotion/ajax/search_promotions",
        data: $j("#search-promotions-form").serialize(),
        success: function(html) {
            $j('#promotion-search-results').html(html);
        }
    })
}
</script>
