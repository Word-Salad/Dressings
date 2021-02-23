<body>

  <h1>Salad</h1>

  <div>
    <?php
    require_once 'class-ws-input-generator.php';
    $generator = new Ws_Input_Generator();
    $generator->salad_generate();

    echo '<br>';

    $user_id = get_current_user_id();
    $all_meta = get_user_meta($user_id, '', false);

    foreach ($all_meta as $key => $value) {
      if (strpos($key, 'salad_') !== false) {
        $key = str_replace('salad_', '', $key);
    ?>
      <form method="POST">
        <label><?php echo $key ?>: </label>
        <input type="text" placeholder="<?php echo $value[0] ?>" name="set_value_<?php echo $key ?>">
        <input type="submit" name="submit_<?php echo $key ?>" method="post">
      </form>
    <?php
      }
    };
    ?>
  </div>
</body>