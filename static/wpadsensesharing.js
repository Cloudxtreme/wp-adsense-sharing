var ImageCode = {
   
    init: function () {
        jQuery("#lnkUpdateCode").click(function () {
            ImageCode.generateUrl()
        });
        jQuery("#lnkResetCode").click(function () {
            ImageCode.reset()
        });
        jQuery("#txtBorderColor").ColorPicker({
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value)
            },
            onShow: function (A) {
                jQuery(A).slideDown("normal");
                return false
            },
            onHide: function (A) {
                jQuery(A).slideUp("normal");
                return false
            },
            onChange: function (A, C, B) {
                jQuery("#txtBorderColor").val(C);
                jQuery("#spnBorderColor").css("backgroundColor", "#" + C)
            },
            onSubmit: function (A, C, B) {
                jQuery("#txtBorderColor").val(C);
                jQuery("#spnBorderColor").css("backgroundColor", "#" + C)
            }
        }).change(function () {
            jQuery("#spnBorderColor").css("backgroundColor", "#" + jQuery(this).val())
        });
        jQuery("#txtTitleColor").ColorPicker({
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value)
            },
            onShow: function (A) {
                jQuery(A).slideDown("normal");
                return false
            },
            onHide: function (A) {
                jQuery(A).slideUp("normal");
                return false
            },
            onChange: function (A, C, B) {
                jQuery("#txtTitleColor").val(C);
                jQuery("#spnTitleColor").css("backgroundColor", "#" + C)
            },
            onSubmit: function (A, C, B) {
                jQuery("#txtTitleColor").val(C);
                jQuery("#spnTitleColor").css("backgroundColor", "#" + C)
            }
        }).change(function () {
            jQuery("#spnTitleColor").css("backgroundColor", "#" + jQuery(this).val())
        });
        jQuery("#txtBackgroundColor").ColorPicker({
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value)
            },
            onShow: function (A) {
                jQuery(A).slideDown("normal");
                return false
            },
            onHide: function (A) {
                jQuery(A).slideUp("normal");
                return false
            },
            onChange: function (A, C, B) {
                jQuery("#txtBackgroundColor").val(C);
                jQuery("#spnBackgroundColor").css("backgroundColor", "#" + C)
            },
            onSubmit: function (A, C, B) {
                jQuery("#txtBackgroundColor").val(C);
                jQuery("#spnBackgroundColor").css("backgroundColor", "#" + C)
            }
        }).change(function () {
            jQuery("#spnBackgroundColor").css("backgroundColor", "#" + jQuery(this).val())
        });
        jQuery("#txtTextColor").ColorPicker({
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value)
            },
            onShow: function (A) {
                jQuery(A).slideDown("normal");
                return false
            },
            onHide: function (A) {
                jQuery(A).slideUp("normal");
                return false
            },
            onChange: function (A, C, B) {
                jQuery("#txtTextColor").val(C);
                jQuery("#spnTextColor").css("backgroundColor", "#" + C)
            },
            onSubmit: function (A, C, B) {
                jQuery("#txtTextColor").val(C);
                jQuery("#spnTextColor").css("backgroundColor", "#" + C)
            }
        }).change(function () {
            jQuery("#spnTextColor").css("backgroundColor", "#" + jQuery(this).val())
        });
        jQuery("#txtURLColor").ColorPicker({
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value)
            },
            onShow: function (A) {
                jQuery(A).slideDown("normal");
                return false
            },
            onHide: function (A) {
                jQuery(A).slideUp("normal");
                return false
            },
            onChange: function (A, C, B) {
                jQuery("#txtURLColor").val(C);
                jQuery("#spnURLColor").css("backgroundColor", "#" + C)
            },
            onSubmit: function (A, C, B) {
                jQuery("#txtURLColor").val(C);
                jQuery("#spnURLColor").css("backgroundColor", "#" + C)
            }
        }).change(function () {
            jQuery("#spnURLColor").css("backgroundColor", "#" + jQuery(this).val())
        });
        jQuery("#txtImageCode").click(function () {
            jQuery(this)[0].select()
        });
    }
};
jQuery(document).ready(function(){
   ImageCode.init();

});
jQuery(document).ready(function() {
	
	jQuery('#wpas_generate_code').click(function(e){
		console.log();
		var data = {
			action: 'wpas_generate_code',
			border_color: jQuery('#txtBorderColor').val(),
			title_color: jQuery('#txtTitleColor').val(),
			background_color: jQuery('#txtBackgroundColor').val(),
			text_color: jQuery('#txtTextColor').val(),
			URL_color: jQuery('#txtTextColor').val(),
			adsense_format: jQuery('#wpas_adsense_format').val(),
		};
		jQuery.post(ajaxurl, data, function(response) {
			if(response == 'false'){
			}else{
				jQuery('#wpas_adsense_code').val(response);
			}
			
		});
		e.preventDefault();	
			
			
	});
});
jQuery(document).ready(function() {
jQuery("#wpas-tabs").tabs();
});
