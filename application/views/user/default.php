<!DOCTYPE html>
<html>
  <head>
    <title><?=$title;?></title>
    <meta name="keywords" content="<?=$keywords;?>" />
	<meta name="description" content="<?=$description;?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=base_url()?>assets/frontend-assets/bootstrap3/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/fontawesome4/css/font-awesome.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/bootstrap/css/bootstrap-select.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/date-picker/css/datepicker.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/css/frontend.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/jQuery/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/css/ie.css" rel="stylesheet" media="screen">
    
    
	<script src="<?=base_url()?>assets/frontend-assets/jQuery/js/jquery-1.9.1.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/bootstrap3/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/bootstrap3/js/respond.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/bootstrap/js/bootstrap-select.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/bootstrap/js/bootstrap-fileupload.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/date-picker/js/bootstrap-datepicker.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/jQuery/js/jquery-ui-1.10.3.custom.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/scripts/helper.js"></script>
    
    <script> var $j = jQuery.noConflict(); </script>
  </head>
  <body> 
	  <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-48995514-1', 'wave1.com.au');
      ga('send', 'pageview');
    
      </script>
      <div>
         <?=$header;?>
         <?=$content;?>
         <?=$footer;?>
      </div>
  </body>
</html>
