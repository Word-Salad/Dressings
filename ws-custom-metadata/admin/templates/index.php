<body>

  <h1>Salad</h1>

  <div>
    <?php
    require_once 'class-ws-input-generator.php';
    $generator = new Ws_Input_Generator();
    
    $generator->salad_add_meta();
    echo '<br>';
    $generator->salad_delete_meta();
    ?>
  </div>
</body>