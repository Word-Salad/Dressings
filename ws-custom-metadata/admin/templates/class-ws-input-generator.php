<?php

class Ws_Input_Generator {

	public function __construct() {
		//
	}

	public function salad_generate() {
		$key = '';
        if( isset( $_POST['submit_new_meta'] ) ) {
            $user_id = get_current_user_id();
            update_user_meta($user_id , 'salad_' . $_POST["set_key"], $_POST["set_value"]);
        }
		$value = get_user_meta( get_current_user_id(), $key, true );
	?>
 		<form method="POST">
			<input type="text" placeholder="set key" name="set_key">
			<input type="text" placeholder="set value" name="set_value">
			<input type="submit" name="submit_new_meta" method="post">
		</form>
	<?php
	}

}
