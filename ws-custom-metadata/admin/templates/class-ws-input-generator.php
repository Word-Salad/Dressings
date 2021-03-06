<?php

class Ws_Input_Generator {

	public function __construct() {
		//
	}

	public function salad_add_meta() {

        if( isset( $_POST['submit_new_meta'] ) ) {
			$all_users = get_users();
			foreach ($all_users as $user) {
				update_user_meta($user->ID , 'salad_' . $_POST["set_key"], $_POST["set_value"]);
			}
        }
	  ?>
 		<form method="POST">
			<input type="text" placeholder="New User Meta Field" name="set_key">
			<!-- <input type="text" placeholder="Set Value (Current User)" name="set_value"> -->
			<input type="submit" name="submit_new_meta" value="create">
		</form>
	  <?php

	}

	public function salad_delete_meta() {

		//getting salad meta by current user (bad)
		$user_id = get_current_user_id();
		$all_meta = get_user_meta($user_id, '', false);

		foreach ($all_meta as $key => $value) {

			if (strpos($key, 'salad_') !== false) {
			  $key = str_replace('salad_', '', $key);
			  
				if( isset( $_POST["submit_$key"] ) ) {
					$all_users = get_users();
					foreach ($all_users as $user) {
						delete_user_meta( $user->ID, 'salad_' . $key );
						?><script>
							location.reload(true);
						</script>
						<?php
					}
				}
		  ?>
			<form method="POST">
			  <label><?php echo $key ?>: </label>
			  <input type="submit" name="submit_<?php echo $key ?>" value="delete">
			</form>
		  <?php
			}
		}
		
	}

}
