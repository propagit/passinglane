<div>
    <div class="form-common-label">Order subtotal (Equal or Greater)</div>
    <div class="form-common-input">
        <div class="pull-right" style="margin-left:10px;">
            <a class="fa-stack fa-lg" onclick="delete_condition(<?=$condition['condition_id'];?>)">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-times fa-stack-1x fa-inverse"></i>
            </a>
        </div>
        <div class="input-group">
            <span class="input-group-addon">$</span>
            <input type="text" class="form-control" name="conditions[<?=$condition['condition_id'];?>]" value="<?=$condition['value'];?>" onkeypress="return help.check_numeric(this, event,'nd');" />
        </div>
    </div>
</div>
<div class="form-common-gap">&nbsp;</div>
