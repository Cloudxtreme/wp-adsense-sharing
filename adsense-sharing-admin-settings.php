<div class="wrap">
<?php screen_icon('options-general');?>
<?php if(isset($_GET['success'])){ ?>
<div id="message" class="updated">
  <p>
    <b>Settings Saved</b>
  </p>
</div>
<?php } ?>
<h2>Admin Settings</h2>
<div id="poststuff" class="metabox-holder">
					<div class="has-sidebar">
						<div id="post-body-content" class="has-sidebar-content">
						<div style="clear: both;">
								<div class="postbox" style="float:right; display: block; width: 200px;">
								<h3 style="cursor:default;"><span>About this Plugin:</span></h3>
									<div class="inside">
					    				 <p><a style="padding:4px 4px 4px 50px;display:block;background-repeat:no-repeat;background-position:5px 50%;text-decoration:none;border:none;background-image:url(<?php echo $this->plugin_url.'/static/images/logo.png';?>);" target="_blank" href="http://www.wordpressplugindeveloper.com">Author's website</a></p>
					    				 <p><a style="padding:4px 4px 4px 50px;display:block;background-repeat:no-repeat;background-position:5px 50%;text-decoration:none;border:none;background-image:url(<?php echo $this->plugin_url.'/static/images/how-to.png';?>);" target="_blank" href="http://www.wordpressplugindeveloper.com/wp-adsense-sharing.html#admin-settings">How to Use</a></p>
					    				 <p><a style="padding:4px 4px 4px 50px;display:block;background-repeat:no-repeat;background-position:5px 50%;text-decoration:none;border:none;background-image:url(<?php echo $this->plugin_url.'/static/images/coffee.jpg';?>);" target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=chinsungli%40gmail%2ecom&lc=C2&item_name=wpas%20buy%20me%20a%20coffee&amount=5%2e00&currency_code=USD&button_subtype=services&bn=PP%2dBuyNowBF%3abtn_buynowCC_LG%2egif%3aNonHosted">Buy Me A Coffee</a></p>
					    				 <p><a style="padding:4px 4px 4px 50px;display:block;background-repeat:no-repeat;background-position:5px 50%;text-decoration:none;border:none;background-image:url(<?php echo $this->plugin_url.'/static/images/bug.png';?>);" target="_blank" href="http://www.wordpressplugindeveloper.com/wp-adsense-sharing.html#respond">Bug Report</a></p>
									</div>
								</div>
												
							</div>
						<div class="postbox" style="margin-right:300px;">
				<h3 style="cursor:default;font-weight:bold"><span>How many Google ads can I display per page?</span></h3>
				<div class="inside">
				<p>3 content units, 3 links and 2 search boxes in one page! <a href="http://www.google.com/adsense/support/bin/answer.py?hl=en&answer=9735">http://www.google.com/adsense/support/bin/answer.py?hl=en&answer=9735</a></p>
				</div>
						</div>
						<div class="postbox" style="margin-right:300px;">
				<h3 style="cursor:default;font-weight:bold"><span>The Importance of google_ad_client = "{pubid}"</span></h3>
				<div class="inside">
				<p>When viewing a post, WPAS will replace {pubid} with Author's Adsense Publisher ID.</p>
<p>On the contrary, WPAS won't do anything if {pubid} not found.</p>
				</div>
						</div>
						

  						</div>
  					</div>
</div>


