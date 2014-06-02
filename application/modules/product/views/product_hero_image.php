<?php if($hero){ ?>
<img src="<?=base_url();?>uploads/products/<?=$dir;?>/<?=$hero;?>" />
<?php }else{ ?>
<div class="no-image"><i class="fa fa-picture-o"></i></div>
<?php } ?>