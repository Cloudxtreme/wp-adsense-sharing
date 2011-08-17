<div class="wrap">
<?php screen_icon('options-general');?>
<h2>Generate Code Page</h2>
<p style="font-size:11px;color: #666;">FYI: here is the details of google adsense formats <a href="http://www.google.com/adsense/adformats">http://www.google.com/adsense/adformats</a></p>
<table style="margin-top: 1em;" class="widefat">
	<thead>
                    <tr>
                        <th scope="row" id="sr" class="manage-column"><span><b>Generate Adsense Code</b></span></th>
                        <th scope="row" id="sc" class="manage-column"></th>
                    </tr>
        </thead>
        <tbody>
        
        <tr>
        <td scope="row">
            <b>Adsense Format</b>
        </td>
        
        <td scope="row">
            <select id="wpas_adsense_format">
		<option value="-1" style="color:#ed1010">**** Text Ads****</option>
		<option value="text|120x240_as">120 x 240 Vertical Banner</option>
		<option value="text|120x600_as">120 x 600 Skyscraper</option>
		<option value="text|125x125_as">125 x 125 Button</option>
		<option value="text|160x600_as">160 x 600 Wide Skyscraper</option>
		<option value="text|180x150_as">180 x 150 Small Rectangle</option>
		<option value="text|234x60_as">234 x 60 Half Banner</option>
		<option value="text|250x250_as">250 x 250 Square</option>
		<option value="text|300x250_as">300 x 250 Medium Rectangle</option>
		<option value="text|336x280_as">336 x 280 Large Rectangle</option>
		<option value="text|468x60_as">468 x 60 Banner</option>
		<option value="text|728x90_as">728 x 90 Leaderboard</option>
		
		<option value="-1" style="color:#ed1010">**** Image Ads****</option>
		<option value="image|120x240_as">120 x 240 Vertical Banner</option>
		<option value="image|120x600_as">120 x 600 Skyscraper</option>
		<option value="image|125x125_as">125 x 125 Button</option>
		<option value="image|160x600_as">160 x 600 Wide Skyscraper</option>
		<option value="image|180x150_as">180 x 150 Small Rectangle</option>
		<option value="image|234x60_as">234 x 60 Half Banner</option>
		<option value="image|250x250_as">250 x 250 Square</option>
		<option value="image|300x250_as">300 x 250 Medium Rectangle</option>
		<option value="image|336x280_as">336 x 280 Large Rectangle</option>
		<option value="image|468x60_as">468 x 60 Banner</option>
		<option value="image|728x90_as">728 x 90 Leaderboard</option>
		
		<option value="-1" style="color:#ed1010">**** Text & Image Ads****</option>
		<option value="text_image|120x240_as">120 x 240 Vertical Banner</option>
		<option value="text_image|120x600_as">120 x 600 Skyscraper</option>
		<option value="text_image|125x125_as">125 x 125 Button</option>
		<option value="text_image|160x600_as">160 x 600 Wide Skyscraper</option>
		<option value="text_image|180x150_as">180 x 150 Small Rectangle</option>
		<option value="text_image|234x60_as">234 x 60 Half Banner</option>
		<option value="text_image|250x250_as">250 x 250 Square</option>
		<option value="text_image|300x250_as">300 x 250 Medium Rectangle</option>
		<option value="text_image|336x280_as">336 x 280 Large Rectangle</option>
		<option value="text_image|468x60_as">468 x 60 Banner</option>
		<option value="text_image|728x90_as">728 x 90 Leaderboard</option>
		
		<option value="-1" style="color:#ed1010">**** Link Units****</option>
		<option value="-1" style="color:#ed1010">****4 Links****</option>
		<option value="text|120x90_0ads_al">120x90</option>
		<option value="text|160x90_0ads_al">160x90</option>
		<option value="text|180x90_0ads_al">180x90</option>
		<option value="text|200x90_0ads_al">200x90</option>
		<option value="text|468x15_0ads_al">468x15</option>
		<option value="text|728x15_0ads_al">728x15</option>

		<option value="-1" style="color:#ed1010">**** 5 Links****</option>
		<option value="text|120x90_0ads_al_s">120x90</option>
		<option value="text|160x90_0ads_al_s">160x90</option>
		<option value="text|180x90_0ads_al_s">180x90</option>
		<option value="text|200x90_0ads_al_s">200x90</option>
		<option value="text|468x15_0ads_al_s">468x15</option>
		<option value="text|728x15_0ads_al_s">728x15</option>

		

	</select>
            
           </td>
           
        </tr>
	    <tr>
                <td scope="row"><b>Border Color</b></td>
                <td scope="row">
                <input id="txtBorderColor" name="txtBorderColor" type="text" maxlength="6" value="FFFFFF" />
                <span id="spnBorderColor" class="color" style="background-color: #FFFFFF; "></span>
                </td>
            </tr>
            <tr>
                <td scope="row"><b>Title Color</b></td>
                <td scope="row">
                    <input id="txtTitleColor" name="txtTitleColor" type="text" maxlength="6" value="0000FF" />
                    <span id="spnTitleColor" class="color" style="background-color: #0000FF; "></span>
                </td>
            </tr>
            <tr>
                <td scope="row"><b>Background Color</b></td>
                <td scope="row">
                    <input id="txtBackgroundColor" name="txtBackgroundColor" type="text" maxlength="6" value="FFFFFF" />
                    <span id="spnBackgroundColor" class="color" style="background-color: #FFFFFF; "></span>
                </td>
            </tr>
           <tr>
                <td scope="row"><b>Text Color</b></td>
                <td scope="row">
                    <input id="txtTextColor" name="txtTextColor" type="text" maxlength="6" value="000000" />
                    <span id="spnTextColor" class="color" style="background-color: #000000; "></span>
                </td>
            </tr>
            <tr>
                <td scope="row"><b>URL Color</b></td>
                <td scope="row">
                    <input id="txtURLColor" name="txtURLColor" type="text" maxlength="6" value="008000" />
                    <span id="spnURLColor" class="color" style="background-color: #008000; "></span>
                </td>
            </tr>
             <tr>
                
                <td scope="row">
                </td>
                <td scope="row"><input id="wpas_generate_code" class="button-primary" type="submit" value="Generate Code"></td>
            </tr>
        <tr>
        	<td scope="row"><b>Copy Adsense Code</b>
        		<p style="font-size:11px;color: #666;">Important Note: <em>Do Not Change/Remove "{pubid}"</em></p>
        	</td>
        	<td scope="row">
        	<textarea id="wpas_adsense_code" rows="15" cols="40" onclick="this.select()"></textarea>
        	</td>
        
        </tr>
        </tbody>
        
</table>
</div>
