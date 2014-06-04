<div id="top-table">
    <div class="push">
        <div id="top-table-title">Promotions <span id="total-count"><strong>[Total Records Found - <?=count($promotions);?>]</strong></span></div>
    </div>
    <ul class="pagination custom-pagination pull">

    </ul>
    <div style="clear: both"></div>
</div>

<?php if(count($promotions) > 0) { ?>
<div class="table-responsive">
    <table class="table custom-table">
        <thead>
            <tr>
                <th>Promotion Name <i class="fa fa-unsorted sort-results" sort-by="name"></i></th>
                <th width="150">Type <i class="fa fa-unsorted sort-results" sort-by="applied_on"></i></th>
                <th width="120">Status <i class="fa fa-unsorted sort-results" sort-by="order_status"></i></th>
                <th width="100" class="center">View</th>
                <th width="100" class="center">Delete</th>
            </tr>
        </thead>
        <tbody>
        <? foreach($promotions as $p) { ?>
        <tr>
            <td><?=$p['name'];?></td>
            <td><?=ucwords($p['promotion_type']);?></td>
            <td>
                <? if($p['status'] == PROMOTION_ACTIVED) { ?>
                    Actived
                <? } else { ?>
                    Disabled
                <? } ?>
            </td>
            <td class="center">
                <a href="<?=base_url();?>admin/promotion/edit/<?=$p['promotion_id'];?>"><i class="fa fa-search"></i></a></td>
            <td class="center">
                <a onclick="delete_promotion(<?=$p['promotion_id'];?>)"><i class="fa fa-trash-o"></i></a></td>
            </tr>
        <? } ?>
        </tbody>
    </table>
</div>
<? } ?>
<script>
function delete_promotion(promotion_id) {
    help.confirm_delete('Delete promotion', 'Are you sure you want to delete this promotion?', function(){
            $j.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/promotion/ajax/delete_promotion",
                data: {promotion_id: promotion_id},
                success: function(html) {
                    search_promotions();
                }
            })
    });
}
</script>
