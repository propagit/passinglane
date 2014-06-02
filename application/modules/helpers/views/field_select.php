<?php
/**  
	Field select will be generated based on following params
	
	$params['name'] => name of the select field	  		
	$params['id'] => id of the select field			 
	$params['class'] => css class
	$params['selected'] => selected field
	$params['no_null_selection'] => true or false - this will determine if the first option with default selection will be shown or not
	$params['first_option'] => first option
	$params['first_value'] => first value
	$params['options'] => array(	
								'label' => $label,
								'value' => $value
								)
	
*/

$name = isset($params['name']) ? $params['name'] : 'select_field';
$id = isset($params['id']) ? $params['id'] : '';
$class = isset($params['class']) ? $params['class'] : '';
$selected = isset($params['selected']) ? $params['selected'] : '';
$no_null_selection = isset($params['no_null_selection']) ? $params['no_null_selection'] : false;
$first_option = isset($params['first_option']) ? $params['first_option'] : 'Please Select';
$first_value = isset($params['first_value']) ? $params['first_value'] : '';
$options = isset($params['options']) ? $params['options'] : false;
?>


<select class="form-control custom-select <?=$class;?>" id="<?=$id;?>" name="<?=$name;?>">
	<?php if(!$no_null_selection){?>
    <option value="<?=$first_option;?>"><?=$first_value;?></option>
    <?php } ?>
    <?php 
	if($options){ 
		foreach($options as $option){
	?>
    	<option value="<?=$option['value'];?>" <?=($selected == $option['value'] || $selected == $option['label']) ? 'selected="selected"' : '';?>><?=$option['label'];?></option>	
    <?php }} ?>
</select>