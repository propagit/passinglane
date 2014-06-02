<?php if($hero){ ?>
<img src="<?=base_url();?>uploads/products/<?=$dir;?>/thumb5/<?=$hero;?>" />
<?php }else{ ?>
<div class="no-image thumb"><i class="fa fa-picture-o"></i></div>
<?php } ?>