<form method="post" >
<?php wp_nonce_field( 'wpas_admin_settings_page', 'wpas_admin_settings_page' ); ?>

		<div id="wpas-tabs">
		<ul class="hide-if-no-js">
		<li><a href="#wpas-post">Post Ad Placement</a></li>
		<li><a href="#wpas-widget">Widget Ad Style</a></li>
		<li><a href="#wpas-custom">Custom Placement</a></li>
		<li><a href="#wpas-misc">Misc Settings</a></li>
		</ul>
		
		<div class="wpas-section" id="wpas-misc">
			<h3 class="hide-if-js">Misc Settings</h3>
			<table class="widefat">
				<thead>
					    <tr>
						<th scope="row" id="sr" class="manage-column"><span><b>Misc Settings</b></span></th>
						<th scope="row" id="sc" class="manage-column"></th>
					    </tr>
				</thead>
			 <tbody>
			   <tr>
			    <td>
			   <p>
			   	<strong>Use Adminstrator's Adsense Publisher ID if author doesn't provide.</strong> 
			   	<input type="checkbox" name="wpas_use_admin" <?php if($options['wpas_use_admin']) echo 'checked'?>/>
			   </p>
			   <p>
			   	<strong>Do you want to enable Post Ad Placement in pages?</strong> 
			   	<input type="checkbox" name="wpas_postad_in_page" <?php if($options['wpas_postad_in_page']) echo 'checked'?>/>
			   	<p style="font-size:11px;color: #666;">Generally, pages are subject to Privcay Policy, About US or something.</p>
			   </p>
			   <p>
			   	<strong>Do you want to enable Post Ad Placement in homepage?</strong> 
			   	<input type="checkbox" name="wpas_postad_in_home" <?php if($options['wpas_postad_in_home']) echo 'checked'?>/>
			   	<p style="font-size:11px;color: #666;">If homepage has two or more posts, WPAS might place <a href="http://www.google.com/adsense/support/bin/answer.py?hl=en&answer=9735">maximum number of allowed ad units</a> in homepage and it'll make site looking cluttered.</p>
			   	<p style="font-size:11px;color: #666;">Beisdes, if homepage only shows post excerpt, WPAS won't place post ads.</p>
			   	<p style="font-size:11px;color: #666;">In homepage, the {pubid} will be replaced by administrator's.</p>
			   </p>
			   <p>
			   	<strong>Do you want to enable Widget Ad in homepage?</strong> 
			   	<input type="checkbox" name="wpas_widgetad_in_home" <?php if($options['wpas_widgetad_in_home']) echo 'checked'?>/>
			   	<p style="font-size:11px;color: #666;">In homepage, the {pubid} will be replaced by administrator's.</p>
			   </p>
			   <p>
			   	<strong>Do you want to enable Custom Ad Placement in homepage?</strong> 
			   	<input type="checkbox" name="wpas_customad_in_home" <?php if($options['wpas_customad_in_home']) echo 'checked'?>/>
			   	<p style="font-size:11px;color: #666;">In homepage, the {pubid} will be replaced by administrator's.</p>
			   </p>
			   <p>
			   	<strong>Do you want to enable Traffic Tracking in homepage?</strong> 
			   	<input type="checkbox" name="wpas_tracking_in_home" <?php if($options['wpas_tracking_in_home']) echo 'checked'?>/>
			   </p>
			   </td>
			   </tr>
			   
			   
			 </tbody>
			</table>
				
		</div> <!-- section -->
		
		<div class="wpas-section" id="wpas-post">
			<h3 class="hide-if-js">Post Ad Placement</h3>
			<table class="widefat">
			<thead>
				    <tr>
				        <th scope="row" id="sr" class="manage-column"><span><b>Post Ad Placement</b></span></th>
				        <th scope="row" id="sc" class="manage-column"></th>
				    </tr>
			</thead>
		 <tbody>
		   <tr>
		   <th>In the beginning of post</th>
		   <td> Enable <input type="checkbox" name="wpas_beginning_enable" <?php if($options['wpas_beginning']['enable']) echo 'checked'?>/><br />
		   <textarea rows="15" cols="40" name="wpas_beginning"><?php echo $options['wpas_beginning']['code']; ?></textarea><br />
		   <p style="font-size:11px;color: #666;">This area is for you to put the adsense code in.</p>
		   <p style="font-size:11px;color: #666;">You can generate adsense code <a href="admin.php?page=generate_code_page">here</a>.</p>
		   <p style="font-size:11px;color: #666;">If you want to wrap adsense around the text, see <a target="_blank" href="<?php echo $this->plugin_url;?>/static/images/left.jpg">left.jpg</a> and <a target="_blank"  href="<?php echo $this->plugin_url;?>/static/images/right.jpg">right.jpg</a>.</p>
		   </td>
		   </tr>
		   
		   <tr>
		   <th>In the middle of post</th>
		   <td> Enable <input type="checkbox" name="wpas_middle_enable" <?php if($options['wpas_middle']['enable']) echo 'checked'?>/><br />
		   <textarea rows="15" cols="40" name="wpas_middle"><?php echo $options['wpas_middle']['code']; ?></textarea><br />
		   <p style="font-size:11px;color: #666;">This area is for you to put the adsense code in.</p>
<p style="font-size:11px;color: #666;">You can generate adsense code <a href="admin.php?page=generate_code_page">here</a>.</p>
		   <p style="font-size:11px;color: #666;">If you want to wrap adsense around the text, see <a target="_blank" href="<?php echo $this->plugin_url;?>/static/images/left.jpg">left.jpg</a> and <a target="_blank"  href="<?php echo $this->plugin_url;?>/static/images/right.jpg">right.jpg</a>.</p>
		   <p style="font-size:11px;color: #666;">Note: If the content is less than 2 paragraphs, this option won't be working!</p>
		   </td>
		   </tr>
		   
		    <tr>
		   <th>At the end of post</th>
		   <td> Enable <input type="checkbox" name="wpas_end_enable" <?php if($options['wpas_end']['enable']) echo 'checked'?>/><br />
		   <textarea rows="15" cols="40" name="wpas_end"><?php echo $options['wpas_end']['code']; ?></textarea><br />
		   <p style="font-size:11px;color: #666;">This area is for you to put the adsense code in.</p>
