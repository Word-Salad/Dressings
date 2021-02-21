<body style="text-align:center;"> 
      
    <h1>WS Custom Metadata</h1>

    <?php
        if( isset( $_POST['form_submit'] ) ) {

            $user_id = get_current_user_id();
              
              $user_meta_1 = $_POST['user_meta_1'];
              $user_meta_2 = $_POST['user_meta_2'];
              $user_meta_3 = $_POST['user_meta_3'];
              $user_meta_4 = $_POST['user_meta_4'];
            
            update_user_meta($user_id , '$user_meta_1', $user_age);
            update_user_meta($user_id , '$user_meta_2', $user_age);
            update_user_meta($user_id , '$user_meta_3', $user_age);
            update_user_meta($user_id , '$user_meta_4', $user_age);

            $meta_user_age = get_user_meta( $user_id, 'user_age', true );
            echo $meta_user_age;

        }
    ?>

    <form method="POST">
    <input type="text" placeholder="1" name="user_meta_1">
    <input type="text" placeholder="2" name="user_meta_2">
    <input type="text" placeholder="3" name="user_meta_3">
    <input type="text" placeholder="4" name="user_meta_4">
    <input type="submit" name="form_submit" method="post">
    </form>

</body>
