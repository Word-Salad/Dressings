<?php

class Ws_Input_Generator {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {


	}

	public function salad_generate() {
		$key = '';
        if( isset( $_POST['submit_' . $key] ) ) {
            $user_id = get_current_user_id();
            update_user_meta($user_id , $_POST["set_key_$key"], $_POST["set_value_$key"]);
        }

		
		$value = get_user_meta( get_current_user_id(), $key, true );
	?>
 		<form method="POST">
		 	<label>set key:</label>
			<input type="text" placeholder="<?php echo $key ?>" name="set_key_<?php echo $key ?>">

			<label>set value:</label>
			<input type="text" placeholder="<?php echo $value ?>" name="set_value_<?php echo $key ?>">
			
			<input type="submit" name="submit_<?php echo $key ?>" method="post">
		</form>
	<?php
	}

}
