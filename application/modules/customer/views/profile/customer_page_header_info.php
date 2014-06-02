<?php
	if(isset($customer) && $customer){
?>
	<a href="<?=base_url();?>customer/profile" class="white-link"><?=$customer['firstname'].' '.$customer['lastname'];?></a> | <a href="<?=base_url();?>customer/logout" class="white-link">LOGOUT</a>
<?php		
	}else{
?>
	<a href="<?=base_url();?>customer/sign_in" class="white-link">Guest</a>
<?php } ?>