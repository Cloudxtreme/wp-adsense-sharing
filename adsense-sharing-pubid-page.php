<div class="wrap">
<?php screen_icon('options-general');?>
<?php if(isset($_GET['success'])){ ?>
<div id="message" class="updated">
  <p>
    <b>Settings Saved</b>
  </p>
</div>
<?php } ?>
<h2>Adsense PubID Page</h2>
<div id="poststuff" class="metabox-holder">
					<div class="has-sidebar">
						<div id="post-body-content" class="has-sidebar-content">
							<div style="clear: both;">
								<div class="postbox" style="float: right; display: block; width: 200px;">
								<h3 style="cursor:default;"><span>About this Plugin:</span></h3>
									<div class="inside">
											
									<div class="inside">
					    				 <p><a style="padding:4px 4px 4px 50px;display:block;background-repeat:no-repeat;background-position:5px 50%;text-decoration:none;border:none;background-image:url(<?php echo $this->plugin_url.'/static/images/logo.png';?>);" target="_blank" href="http://www.wordpressplugindeveloper.com">Author's website</a></p>
					    				 <p><a style="padding:4px 4px 4px 50px;display:block;background-repeat:no-repeat;background-position:5px 50%;text-decoration:none;border:none;background-image:url(<?php echo $this->plugin_url.'/static/images/how-to.png';?>);" target="_blank" href="http://www.wordpressplugindeveloper.com/wp-adsense-sharing.html#pubid">How to Use</a></p>
					    				 <p><a style="padding:4px 4px 4px 50px;display:block;background-repeat:no-repeat;background-position:5px 50%;text-decoration:none;border:none;background-image:url(<?php echo $this->plugin_url.'/static/images/coffee.jpg';?>);" target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=chinsungli%40gmail%2ecom&lc=C2&item_name=wpas%20buy%20me%20a%20coffee&amount=5%2e00&currency_code=USD&button_subtype=services&bn=PP%2dBuyNowBF%3abtn_buynowCC_LG%2egif%3aNonHosted">Buy Me A Coffee</a></p>
					    				 <p><a style="padding:4px 4px 4px 50px;display:block;background-repeat:no-repeat;background-position:5px 50%;text-decoration:none;border:none;background-image:url(<?php echo $this->plugin_url.'/static/images/bug.png';?>);" target="_blank" href="http://www.wordpressplugindeveloper.com/wp-adsense-sharing.html#respond">Bug Report</a></p>
									</div>
									</div>
								</div>
												
							</div>

  						</div>
  					</div>
</div>
<form method="post" >
<?php wp_nonce_field( 'wpas_pubid_page', 'wpas_pubid_page' ); ?>
<p>Adsense PubID: <input type="text" name="wpas_adsense_pubid" size="30" value="<?php echo $wpas_pubid; ?>" /></p>
<p style="font-size:11px;color: #666;">Don't forget "pub-" :).</p>
<p><input type="submit" class="button-primary" value="Save Changes" /></p>
</form>
</div>
