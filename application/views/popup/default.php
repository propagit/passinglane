<!DOCTYPE html>
<html>
  <head>
    <title><?=$title;?> &middot; Admin Portal</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=base_url()?>assets/backend-assets/bootstrap3/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/fontawesome4/css/font-awesome.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/bootstrap3/css/fileupload.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/css/backend.css" rel="stylesheet" media="screen">
    
  </head>
  <body>
  	
    <script src="<?=base_url()?>assets/backend-assets/jQuery/js/jquery-1.9.1.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/bootstrap3/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/bootstrap3/js/fileupload.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/jQuery/js/jquery-ui-1.10.3.custom.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/scripts/admin-helper.js"></script>


    <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900' rel='stylesheet' type='text/css'>

   	
    <div id="content">
    	<div class="container">
    	<?=$content?>
        </div>
    </div><!-- content -->
    
    <!-- footer -->


  </body>
</html>