<p style="font-size:11px;color: #666;">You can generate adsense code <a href="admin.php?page=generate_code_page">here</a>.</p>
		   <p style="font-size:11px;color: #666;">If you want to wrap adsense around the text, see <a target="_blank" href="<?php echo $this->plugin_url;?>/static/images/left.jpg">left.jpg</a> and <a target="_blank"  href="<?php echo $this->plugin_url;?>/static/images/right.jpg">right.jpg</a>.</p>
		   </td>
		   </tr>
		   
		 </tbody>
		</table>
				
		</div> <!-- section -->
		
		<div class="wpas-section" id="wpas-widget">
			<h3 class="hide-if-js">Widget Ad Style</h3>
			<table class="widefat">
			<thead>
				    <tr>
				        <th scope="row" id="sr" class="manage-column"><span><b>Widget Ad Style</b></span></th>
				        <th scope="row" id="sc" class="manage-column"></th>
				    </tr>
			</thead>
			 <tbody>
			   <tr>
			   <th>Widget Ad 1</th>
			    <td>
			   <textarea rows="15" cols="40" name="wpas_widget1"><?php echo $options['wpas_widget1']; ?></textarea><br />
			   <p style="font-size:11px;color: #666;">This area is for you to put the adsense code in.</p>
<p style="font-size:11px;color: #666;">You can generate adsense code <a href="admin.php?page=generate_code_page">here</a>.</p>
			   <p style="font-size:11px;color: #666;">You can add unlimited widgets of this style to theme sidebar.</p>
			   </td>
			   </tr>
			   
			   <tr>
			   <th>Widget Ad 2</th>
			    <td>
			   <textarea rows="15" cols="40" name="wpas_widget2"><?php echo $options['wpas_widget2']; ?></textarea><br />
			   <p style="font-size:11px;color: #666;">This area is for you to put the adsense code in.</p>
<p style="font-size:11px;color: #666;">You can generate adsense code <a href="admin.php?page=generate_code_page">here</a>.</p>
			   <p style="font-size:11px;color: #666;">You can add unlimited widgets of this style to theme sidebar.</p>
			   </td>
			   </tr>
			   
			 </tbody>
			</table>
				
		</div> <!-- section -->
		

		<div class="wpas-section" id="wpas-custom">
			<h3 class="hide-if-js">Custom Ad Placement</h3>
			<table class="widefat">
				<thead>
					    <tr>
						<th scope="row" id="sr" class="manage-column"><span><b>Custom Ad Placement</b></span></th>
						<th scope="row" id="sc" class="manage-column"></th>
					    </tr>
				</thead>
			 <tbody>
			   <tr>
			   <th>Custom Placement 1</th>
			    <td>
			   <textarea rows="15" cols="40" name="wpas_custom1"><?php echo $options['wpas_custom1']; ?></textarea><br />
			   <p style="font-size:11px;color: #666;">This area is for you to put the adsense code in.</p>
<p style="font-size:11px;color: #666;">You can generate adsense code <a href="admin.php?page=generate_code_page">here</a>.</p>
			   <p style="font-size:11px;color: #666;">Add &lt;?php global $wpas;if($wpas)$wpas->show_customad(1); ?&gt; in your wordpress theme file</p>
			   </td>
			   </tr>
			   
			   <tr>
			   <th>Custom Placement 2</th>
			    <td>
			   <textarea rows="15" cols="40" name="wpas_custom2"><?php echo $options['wpas_custom2']; ?></textarea><br />
			   <p style="font-size:11px;color: #666;">This area is for you to put the adsense code in.</p>
<p style="font-size:11px;color: #666;">You can generate adsense code <a href="admin.php?page=generate_code_page">here</a>.</p>
			   <p style="font-size:11px;color: #666;">Add &lt;?php global $wpas;if($wpas)$wpas->show_customad(2); ?&gt; in your wordpress theme file</p>
			   </td>
			   </tr>
			   
			 </tbody>
			</table>
				
		</div> <!-- section -->
		</div>  <!-- tabs -->



<p><input type="submit" class="button-primary" value="Save Changes" /></p>
</form>
</div>
