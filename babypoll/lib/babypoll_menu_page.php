<!-- start Baby Poll Page -->

<?php 

$babypoll_date = get_option( 'babypoll_date' );
$babypoll_time = get_option( 'babypoll_time' );
$babypoll_weight = get_option( 'babypoll_weight' );
$babypoll_length = get_option( 'babypoll_length' );
$babypoll_hair = get_option( 'babypoll_hair' );
$babypoll_eyes = get_option( 'babypoll_eyes' );
$strLength = ( $babypoll_weight >= 10 ) ? 2 : 1;
$babypoll_weight_lb = substr($babypoll_weight, 0, $strLength);
$babypoll_weight_oz = substr($babypoll_weight, $strLength);

?>
<h1>Baby Poll Results</h1>
<form action="" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
	<?php wp_nonce_field( 'post_nonce' ); ?>
		
	<table class="form-table">
	    <tr>
			<th><label for="babypoll_date">Birth Date</label></th>

			<td>
	        	<input type="text" name="babypoll_date" id="babypoll_date" class="datepicker" value="<?php echo $babypoll_date; ?>" />
			</td>
		</tr>
	    <tr>
			<th><label for="babypoll_time">Birth Time</label></th>

			<td>
	        	<input type="text" name="babypoll_time" id="babypoll_time" class="timepicker" value="<?php echo $babypoll_time; ?>" />
			</td>
		</tr>			
	    <tr>
			<th><label for="babypoll_weight_lb">Baby Weight</label></th>

			<td>
				<select id="babypoll_weight_lb" name="babypoll_weight_lb" style="width:100px;">
					<option value="5" <?php selected( $babypoll_weight_lb, '5' );?>>5 lb.</option>
					<option value="6" <?php selected( $babypoll_weight_lb, '6' );?>>6 lb.</option>
					<option value="7" <?php selected( $babypoll_weight_lb, '7' );?>>7 lb.</option>
					<option value="8" <?php selected( $babypoll_weight_lb, '8' );?>>8 lb.</option>
					<option value="9" <?php selected( $babypoll_weight_lb, '9' );?>>9 lb.</option>
					<option value="10" <?php selected( $babypoll_weight_lb, '10' );?>>10 lb.</option>
					<option value="11" <?php selected( $babypoll_weight_lb, '11' );?>>11 lb.</option>
				</select>
				<select id="babypoll_weight_oz" name="babypoll_weight_oz" style="width:100px;">
					<option value=".000" <?php selected( $babypoll_weight_oz, '.000' );?>>0 oz.</option>
					<option value=".125" <?php selected( $babypoll_weight_oz, '.125' );?>>2 oz.</option>
					<option value=".250" <?php selected( $babypoll_weight_oz, '.250' );?>>4 oz.</option>
					<option value=".375" <?php selected( $babypoll_weight_oz, '.375' );?>>6 oz.</option>
					<option value=".500" <?php selected( $babypoll_weight_oz, '.500' );?>>8 oz.</option>
					<option value=".625" <?php selected( $babypoll_weight_oz, '.625' );?>>10 oz.</option>
					<option value=".750" <?php selected( $babypoll_weight_oz, '.750' );?>>12 oz.</option>
					<option value=".875" <?php selected( $babypoll_weight_oz, '.875' );?>>14 oz.</option>
				</select>
	        	<input type="text" name="babypoll_weight" id="babypoll_weight" value="<?php echo $babypoll_weight; ?>" style="display:none;" />
			</td>
		</tr>
	    <tr>
			<th><label for="babypoll_length">Baby Length</label></th>

			<td>
				<select id="babypoll_length" name="babypoll_length" >
					<option value="18.0" <?php selected( $babypoll_length, '18.0' );?>>18 in.</option>
					<option value="18.5" <?php selected( $babypoll_length, '18.5' );?>>18 1/2 in.</option>
					<option value="19.0" <?php selected( $babypoll_length, '19.0' );?>>19 in.</option>
					<option value="19.5" <?php selected( $babypoll_length, '19.5' );?>>19 1/2 in.</option>
					<option value="20.0" <?php selected( $babypoll_length, '20.0' );?>>20 in.</option>
					<option value="20.5" <?php selected( $babypoll_length, '20.5' );?>>20 1/2 in.</option>
					<option value="21.0" <?php selected( $babypoll_length, '21.0' );?>>21 in.</option>
					<option value="21.5" <?php selected( $babypoll_length, '21.5' );?>>21 1/2 in.</option>
					<option value="22.0" <?php selected( $babypoll_length, '22.0' );?>>22 in.</option>
					<option value="22.5" <?php selected( $babypoll_length, '22.5' );?>>22 1/2 in.</option>
					<option value="23.0" <?php selected( $babypoll_length, '23.0' );?>>23 in.</option>
					<option value="23.5" <?php selected( $babypoll_length, '23.5' );?>>23 1/2 in.</option>
				</select>
			</td>
		</tr>
	    <tr>
			<th><label for="babypoll_hair">Baby Hair Color</label></th>

			<td>
		        <select id="babypoll_hair" name="babypoll_hair" >
	                <option value="Brown" <?php  selected( $babypoll_hair, 'Brown' );?> >Brown</option>
	                <option value="Black" <?php selected( $babypoll_hair, 'Black' ); ?> >Black</option>
	                <option value="Blond" <?php selected( $babypoll_hair, 'Blond' ); ?> >Blond</option>
	                <option value="Red" <?php selected( $babypoll_hair, 'Red' ); ?> >Red</option>
	                <option value="Bald" <?php selected( $babypoll_hair, 'Bald' ); ?> >Bald</option>
	            </select>
			</td>
		</tr>
	    <tr>
			<th><label for="babypoll_eyes">Baby Eye Color</label></th>

			<td>
		        <select id="babypoll_eyes" name="babypoll_eyes" >
	                <option value="Brown" <?php  selected( $babypoll_eyes, 'Brown' );?> >Brown</option>
	                <option value="Grey" <?php selected( $babypoll_eyes, 'Grey' ); ?> >Grey</option>
	                <option value="Blue" <?php selected( $babypoll_eyes, 'Blue' ); ?> >Blue</option>
	                <option value="Green" <?php selected( $babypoll_eyes, 'Green' ); ?> >Green</option>
	                <option value="Hazel" <?php selected( $babypoll_eyes, 'Hazel' ); ?> >Hazel</option>
	            </select>
			</td>
		</tr>
	</table>
	<?php submit_button( 'Save Results' ); ?>
	<?php submit_button( 'Reset Results', 'secondary', 'delete' ); ?>

	
</form>

