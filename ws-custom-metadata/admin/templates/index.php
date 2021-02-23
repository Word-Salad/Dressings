<body>

  <h1>Salad</h1>

  <div>
    <?php
    require_once 'class-ws-input-generator.php';
    $generator = new Ws_Input_Generator();
    
    $generator->salad_generate();
    echo '<br>';
    $generator->salad_list_meta();
    ?>
  </div>
</body>