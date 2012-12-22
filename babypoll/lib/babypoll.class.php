<?php

$babyPoll = new BabyPoll();
class BabyPoll{
	
	   /**
	     * Constructor 
	     * Sets up the hooks we need for WordPress
	     * @return type 
	     */
	    public function __construct() {
            
	            wp_enqueue_style( 'timepicker-css', WP_PLUGIN_URL.'/babypoll/css/jquery.ui.timepicker.css' );
				wp_enqueue_style( 'jquery-ui-css', WP_PLUGIN_URL.'/babypoll/css/jquery-ui-1.9.2.css' );
				wp_enqueue_script( 'timepicker-js', WP_PLUGIN_URL.'/babypoll/js/jquery.ui.timepicker.js', array('jquery-ui'));
            	wp_enqueue_script( 'jquery-ui', WP_PLUGIN_URL.'/babypoll/js/jquery-ui-1.9.1.min.js', array('jquery'));
				
				wp_register_script('babypoll', WP_PLUGIN_URL.'/babypoll/js/babypoll.js', array('jquery') );
				wp_enqueue_script('babypoll');

	            if( !is_admin() ) {
					add_action ('init', array(&$this, 'ob_start_global') );
					add_action ('shutdown', array(&$this, 'ob_flush_global') );
					add_action ('wp_head', array(&$this, 'babypoll_update_meta'));
										
					add_shortcode( 'babypoll', array( &$this, 'babypoll_shortcode') );

				}

				if( !is_admin() ) return;

	            // Add additional fields
	            add_action( 'show_user_profile', array( &$this, 'addAdditionalFields' ) );
	            add_action( 'edit_user_profile', array( &$this, 'addAdditionalFields' ) );

	            // Save additional fields
	            add_action( 'personal_options_update', array( &$this, 'saveAdditionalFields' ) );
	            add_action( 'edit_user_profile_update', array( &$this, 'saveAdditionalFields' ) );
				
				// admin menu item
	            add_action( 'admin_menu', array( $this, 'babypoll_menu' ) );

	    }
		
		public function ob_start_global(){
			ob_start ();
		}

		public function ob_flush_global(){
			echo ob_get_clean ();
		}
		/**
		* setup admin menu
		*/
		public function babypoll_menu(){
			add_menu_page(
	                'Baby Poll Results',
	                'Baby Poll',
	                'manage_options',
	                'baby_poll',
	                array( $this, 'babypoll_menu_page' )
	                //plugins_url( 'babypoll/images/Nordstrom_icon.png' )
	        );
		}
		/**
		* babypoll menu page
		*/
		public function babypoll_menu_page(){
			require_once( BABYPOLL_PLUGIN_DIR.'lib/babypoll_menu_page.php' );
			
			if( isset( $_POST['delete'] ) ){
				$this->babypoll_reset_results();
			}
	        if( isset( $_POST['submit'] ) )
	            $this->babypoll_save_results( $_POST );
		}
		
		/**
		* babypoll save results
		*/
		public function babypoll_save_results( $Results ){
			
			check_admin_referer( 'post_nonce' );
			
			update_option( 'babypoll_results', true );
        	update_option( 'babypoll_hair', $Results['babypoll_hair'] );
	        update_option( 'babypoll_eyes', $Results['babypoll_eyes'] );
	        update_option( 'babypoll_length', $Results['babypoll_length'] );
	        update_option( 'babypoll_weight', $Results['babypoll_weight'] );
	        update_option( 'babypoll_time', $Results['babypoll_time'] );
	        update_option( 'babypoll_date', $Results['babypoll_date'] );
		}
		/**
		* babypoll reset results
		*/
		public function babypoll_reset_results(){
			
			check_admin_referer( 'post_nonce' );
			
			delete_option( 'babypoll_results' );
        	delete_option( 'babypoll_hair' );
	        delete_option( 'babypoll_eyes' );
	        delete_option( 'babypoll_length' );
	        delete_option( 'babypoll_weight' );
	        delete_option( 'babypoll_time' );
	        delete_option( 'babypoll_date' );
		}
		
