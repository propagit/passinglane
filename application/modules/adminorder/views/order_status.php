<?=ucwords($status);?>
<? if ($status == "not paid") { ?>
<span class="mark-paid" data-toggle="tooltip" title="Mark as Paid" style="cursor: pointer" onclick="mark_as_paid(<?=$order_id;?>)">
	<i class="fa fa-thumbs-o-down"></i>
</span>
<? } else { ?>
<span class="mark-paid" data-toggle="tooltip" title="Mark as Not Paid" style="cursor: pointer" onclick="mark_as_not_paid(<?=$order_id;?>)">
	<i class="fa fa-thumbs-o-up"></i>
</span>
<? } ?>
<script>

jQuery(function() {
	$j('.mark-paid').tooltip({
		showURL: false
	});
});
</script>