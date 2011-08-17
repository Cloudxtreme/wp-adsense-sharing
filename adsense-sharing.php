<?php
/* 
 * Plugin Name:   WP Adsense Sharing
 * Version:       0.1
 * Plugin URI:    http://www.wordpressplugindeveloper.com
 * Description:	  Coded By http://www.wordpressplugindeveloper.com
 * Author:        Jesse
 * Author URI:    http://www.wordpressplugindeveloper.com
 */
class WPASWidget extends WP_Widget {
	function WPASWidget() {
		parent::WP_Widget(false, $name = 'WPAS Widget');
	}

	function widget($args, $instance) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title']);
		$widgetstyle = $instance['widgetstyle'];
		
		if(!isset($wpas)){
			$wpas = new WPAS();
		}
		$widgetcontent = $wpas->get_widgetad($widgetstyle);
		
		?>
		      <?php echo $before_widget; ?>
		          <?php if ( $title )
		                echo $before_title . $title . $after_title; ?>
		        <?php echo $widgetcontent;?>
		      <?php echo $after_widget; ?>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['widgetstyle'] = $new_instance['widgetstyle'];
		return $instance;
    	}

	function form($instance) {
		$title = esc_attr($instance['title']);
		$widgetstyle = esc_attr($instance['widgetstyle']);
	?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>Widget Style <?php echo $this->dropdown($widgetstyle);?></p>
	<?php 
	}
	function dropdown($widgetstyle){
		$name=$this->get_field_name('widgetstyle');
		$id = $this->get_field_id('widgetstyle');
    		$total = 2;
		$result = "<select id={$id} name='{$name}' >";
	            for($i = 1; $i <= $total; $i++){
		            $result .= '<option value="' . $i . '"';
		            if($widgetstyle == $i){
			            $result .= ' selected="selected"';
		            }
		            $result .= '>' . $i .'</option>' ;
	            }
	            $result .= '</select>';
	      return $result;
	}

} 
add_action('widgets_init', create_function('', 'return register_widget("WPASWidget");'));

