<div>
    <div class="form-common-label">Product</div>
    <div class="form-common-input">
        <div class="pull-right" style="margin-left:10px;">
            <a class="fa-stack fa-lg" onclick="delete_condition(<?=$condition['condition_id'];?>)">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-times fa-stack-1x fa-inverse"></i>
            </a>
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <input type="checkbox" id="all_selected_<?=$condition['condition_id'];?>" />
            </span>
            <input type="text" class="form-control" value="All Products" disabled>
        </div><!-- /input-group -->
    </div>
</div>
<div class="form-common-gap">&nbsp;</div>
<div>
    <div class="form-common-label"></div>
    <div class="form-common-input c-prod-list" id="c<?=$condition['condition_id'];?>-prod-list">
    </div>
</div>
<div class="form-common-gap">&nbsp;</div>

<script>
$j(function(){
    $j.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/promotion/ajax_product/list_products",
        data: {condition_id: <?=$condition['condition_id'];?>},
        success: function(html) {
            $j('#c<?=$condition['condition_id'];?>-prod-list').html(html);
        }
    })
})
</script>
