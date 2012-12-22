<!-- start Baby Poll Page -->

<?php 
$user_id = get_current_user_id(); 
$info = get_userdata( $user_id );

$babypoll_participant = get_the_author_meta( 'babypoll_participant', $user_id );
$babypoll_date = get_the_author_meta( 'babypoll_date', $user_id );
$babypoll_time = get_the_author_meta( 'babypoll_time', $user_id );
$babypoll_weight = get_the_author_meta( 'babypoll_weight', $user_id );
$babypoll_length = get_the_author_meta( 'babypoll_length', $user_id );
$babypoll_hair = get_the_author_meta( 'babypoll_hair', $user_id );
$babypoll_eyes = get_the_author_meta( 'babypoll_eyes', $user_id );
$strLength = ( $babypoll_weight >= 10 ) ? 2 : 1;
$babypoll_weight_lb = substr($babypoll_weight, 0, $strLength);
$babypoll_weight_oz = substr($babypoll_weight, $strLength);

//echo $babypoll_length;
//wp_die();
?>
<h2>Your Best Guess:</h2>
<?
if ($babypoll_participant != 'on'){ // return a form if user is not already a participant
?>
<form action="" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
	
	<input type="hidden" name="babypoll_participant" id="babypoll_participant" value="on" />
	
	<table class="form-table">
		<tr>
			<th><label for="babypoll_your_name">Your Name</label></th>

			<td>
	        	<input type="text" name="babypoll_your_name" id="babypoll_your_name" value="<?php echo $info->nickname; ?>" />
			</td>
		</tr>
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

	<?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
	<p><input type="submit" value="Submit &rarr;"></p>
</form>
<?php
} else {
?>

<table class="form-table">
	<tr>
		<th><label for="babypoll_your_name">Your Name</label></th>

		<td>
        	<div id="babypoll_your_name" ><?php echo $info->nickname; ?></div>
		</td>
	</tr>
    <tr>
		<th><label for="babypoll_date">Birth Date</label></th>

		<td>
        	<div id="babypoll_date"><?php echo $babypoll_date; ?></div>
		</td>
	</tr>
    <tr>
		<th><label for="babypoll_time">Birth Time</label></th>

		<td>
			<div id="babypoll_time"><?php echo $babypoll_time; ?></div>
        </td>
	</tr>			
    <tr>
		<th><label for="babypoll_weight">Baby Weight</label></th>

		<td>
			<div id="babypoll_weight"><?php echo $babypoll_weight_lb.'lb '.( 16 * $babypoll_weight_oz). 'oz'; ?></div>
		</td>
	</tr>
    <tr>
		<th><label for="babypoll_length">Baby Length</label></th>

		<td>
			
			<div id="babypoll_length">
				<?php
				$babypoll_div_length = substr($babypoll_length, 0, 2);
				$babypoll_div_length .= (substr($babypoll_length, -1, 1) == 5) ? ' 1/2 in.' : ' in.';
				echo $babypoll_div_length; 
				?>
			</div>
		</td>
	</tr>
    <tr>
		<th><label for="babypoll_hair">Baby Hair Color</label></th>

		<td>
	    	<div id="babypoll_hair"><?php echo $babypoll_hair;?></div>
		</td>
	</tr>
    <tr>
		<th><label for="babypoll_eyes">Baby Eye Color</label></th>

		<td>
	    	<div id="babypoll_hair"><?php echo $babypoll_eyes;?></div>
		</td>
	</tr>
</table>

<?php
}
?>
<h2>All Guesses:</h2>
<?php
$user_query = new WP_User_Query(array(
   'meta_key'   => 'babypoll_participant', 
   'meta_compare' => 'like', 
   'meta_value' => 'on',
 ));

$users = $user_query->get_results();
?>
<table class="form-table">
    <tr>
		<th>Name</th>
		<th>Date</th>
		<th>Time</th>
		<th>Weight</th>
		<th>Length</th>
		<th>Hair</th>
		<th>Eyes</th>
	</tr>

<?php
foreach( $users as $user ){
	
	$user_id = $user->ID;
	$info = get_userdata( $user_id );
	$babypoll_participant = get_the_author_meta( 'babypoll_participant', $user_id );
	$babypoll_date = get_the_author_meta( 'babypoll_date', $user_id );
	$babypoll_time = get_the_author_meta( 'babypoll_time', $user_id );
	$babypoll_weight = get_the_author_meta( 'babypoll_weight', $user_id );
	$babypoll_length = get_the_author_meta( 'babypoll_length', $user_id );
	$babypoll_hair = get_the_author_meta( 'babypoll_hair', $user_id );
	$babypoll_eyes = get_the_author_meta( 'babypoll_eyes', $user_id );
	$strLength = ( $babypoll_weight >= 10 ) ? 2 : 1;
	$babypoll_weight_lb = substr($babypoll_weight, 0, $strLength);
	$babypoll_weight_oz = substr($babypoll_weight, $strLength);
		
	?>
		<tr>
			<td><b><?php echo $info->nickname;?></b></td>
			<td><?php echo $babypoll_date; ?></td>

			<td><?php echo $babypoll_time; ?></td>

			<td><?php echo $babypoll_weight_lb.'lb '.( 16 * $babypoll_weight_oz). 'oz'; ?></td>

			<td>
					<?php
					$babypoll_div_length = substr($babypoll_length, 0, 2);
					$babypoll_div_length .= (substr($babypoll_length, -1, 1) == 5) ? ' 1/2 in.' : ' in.';
					echo $babypoll_div_length; 
					?>
			</td>

			<td><?php echo $babypoll_hair;?></td>

			<td><?php echo $babypoll_eyes;?></td>
		</tr>
<?php
}
?>
</table>