if (!class_exists("WPAS")) {
	class WPAS{
		var $plugin_url = '' ;
		var $plugin_path = '' ;
		var $db =  array();
		var $version = '0.1';
		var $options = '';
		var $option_name = 'WPAS';
		
		function __construct(){
			global $wpdb;
			$this->plugin_path = dirname(__FILE__);
			$this->db = array(
					'track' => $wpdb->prefix.'wpas_track',
					 );
			$generate_code_page = 'wpas_page_generate_code_page';
			$admin_settings_page = 'wpas_page_admin_settings_page';
			$this->plugin_url = WP_PLUGIN_URL . '/' . basename(dirname(__FILE__));
			add_action("load-{$generate_code_page}",array(&$this,'admin_load'));
			add_action("load-{$admin_settings_page}",array(&$this,'admin_load'));
			register_activation_hook(__FILE__, array(&$this, 'install'));
			register_deactivation_hook(__FILE__, array(&$this, 'uninstall'));
			add_action('wp_ajax_wpas_generate_code', array(&$this,'generate_code'));
			add_action('admin_menu',array(&$this,'add_menu_pages'));
			add_action('template_redirect',array(&$this,'template_redirect'));
			add_action('the_content',array(&$this,'insert_postad'),9); 
			add_action('wp_footer',array(&$this,'wp_footer'));
			add_action('admin_notices',  array(&$this,'admin_notices'));
		
		}
		
		function add_menu_pages(){
			add_menu_page('WPAS', 'WPAS', 'edit_posts','wpas_pubid_page',  array(&$this,'adsense_pubid_page'));
				add_submenu_page('wpas_pubid_page', 'Adsense PubID', 'Adsense PubID', 'edit_posts','wpas_pubid_page',  array(&$this,'adsense_pubid_page'));
				add_submenu_page('wpas_pubid_page', 'Traffic Stats', 'Traffic Stats', 'edit_posts','wpas_traffic_stats_page',  array(&$this,'traffic_stats_page'));
				add_submenu_page('wpas_pubid_page', 'Admin Settings', 'Admin Settings', 'manage_options','admin_settings_page',  array(&$this,'admin_settings_page'));
				add_submenu_page('wpas_pubid_page', 'Generate Code', 'Generate Code', 'manage_options','generate_code_page',  array(&$this,'generate_code_page'));
				
				
		}
		
		function admin_load(){
			wp_enqueue_style('wpadsensesharing_style', plugins_url('/static/wpadsensesharing.css',__FILE__));
			wp_enqueue_script('wpadsensesharing_colorpicker', plugins_url('/static/colorpicker.js',__FILE__),array('jquery','jquery-ui-tabs'));
			wp_enqueue_script('wpadsensesharing_js', plugins_url('/static/wpadsensesharing.js',__FILE__));
		}
		
		function admin_notices(){
			global $user_ID;
			$pubid = get_user_meta($user_ID,'wpas_pubid',true);
			if(!$pubid)
				sprintf( '<div id="notice" class="error"><p><b>WP Adsense Sharing  </b>Please <a href="%s">Enter</a> Your Adsense Publisher ID.</p></div>', admin_url("admin.php?page=wpas_pubid_page") );
		
		}
		
		function install(){
			global $wpdb;
			$options = $this->get_option();
			
			if( $options === false ){
			
				$options = array(
						 'wpas_beginning' => array('enable' => true, 'code' => ''),
						 'wpas_middle' => array('enable' => true, 'code' => ''),
						 'wpas_end' => array('enable' => false, 'code' => ''),
						 'wpas_widget1' => '',
						 'wpas_widget2' => '',
						 'wpas_custom1' => '',
						 'wpas_custom2' => '',
						 
						 'wpas_postad_in_pages' => false,
						 'wpas_postad_in_home' => false,
						 'wpas_widgetad_in_home' => true,
						 'wpas_customad_in_home' => true,
						 'wpas_tracking_in_home' => true,
						 
						 'wpas_use_admin' => false,
						 
						);
						
				$this->update_option($options);
				
			}
			
			if($wpdb->get_var("SHOW TABLES LIKE '{$this->db['track']}'") != $this->db['track']) {
				
				$sql ="CREATE TABLE {$this->db['track']} (
  						          ID bigint(20) unsigned NOT NULL auto_increment,
  							  postid bigint(20) unsigned NOT NULL,
  							  author bigint(20) unsigned NOT NULL default '1',
  							  pv bigint(20) unsigned NOT NULL default '1',
  							  uv bigint(20) unsigned NOT NULL default '1',
  							  kw longtext NOT NULL default '',
  							  PRIMARY KEY  (ID)
	    			 );";
	    			
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      				dbDelta($sql);
				
			}
			
		}
		
		function get_option($name=''){
			
			if(empty($this->options)){
			
				$options = get_option($this->option_name);
				
			}else{
			
				$options = $this->options;
			}
			if(!$options) return false;
			if($name)
				return $options[$name];
			return $options;
		}
		
		function update_option($ops){
		
			if(is_array($ops)){
			
				$options = $this->get_option();
				
				foreach($ops as $key => $value){
					
					$options[$key] = $value;
					
				}
				update_option($this->option_name,$options);
				$this->options = $options;
			}			
			
		
		}
		
		function uninstall(){
			global $wpdb;
			foreach($this->db as $table)
				$wpdb->query(  "DROP TABLE {$table}" );
			delete_option($this->option_name);
		}
		
		function wp_footer(){
			global $post, $wpas_post_author;
			$postid = $post->ID;
			$author = $wpas_post_author;
			
			if( $this->is_homepage() ){
				if( $this->get_option('wpas_tracking_in_home') ){
					$postid = 0;
					$author = 1;
				}else{
					return;
				}
			}
			$kw = $this->get_search_term();
			
			$js  = '<script language="javascript" ';
			$js .= 'src="';
			$js .= $this->plugin_url . '/adsense-sharing-track.php?postid='.$postid.'&author='.$author.'&kw='.urlencode($kw);
			$js .= '"></script>' . "\n";
			echo $js;
		}
		
		function template_redirect(){
			global $post;
			global $wpas_post_author;
			$wpas_post_author = $post->post_author;
		}
		
		function handle_ad($ad){
			$wpas_pubid = $this->get_author_pubid();
			$ad = str_replace('{pubid}',$wpas_pubid,$ad);
			return $ad;
		}
		function get_author_pubid(){
			global $wpas_post_author;
			if($this->is_homepage())
				return get_user_meta(1,'wpas_pubid',true);
			$wpas_pubid = get_user_meta($wpas_post_author,'wpas_pubid',true);
			if( !$wpas_pubid && $this->get_option('wpas_use_admin') ){
				$wpas_pubid = get_user_meta(1,'wpas_pubid',true);
			}
			//still processing even though the pubid is still false
			return $wpas_pubid;
		}
		
		function show_customad($no){
			$no = absint($no);
			if($no > 2)
				return '';
			$ad = $this->get_option('wpas_custom'.$no);
			$ad = $this->handle_ad($ad);
			echo $ad;
		
		}
		
		function get_widgetad($style){
			if( $this->is_homepage() ){
				if( !$this->get_option('wpas_widgetad_in_home') )
					return '';
			}
			$ad = $this->handle_ad($this->get_option('wpas_widget'.$style));
			return $ad;
		}
		
		function insert_postad($content){
			
			if( !$this->is_insert_postad() )
				return $content;
			$content = preg_split( '/(\r\n|\r|\n)/' , $content);
			
			$total = count($content);
			
			$wpas_beginning = $this->get_option('wpas_beginning');
			if( $wpas_beginning['enable'] && $wpas_beginning['code'] ){
				$content[0] = $this->handle_ad($wpas_beginning['code']) ."\n". $content[0];
			}
			
			$wpas_middle = $this->get_option('wpas_middle');
			if( $wpas_middle['enable'] && $wpas_middle['code'] && $total>1 ){
				$middle = floor($total/2);
				$content[$middle] = $this->handle_ad($wpas_middle['code']) ."\n". $content[$middle];
			}

			$wpas_end = $this->get_option('wpas_end');
			if( $wpas_end['enable'] && $wpas_end['code'] ){
				$content[$total-1] = $content[$total-1] ."\n". $this->handle_ad($wpas_end['code']) ;
			}

			return implode("\n",$content);
		}
		
		function is_insert_postad(){
		
			if( $this->is_homepage() ){
				if( !$this->get_option('wpas_postad_in_home') )
					return false;
			}
			if(is_page()){
				if( !$this->get_option('wpas_postad_in_page') )
					return false;		
			}
			return true;
		
		}
		
		function is_homepage(){
			
			if( is_home() || is_front_page() ){
				return true;
			}
			return false;
		}
		
		function admin_settings_page(){
			$options = $this->get_option();
			
			if(wp_verify_nonce( $_POST['wpas_admin_settings_page'], 'wpas_admin_settings_page' )){
				 $_POST = stripslashes_deep($_POST);
				 
				 $new_options = array();
				 $new_options['wpas_beginning']['enable'] = $_POST['wpas_beginning_enable'];
				 $new_options['wpas_beginning']['code'] = $_POST['wpas_beginning'];
				 
				 $new_options['wpas_middle']['enable'] = $_POST['wpas_middle_enable'];
				 $new_options['wpas_middle']['code'] = $_POST['wpas_middle'];
				 
				 $new_options['wpas_end']['enable'] = $_POST['wpas_end_enable'];
				 $new_options['wpas_end']['code'] = $_POST['wpas_end'];
				 
				 $new_options['wpas_widget1'] = $_POST['wpas_widget1'];
				 $new_options['wpas_widget2'] = $_POST['wpas_widget2'];
				 
				 $new_options['wpas_custom1'] = $_POST['wpas_custom1'];
				 $new_options['wpas_custom2'] = $_POST['wpas_custom2'];
				 
				 $new_options['wpas_postad_in_page'] = isset($_POST['wpas_postad_in_page']);
				 $new_options['wpas_postad_in_home'] = isset($_POST['wpas_postad_in_home']);
				 $new_options['wpas_widgetad_in_home'] = isset($_POST['wpas_widgetad_in_home']);
				 $new_options['wpas_customad_in_home'] = isset($_POST['wpas_customad_in_home']);
				 
				 $new_options['wpas_use_admin'] = isset($_POST['wpas_use_admin']);
				 
				 
				 $this->update_option($new_options);
				 $redir=$_POST['_wp_http_referer'].'&success';
				 echo "<meta http-equiv='refresh' content='0;url=$redir' />";
				 exit;
			
			}
			@include_once($this->plugin_path.'/adsense-sharing-admin-settings.php');
		}

		function traffic_stats_page(){
			
			include_once($this->plugin_path.'/WPAS_Traffic_Stats_List_Table.php');
			$testListTable = new WPAS_Traffic_Stats_List_Table();
			$testListTable->prepare_items();
			
			include_once($this->plugin_path.'/adsense-sharing-traffic-stats-page.php');
		
		}		

		function adsense_pubid_page(){
			global $user_ID;
			if(wp_verify_nonce( $_POST['wpas_pubid_page'], 'wpas_pubid_page' )){
				update_user_meta($user_ID,'wpas_pubid',esc_attr($_POST['wpas_adsense_pubid']));
				$redir=$_POST['_wp_http_referer'].'&success';
				echo "<meta http-equiv='refresh' content='0;url=$redir' />";
				exit;
			
			}
			$wpas_pubid = get_user_meta($user_ID,'wpas_pubid',true);
			@include_once($this->plugin_path.'/adsense-sharing-pubid-page.php');
			
		}
		
		function generate_code_page(){
			@include_once($this->plugin_path.'/adsense-sharing-generate-code-page.php');
		}
		
		function generate_code(){
			$ad_format = $_POST['adsense_format'];
			
			if( $ad_format == '-1' )
				exit('Please choose one adsense format!');
				
			//ad_format: text|120x90_0ads_al_s
			$format = explode('|',$ad_format);
			
			$ad_type = $format[0];
			
			preg_match('@([0-9]{1,})x([0-9]{1,})@',$format[1],$m);
			$adtpl =<<<EOF
<script type="text/javascript"><!--
google_ad_client = "{pubid}";
google_ad_width = {$m[1]};
google_ad_height = {$m[2]};
google_ad_format = "{$format[1]}";
google_ad_type = "{$ad_type}";
google_color_border = "{$_POST['border_color']}";
google_color_bg = "{$_POST['background_color']}";
google_color_link = "{$_POST['title_color']}";
google_color_text = "{$_POST['text_color']}";
google_color_url = "{$_POST['URL_color']}";
google_ui_features = "rc:0";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
EOF;
			exit($adtpl);
		}
		
		function generate_report($args){
			$defaults = array(
				'orderby' =>'pv',
				'order' => 'ASC',
				'from' => 0,
				'per_page' => 5,
			);
			$r = wp_parse_args( $args, $defaults );
			
			extract( $r, EXTR_SKIP );
			
			global $wpdb, $user_ID;
			$sql= "SELECT * FROM {$this->db['track']} WHERE author={$user_ID} ORDER BY {$orderby} {$order} LIMIT {$from},{$per_page}";
			$results = $wpdb->get_results($sql,ARRAY_A);
			if($wpdb->num_rows===0)
				return false;
			return $results;
		}
		
		function get_report_record($ID){
			global $wpdb, $user_ID;
			$sql= "SELECT * FROM {$this->db['track']} WHERE author={$user_ID} and ID={$ID}";
			$results = $wpdb->get_results($sql,ARRAY_A);
			if($wpdb->num_rows===0)
				return false;
			return $results[0];
		}
		
		function get_all_report_records(){
			return $this->generate_report( array( 
							'per_page'=>$this->report_record_count()
							    )
						     );
		}
		
		function report_record_count(){
			global $wpdb, $user_ID;
			$sql= "SELECT count(*) FROM {$this->db['track']} WHERE author={$user_ID}";
			
			$results = $wpdb->get_results($sql,ARRAY_A);
			if($wpdb->num_rows===0)
				return false;
			return current($results[0]);
			
		}
		
		function process_csv_data($data){
		
			$newdata = array();
			foreach($data as $k => $row){
			
				if($row['postid']==0){
					$newdata[$k]['Post Title'] = 'Home Page';
					$newdata[$k]['Permalink'] = get_option('siteurl');
				}else{
					$newdata[$k]['Post Title'] = get_the_title($row['postid']);
					$newdata[$k]['Permalink'] = get_permalink($row['postid']);
				}
				
				$newdata[$k]['Unique Visitors'] = $row['uv'];
				$newdata[$k]['Page Views'] = $row['pv'];
				$newdata[$k]['Search Engine Keywords'] = str_replace(',','|',$row['kw']);
				
			}
			return $newdata;
		
		}
		
		function generate_csv($data){
			if(!$data)return;
			$filename = date("YmdHis").'.csv';
			$fp = @fopen($this->plugin_path.'/files/'.$filename, 'w');
			
			if(!$fp){
				echo '<div id="message" class="error">';
				echo '<p>';
				echo "<strong>Due to 'files' directory permission WPAS cannot export data! Please contact site administrator!</strong>";
				echo '</p>';
				echo '</div>';
				return;
			}
			
			$data = $this->process_csv_data($data);
			
			$header_row = $data[0];
			
			if($header_row) {
				fputcsv($fp, array_keys($header_row));
			}
			
			foreach($data as $row){
				fputcsv($fp, $row);
			}
			
			fclose($fp);
			$downloadurl = $this->plugin_url.'/download.php?file='.$filename;
			echo "<meta http-equiv='refresh' content='0;url=$downloadurl' />";
			
		}		

		function delete_report_record($ID){
			global $wpdb, $user_ID;
			
			$sql= "DELETE FROM {$this->db['track']} WHERE author={$user_ID} and ID={$ID}";
			
			return $wpdb->query($sql);
		
		}
		
		function handle_record($data){
			
			$record = $this->get_record($data['postid'],$data['author']);
			if( $record ){
			
				if($record['kw']){
					$record['kw'] = $record['kw'].','.$data['kw'];
				}else{
					$record['kw'] = $data['kw'];
				}
				
				if( $_COOKIE['wpas_newvisitor'] ){
					return $this->update_record($record,false);
				}else{
					setcookie('wpas_newvisitor', "true", time() + 60*60*24, '/', $_SERVER['HTTP_HOST'], false);
					return $this->update_record($record,true);
				}
				
			}
			
			return $this->insert_record($data);	
		}
		
		function get_record($postid,$author){
		
			global $wpdb;
			$sql= "SELECT * FROM {$this->db['track']} WHERE postid={$postid} and author={$author}";
			$result = $wpdb->get_results($sql,ARRAY_A);
			if($wpdb->num_rows===0)
				return false;
			
			return $result[0];
		
		}
		
		function insert_record($data){
			global $wpdb;
			$wpdb->insert( $this->db['track'], array( 'postid' => $data['postid'], 'author' => $data['author'], 'kw'=>$data['kw']) );
			return $wpdb->insert_id;
		}
		
		function update_record($record,$unique=false){
			global $wpdb;
			
			$where = array('postid'=>$record['postid'],'author'=>$record['author']);
			
			if($unique){
				$update_data = array( 'uv' => $record['uv']+1, 'kw'=>$record['kw']);
			}else{
				$update_data = array( 'pv' => $record['pv']+1, 'kw'=>$record['kw']);
			}
			return $wpdb->update( $this->db['track'], $update_data, $where ); 			
			
		}
		
		function get_search_term(){
			if($this->is_search_engine()){
				
				$search_term = $this->_get_search_term();
			}
			return $search_term;
		
		}
		
		function _get_search_term() {
			$query=parse_url($_SERVER['HTTP_REFERER']);
			$query=strtolower($query['query']);
			
			if ( strpos($query, "q=") !== false ) {
				$rtn_query= substr($query, strpos($query,"q="));
				$rtn_query= substr($rtn_query, 2);
				
				if (strpos($rtn_query,"&")) {
				
					$rtn_query = substr( $rtn_query, 0, strpos($rtn_query,"&") );
				}
				if($rtn_query)
					return $this->handle_badwords($rtn_query);
			}
			return '';
		     	
	
		}
		
		function handle_badwords($term){
			$badwords = array('http:','related:','cache:','site:','link:');
			
			$term = str_ireplace( $badwords, '***', $term );
			if( false === strpos( $term, '***' ) )
				return $term;
			else
				return '';
		}
		
		function is_search_engine(){
			$ref=parse_url($_SERVER['HTTP_REFERER']);
			$ref=$ref['host'];
			$ses[] = "bing.com";
			$ses[] = ".google.";
			$ses[] = ".yahoo.";
			$ses[] = ".ask.";
			foreach ($ses as $se) {
				if (stripos($ref, $se) !== false)
					return true;
			}
			return false;
		
		}
		
	}
	
	
}
if(!isset($wpas)){
		$wpas = new WPAS();
}
?>
