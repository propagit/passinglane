<?php $cur_page = $this->uri->segment(1); ?>
<div class="header-wrap">
    <div class="container">
        <div class="row" >
            <div class="col-xs-6 logo-wrap">
                <a href="<?=base_url();?>"><img class="logo" src="<?=base_url();?>assets/frontend-assets/passing/logo.png" alt="logo"></a>
            </div>
            <div class="col-xs-6">
            	<div class="right-side">
                	<div class="login_text right10">LOGGED IN AS: </div><div class="login_text"><?=modules::run('customer/customer_header_info');?></div>
                </div>
                <div class="clear"></div>
                <div class="wrap-header-button">
                	<div class="header-text-button">SEARCH </div>
                    <div class="header-button"> <a href="#" id="username" class="white-link" style="text-decoration:none; border-bottom:none!important;" data-type="text" data-pk="1" data-url="/post"><i class="fa fa-search"></i> </a></div>
                	<a href="<?=base_url();?>cart"><div class="header-text-button">CART </div><div class="header-button" id="header-cart-item-count"><i class="fa fa-spinner fa-spin"></i></div></a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="row nav-wrap nomarginleft">

            <div class="col-xs-12 addpadding">
                <ul class="nav nav-pills fullwidth">                	
                    
                    <?php
                	foreach($nav as $n)
					{
						$nurl = '#';
						if($n['page'] != 0)
						{
							$id_title = $this->nav_model->get_page_id_title_by_id($n['page']);
							$nurl = base_url().'page/'.$id_title;
						}
						else 
						{
							if($n['url'] != '')
							{
								$nurl = $n['url'];
							}
						}
						
						$links = $this->nav_model->get_all_links($n['id']);
                    ?>
                    
                    <li>
						<?php
                        if($links)
                        {
                        ?>
                            <a <? if($n['id'] == 1) {echo "href='".base_url()."'";}else{echo "href='".$nurl."'";}?> ><?=strtoupper($n['name'])?></a>
                            <ul class="dropdown-menu desktop-menu">                                
                                <?php
                                $ttl = count($links) - 1;
                                $i = 0;
                                foreach($links as $l)
                                {
                                    $url = '#';
                                    if($l['page'] != 0 )
                                    {
                                        $id_title = $this->nav_model->get_page_id_title_by_id($l['page']);
                                        $url = base_url().'page/'.$id_title;                                       
                                    }
                                    else
                                    {
                                        $url = $l['url'];
                                    }
                                    
                                    ?>
                                            <li>
                                                <a href="<?=$url?>"><?=$l['name']?></a>
                                            </li>
                                        <?
                                    	
    
                                    $i++;
                                }
                                ?>
                            </ul>
                        <?
                        }
                        else 
                        {
                        ?>
                            <a <? if($n['id'] == 1) {echo "href='".base_url()."'";}else{echo "href='".$nurl."'";}?> ><?=strtoupper($n['name'])?></a>
                        <?	
                        }
                        ?>
                    </li>
                <? } ?>
                </ul>
            </div>
            
            
            
        </div>
    </div>
</div>
<script>
$j(document).ready(function() {
	$j('#username').editable(
			{placement:'bottom',placeholder:'Search...'}
	);
	$j.fn.editableform.buttons ='<button type="submit" class="btn editable-submit btn-primary btn-sm"><i class="fa fa-search"></i> </button>';
	
	cart.update_item_count();
});
</script>