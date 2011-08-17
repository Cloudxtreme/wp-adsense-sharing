<div class="wrap">
<?php screen_icon('options-general');?>
<?php global $wpas;if(!is_writable($wpas->plugin_path.'/files/')){ ?>
<div id="message" class="error">
  <p>
    <strong>Due to 'files' directory permission WPAS cannot export data! Please contact site administrator!</strong>
  </p>
</div>
<?php } ?>
<h2>Traffic Stats</h2>
<h4>If you site installed any database cache plugin like W3 Total Cache, the data won't be showing realtime.</h4>
<form action="" method="get">
<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
<?php $testListTable->display(); ?>
</form>
