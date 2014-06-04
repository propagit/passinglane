<div>
    <div class="form-common-label">Coupon code</div>
    <div class="form-common-input">
        <div class="pull-right" style="margin-left:10px;">
            <a class="fa-stack fa-lg" onclick="delete_condition(<?=$condition['condition_id'];?>)">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-times fa-stack-1x fa-inverse"></i>
            </a>
        </div>
        <div class="input-group pull-left" style="margin-right: 10px;">
            <input type="text" class="form-control" name="conditions[<?=$condition['condition_id'];?>]" value="<?=$condition['value'];?>" />
        </div>
        <div class="input-group">
            <span class="input-group-addon">Usage: <?=$condition['actual_usages'];?> /</span>
            <input type="text" class="form-control" name="usages[<?=$condition['condition_id'];?>]" value="<?=$condition['allowed_usages'];?>" onkeypress="return help.check_numeric(this, event,'nd');" />
        </div>
    </div>
</div>
<div class="form-common-gap">&nbsp;</div>
