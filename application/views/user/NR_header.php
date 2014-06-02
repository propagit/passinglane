<?php $cur_page = $this->uri->segment(1); ?>
<!-- begin header-->

<div class="header-wrap">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 logo-wrap">
                <a href="<?=base_url();?>"><img class="logo" src="<?=base_url();?>assets/frontend-assets/img/core/logo.png" /></a>
                <span class="slogan">Australias Microwave Network Experts</span>
            </div>
        </div>
        <div class="row nav-wrap">
            <div class="col-xs-12">
                <ul class="nav nav-pills">
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
						if($n['id'] == 3)
						{
							?>
							<li>
								<a class="dropdown-toggle" data-toggle="dropdown" <?if($n['id'] == 1) {echo "href='".base_url()."'";}else{echo "href='".$nurl."'";}?> ><?=strtoupper($n['name'])?></a>
								<ul class="dropdown-menu">
									<li class="ghost-li">&nbsp;</li>
									<?php
										$ttl = count($cat_prods) - 1;
										$i = 0;
										foreach($cat_prods as $cp)
										{
											if($ttl == 0)
											{
												?>
													<li class="border-top-nav border-left-nav border-right-nav border-bottom-nav">
														<a href="<?=base_url()?>products/<?=$cp['id_title']?>"><?=$cp['name']?></a>
													</li>
												<?
											}
											else
											{
												if($i == 0)
												{
													?>
														<li class="border-top-nav border-left-nav border-right-nav">
															<a href="<?=base_url()?>products/<?=$cp['id_title']?>"><?=$cp['name']?></a>
														</li>
													<?
												}
												elseif($i == $ttl)
												{
													?>
														<li class="border-bottom-nav border-left-nav border-right-nav">
															<a href="<?=base_url()?>products/<?=$cp['id_title']?>"><?=$cp['name']?></a>
														</li>
													<?
												}
												else
												{
													?>
														<li class="border-left-nav border-right-nav">
															<a href="<?=base_url()?>products/<?=$cp['id_title']?>"><?=$cp['name']?></a>
														</li>
													<?
												}
											}	
											
											
											$i++;
										}
									?>
								</ul>
							</li>
							<?
						}
						else
						{
							?>
								<li>
									
									<?php
									if($links)
									{
									?>
										<a class="dropdown-toggle" data-toggle="dropdown" <?if($n['id'] == 1) {echo "href='".base_url()."'";}else{echo "href='".$nurl."'";}?> ><?=strtoupper($n['name'])?></a>
										<ul class="dropdown-menu">
											<li class="ghost-li">&nbsp;</li>
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
													//$url = base_url().'page/'.$l['page'];
												}
												else
												{
													$url = $l['url'];
												}
												
												if($ttl == 0)
												{
													?>
														<li class="border-top-nav border-left-nav border-right-nav border-bottom-nav">
															<a href="<?=$url?>"><?=$l['name']?></a>
														</li>
													<?
												}
												else
												{
													if($i == 0)
													{
														?>
															<li class="border-top-nav border-left-nav border-right-nav">
																<a href="<?=$url?>"><?=$l['name']?></a>
															</li>
														<?
													}
													elseif($i == $ttl)
													{
														?>
															<li class="border-bottom-nav border-left-nav border-right-nav">
																<a href="<?=$url?>"><?=$l['name']?></a>
															</li>
														<?
													}
													else
													{
														?>
															<li class="border-left-nav border-right-nav">
																<a href="<?=$url?>"><?=$l['name']?></a>
															</li>
														<?
													}
												}	

												$i++;
											}
											?>
										</ul>
									<?
									}
									else 
									{
									?>
										<a <?if($n['id'] == 1) {echo "href='".base_url()."'";}else{echo "href='".$nurl."'";}?> ><?=strtoupper($n['name'])?></a>
									<?	
									}
									?>
								</li>
								
							<?
						}
						
					
					}
                	?>
                    <!-- <li <?=($cur_page == '' ? 'class="active"' : '');?>><a href="<?=base_url();?>">HOME</a></li>
                    <li <?=($cur_page == 'company' ? 'class="active"' : '');?>><a href="#">COMPANY</a></li>
                    <li class="dropdown <?=($cur_page == 'product' ? 'active' : '');?>">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">OUR PRODUCTS</a>
                        <ul class="dropdown-menu">
                          <li class="ghost-li">&nbsp;</li>
                          <li><a href="<?=base_url();?>product">LICENSED WIRELESS MICROWAVE</a></li>
                          <li><a href="<?=base_url();?>product">UNLICENSED WIRELESS BRIDGE / ROUTERS</a></li>
                          <li><a href="<?=base_url();?>product">LASTER COMMUNICATION</a></li>
                          <li><a href="<?=base_url();?>product">NEW PRODUCTS</a></li>
                        </ul>
                    </li>
                    <li <?=($cur_page == 'our-services' ? 'class="active"' : '');?>><a href="#">OUR SERVICES</a></li>
                    <li <?=($cur_page == 'case-studies' ? 'class="active"' : '');?>><a href="<?=base_url();?>case-studies">CASE STUDIES</a></li>
                    <li <?=($cur_page == 'news-media' ? 'class="active"' : '');?>><a href="#">NEWS MEDIA</a></li>
                    <li <?=($cur_page == 'contact-us' ? 'class="active"' : '');?>><a href="#">CONTACT US</a></li> -->
                </ul>
            </div>
        </div>
    </div><!-- end header container -->
</div>

<!-- end header-->

