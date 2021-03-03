<?php

class Ws_Input_Generator {

	public function __construct() {
		//
	}

	public function salad_generate() {
        if( isset( $_POST['submit_new_meta'] ) ) {
            $user_id = get_current_user_id();
            update_user_meta($user_id , 'salad_' . $_POST["set_key"], $_POST["set_value"]);
        }

		$all_users = get_users();
		$the_meta = get_user_meta($all_users[0]->ID, '', false);
		var_dump($the_meta);

	  ?>
 		<form method="POST">
			<input type="text" placeholder="set key" name="set_key">
			<input type="text" placeholder="set value" name="set_value">
			<input type="submit" name="submit_new_meta" method="post">
		</form>
	  <?php
	}

	public function salad_list_meta() {
		$user_id = get_current_user_id();
		$all_meta = get_user_meta($user_id, '', false);

		foreach ($all_meta as $key => $value) {
			if (strpos($key, 'salad_') !== false) {
			  $key = str_replace('salad_', '', $key);
			  
				if( isset( $_POST["submit_$key"] ) ) {
					$user_id = get_current_user_id();
					update_user_meta($user_id , "salad_$key", $_POST["set_value_$key"]);
				}
		  ?>
			<form method="POST">
			  <label><?php echo $key ?>: </label>
			  <input type="text" placeholder="<?php echo $value[0] ?>" name="set_value_<?php echo $key ?>">
			  <input type="submit" name="submit_<?php echo $key ?>" method="post">
			</form>
		  <?php
			}
		};
	}

}
