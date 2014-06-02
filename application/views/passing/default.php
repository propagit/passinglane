<!DOCTYPE html>
<html>
  <head>
    <title><?=$title;?></title>
    <meta name="keywords" content="<?=$keywords;?>" />
	<meta name="description" content="<?=$description;?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=base_url()?>assets/frontend-assets/passing/reset.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/bootstrap3/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/fontawesome4/css/font-awesome.css" rel="stylesheet" media="screen">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/frontend-assets/bootstrap/css/bootstrap-select.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/date-picker/css/datepicker.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/jQuery/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/css/ie.css" rel="stylesheet" media="screen">
    
    
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic|Oxygen:400,700,300' rel='stylesheet' type='text/css'>
	<script src="<?=base_url()?>assets/frontend-assets/jQuery/js/jquery-1.9.1.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/bootstrap3/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/bootstrap3/js/respond.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/bootstrap/js/bootstrap-select.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/bootstrap/js/bootstrap-fileupload.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/date-picker/js/bootstrap-datepicker.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/jQuery/js/jquery-ui-1.10.3.custom.js"></script>
    
    <script> var $j = jQuery.noConflict(); </script>
    <script> var base_url = '<?=base_url();?>';</script>
    
    <link href="<?=base_url()?>assets/frontend-assets/passing/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="<?=base_url()?>assets/frontend-assets/passing/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    
    <!--select2-->
	<link href="<?=base_url()?>assets/select2/css/select2.css" rel="stylesheet" media="screen">
	<script src="<?=base_url()?>assets/select2/js/select2.min.js"></script>
    
    <script src="<?=base_url()?>assets/frontend-assets/scripts/helper.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/scripts/cart.js"></script>
    <link href="<?=base_url()?>assets/frontend-assets/passing/frontend.css" rel="stylesheet" media="screen">
  </head>
  <body> 
	 
      <div>
         <?=$header;?>
         <?=$content;?>
         <?=$footer;?>
      </div>
  </body>
</html>
