<?php
  $heightFire = 50;
  $widthFire = $heightFire;
  $totalLengthFire = $heightFire * $widthFire;
  $colorPatter = [
    "#070707", "#1f0707", "#2f0f07", "#470f07", "#571707", "#671f07", "#771f07", "#8f2707",
    "#9f2f07", "#af3f07", "#bf4707", "#c74707", "#df4f07", "#df5707", "#df5707", "#d75f07",
    "#d75f07", "#d7670f", "#cf6f0f", "#cf770f", "#cf7f0f", "#cf8717", "#c78717", "#c78f17",
    "#c7971f", "#bf9f1f", "#bf9f1f", "#bfa727", "#bfa727", "#bfaf2f", "#b7af2f", "#b7b72f",
    "#b7b737", "#cfcf6f", "#dfdf9f", "#efefc7", "#ffffff",
  ];

  if (isset($_GET['currentArrayCellFire'])) {
      $currentArray = json_decode($_GET['currentArrayCellFire'], true);
      if (!is_array($currentArray) || count($currentArray) !== $totalLengthFire) {
          $currentArray = array_fill(0, $totalLengthFire, 0);
      }
  } else {
      $currentArray = array_fill(0, $totalLengthFire, 0);
  }

  // Inicializa a última linha como a fonte do fogo com intensidade máxima
  for ($x = 0; $x < $widthFire; $x++) {
      $currentArray[(($heightFire - 1) * $widthFire) + $x] = count($colorPatter) - 1;
  }

  function calcFirePropagation(&$fireArray, $widthFire, $heightFire, $totalLengthFire) {
    for ($h = 0; $h < $heightFire; $h++) { // De baixo para cima
      for ($w = 0; $w < $widthFire; $w++) {
        $index = $h * $widthFire + $w;
        $decay = rand(0, 2);
        $intensity = 36;
        
        $newValue = (isset($fireArray[$index + $heightFire]) ? $fireArray[$index + $heightFire] : 0) - $decay;

        if (!($index >= $totalLengthFire - $widthFire)) {
          if ($index + $heightFire + $decay >= count($fireArray)) {
            $fireArray[$index] = $newValue;
          }

          $intensity = $newValue;

          if ($intensity < 0) {
            $intensity = 0;
          }
        }


        if ($index >= $decay) {
          $fireArray[$index - $decay] = $intensity;
        }
      }
    }
  }

  calcFirePropagation($currentArray, $widthFire, $heightFire, $totalLengthFire);

  function gerarTabela($arrayCellFire) {
      global $heightFire, $widthFire, $colorPatter;
      $arrayJson = json_encode($arrayCellFire);
      echo '<table id="tabela-fire" data-current-array=\'' . htmlspecialchars($arrayJson, ENT_QUOTES, 'UTF-8') . '\'>';
      for ($i = 0; $i < $heightFire; $i++) {
          echo '<tr>';
          for ($j = 0; $j < $widthFire; $j++) {
              $index = $arrayCellFire[$i * $widthFire + $j] ?? 0;
              echo '<td style="background-color: ' . $colorPatter[$index] . ';"></td>';
          }
          echo '</tr>';
      }
      echo '</table>';
  }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Fire Table</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: #777;
    }
    table {
      border-collapse: collapse;
    }
    td {
      width: 10px;
      height: 10px;
      padding: 0;
    }
  </style>
</head>
<body>
  <div id="fire-container">
    <?php gerarTabela($currentArray); ?>
  </div>
  <script>
    let tabela = document.getElementById('tabela-fire');
    let currentArray = tabela ? JSON.parse(tabela.getAttribute('data-current-array')) : [];
    function atualizarTabela() {
      fetch(`index.php?currentArrayCellFire=${encodeURIComponent(JSON.stringify(currentArray))}`)
        .then(response => response.text())
        .then(data => {
          document.getElementById('fire-container').innerHTML = data;
          let novaTabela = document.getElementById('tabela-fire');
          if(novaTabela) {
            currentArray = JSON.parse(novaTabela.getAttribute('data-current-array'));
          }
        })
        .catch(error => console.error('Erro ao atualizar:', error));
    }

    setInterval(atualizarTabela, 100);
  </script>
</body>
</html>
