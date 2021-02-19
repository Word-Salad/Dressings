<body style="text-align:center;"> 
      
    <h1>WS Custom Metadata</h1>

    <?php
        if( isset( $_POST['form_submit'] ) ) {

            $user_age = $_POST['user_age'];
            $user_id = get_current_user_id();
            update_user_meta($user_id , 'user_age', $user_age);

            $meta_user_age = get_user_meta( $user_id, 'user_age', true );
            echo $meta_user_age;

        }
    ?>

    <form method="POST">
    <input type="text" placeholder="Your Age Plez" name="user_age">
    <input type="submit" name="form_submit" method="post">
    </form>

</body>