		public function babypoll_update_meta(){

			if ( isset( $_POST['babypoll_participant'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {
				
				$this->saveAdditionalFields(get_current_user_id());
				
				wp_redirect( get_permalink().'?updated=true');
				exit;
			}
		}
		public function babypoll_shortcode(){
			
			if ( is_user_logged_in() ) {
				$babypoll_page = '';

				$babypoll_page .= $this->babypoll_get_page();
				
			} else { $babypoll_page = '<p class="alert">Sorry. You must be <a href="'.wp_login_url( get_permalink() ).'">logged in</a> to view this page</p>'; }

			
			return $babypoll_page;
		}
		
		/**
		* function used to return page content
		*/
		public function babypoll_get_page(){
			ob_start();
				include( BABYPOLL_PLUGIN_DIR.'lib/babypoll_page.php');
			return ob_get_clean();
		}
		
	
	    /**
	     * Adds an additional content section to the bottom of the user's profile
	     * page in wp-admin
	     * 
	     * @param WP_User $User 
	     */
	    public function addAdditionalFields( $User ) {
			
			$babypoll_participant = get_the_author_meta( 'babypoll_participant', $User->ID );
	        
			if( 'on' == $babypoll_participant ) {
	            $babypoll_participant = 'checked="checked"';
	        } else {
	            $babypoll_participant = '';
	        }
	
			$babypoll_date = get_the_author_meta( 'babypoll_date', $User->ID );
	        $babypoll_time = get_the_author_meta( 'babypoll_time', $User->ID );
	        $babypoll_weight = get_the_author_meta( 'babypoll_weight', $User->ID );
	        $babypoll_length = get_the_author_meta( 'babypoll_length', $User->ID );
	        $babypoll_hair = get_the_author_meta( 'babypoll_hair', $User->ID );
	        $babypoll_eyes = get_the_author_meta( 'babypoll_eyes', $User->ID );

	        ?>
		<h3>Baby Poll User Fields</h3>
		<table class="form-table">
			<tr>
				<th><label for="babypoll_participant">Baby Pool Participant</label></th>

				<td>
	            	<input type="checkbox" name="babypoll_participant" id="babypoll_participant" <?php echo $babypoll_participant; ?>  />
				</td>
			</tr>
	        <tr>
				<th><label for="babypoll_date">Birth Date</label></th>

				<td>
	            	<input type="text" name="babypoll_date" id="babypoll_date" value="<?php echo $babypoll_date; ?>" />
				</td>
			</tr>
	        <tr>
				<th><label for="babypoll_time">Birth Time</label></th>

				<td>
	            	<input type="text" name="babypoll_time" id="babypoll_time" value="<?php echo $babypoll_time; ?>" />
				</td>
			</tr>			
	        <tr>
				<th><label for="babypoll_weight">Baby Weight</label></th>

				<td>
	            	<input type="text" name="babypoll_weight" id="babypoll_weight" value="<?php echo $babypoll_weight; ?>" />
				</td>
			</tr>
	        <tr>
				<th><label for="babypoll_length">Baby Length</label></th>

				<td>
	            	<input type="text" name="babypoll_length" id="babypoll_length" value="<?php echo $babypoll_length; ?>" />
				</td>
			</tr>
	        <tr>
				<th><label for="babypoll_hair">Baby Hair Color</label></th>

				<td>
			        <select id="babypoll_hair" name="babypoll_hair" >
		                <option value="brown" <?php  selected( $babypoll_hair, 'brown' );?> >Brown</option>
		                <option value="black" <?php selected( $babypoll_hair, 'black' ); ?> >Black</option>
		                <option value="blond" <?php selected( $babypoll_hair, 'blond' ); ?> >Blond</option>
		                <option value="red" <?php selected( $babypoll_hair, 'green' ); ?> >Red</option>
		                <option value="bald" <?php selected( $babypoll_hair, 'bald' ); ?> >Bald</option>
		            </select>
				</td>
			</tr>
	        <tr>
				<th><label for="babypoll_eyes">Baby Eye Color</label></th>

				<td>
			        <select id="babypoll_eyes" name="babypoll_eyes" >
		                <option value="brown" <?php  selected( $babypoll_eyes, 'brown' );?> >Brown</option>
		                <option value="grey" <?php selected( $babypoll_eyes, 'grey' ); ?> >Grey</option>
		                <option value="blue" <?php selected( $babypoll_eyes, 'blue' ); ?> >Blue</option>
		                <option value="green" <?php selected( $babypoll_eyes, 'green' ); ?> >Green</option>
		                <option value="hazel" <?php selected( $babypoll_eyes, 'hazel' ); ?> >Hazel</option>
		            </select>
				</td>
			</tr>
		</table>

	        <?php
	    }

	    /**
	     * Saves the additional fields created in $this->addAdditionalFields
	     * 
	     * @param Integer $UserId
	     */
	    public function saveAdditionalFields( $UserId ) {
	        //if ( !current_user_can( 'edit_user', $user_id ) )
			//return false;
			
			// users will be participants unless unchecked from backend
			if (is_admin())
				$_POST['babypoll_participant'] = ( !isset( $_POST['babypoll_participant'] ) ) ? 'off' : 'on';
	        
			update_usermeta( $UserId, 'babypoll_participant', $_POST['babypoll_participant'] );
			
			if (isset($_POST['babypoll_your_name']))
				update_user_meta( $UserId, 'nickname', $_POST['babypoll_your_name'] );
        	update_usermeta( $UserId, 'babypoll_hair', $_POST['babypoll_hair'] );
	        update_usermeta( $UserId, 'babypoll_eyes', $_POST['babypoll_eyes'] );
	        update_usermeta( $UserId, 'babypoll_length', $_POST['babypoll_length'] );
	        update_usermeta( $UserId, 'babypoll_weight', $_POST['babypoll_weight'] );
	        update_usermeta( $UserId, 'babypoll_time', $_POST['babypoll_time'] );
	        update_usermeta( $UserId, 'babypoll_date', $_POST['babypoll_date'] );

	    }
}
?>