<?php
	  if($product_modules){
		  $modules = explode(';',$product_modules);
?>  
  <!--begin accordion -->
  <div class="my-accordion">
	  <h3 class="stitched">View Units Addressed/Qualifications Support <i class="fa fa-plus pull-right"></i></h3>   
	  <div class="accordion-item">
		  <ul>
			  <?php foreach($modules as $module) {?>
				  <li><span><?=trim($module);?></span></li>
			  <?php } ?>
		  </ul>
	  </div>
  </div>
<!-- end accordion -->
<?php } ?>


<?php if(0){ ?>
<!--
	fontawesome provides a custom list
	in future make use of the this
    below is an example of how to use that list
-->
<!--<ul class="fa-ul">
	<?php foreach($modules as $module) {?>
        <li><i class="fa-li fa fa-arrow-circle-right"></i> <?=trim($module);?></li>
    <?php } ?>
</ul>-->
<?php } ?>

<script>
$j(function(){
	help.my_accordion('.my-accordion');
});
</script>