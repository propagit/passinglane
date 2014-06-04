<div class="table-responsive">
    <table class="table table-condensed">
        <tbody>
            <? foreach($products as $product) {
                $checked = false;
                if ($condition['value']) {
                    $checked = in_array($product['id'], unserialize($condition['value']));
                }
                ?>
            <tr>
                <td width="38" class="center">
                    <input type="checkbox" class="selected_product_<?=$condition['condition_id'];?>" name="conditions[<?=$condition['condition_id'];?>][]" value="<?=$product['id'];?>" <?=($checked) ? ' checked' : '';?> />
                </td>
                <td><a href="<?=base_url();?>admin/product/details/<?=$product['id'];?>" target="_blank"><?=$product['title'];?></a></td>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>
<script>
$j(function(){
    $('#all_selected_<?=$condition['condition_id'];?>').click(function(){
        $('input.selected_product_<?=$condition['condition_id'];?>').prop('checked', this.checked);
    });
})
</script>
