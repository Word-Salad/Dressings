<body style="text-align:center;"> 
      
    <h1>WS Custom Metadata</h1>

    <?php
        if( isset( $_POST['form_submit'] ) ) {

            $user_id = get_current_user_id();
              
              $user_meta_1 = $_POST['user_meta_1'];
              $user_meta_2 = $_POST['user_meta_2'];
              $user_meta_3 = $_POST['user_meta_3'];
              $user_meta_4 = $_POST['user_meta_4'];
            
            update_user_meta($user_id , 'user_meta_1', $user_meta_1);
            update_user_meta($user_id , 'user_meta_2', $user_meta_2);
            update_user_meta($user_id , 'user_meta_3', $user_meta_3);
            update_user_meta($user_id , 'user_meta_4', $user_meta_4);

            $user_meta_1 = get_user_meta( $user_id, 'user_meta_1', true );
            $user_meta_2 = get_user_meta( $user_id, 'user_meta_2', true );
            $user_meta_3 = get_user_meta( $user_id, 'user_meta_3', true );
            $user_meta_4 = get_user_meta( $user_id, 'user_meta_4', true );

        }
    ?>

    <form method="POST">
        <ul>
            <li>
                <input type="text" placeholder="<? echo get_user_meta( get_current_user_id(), 'user_meta_1', true ); ?>" name="user_meta_1">
              <input type="submit" name="form_submit" method="post">
              </li>
            <li>
                <input type="text" placeholder="<? echo get_user_meta( get_current_user_id(), 'user_meta_2', true ); ?>" name="user_meta_2">
              <input type="submit" name="form_submit" method="post">
              </li>
            <li>
                <input type="text" placeholder="<? echo get_user_meta( get_current_user_id(), 'user_meta_3', true ); ?>" name="user_meta_3">
              <input type="submit" name="form_submit" method="post">
              </li>
            <li>
                <input type="text" placeholder="<? echo get_user_meta( get_current_user_id(), 'user_meta_4', true ); ?>" name="user_meta_4">
              <input type="submit" name="form_submit" method="post">
              </li>
        </ul>
    <input type="submit" name="form_submit" method="post">
    </form>

</body>
