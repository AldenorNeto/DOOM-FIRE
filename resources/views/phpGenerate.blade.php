<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fire DOOM</title>
        <style>
            body{
                background: #777;
            }

            table {
                border-collapse: collapse; 
            }

            td,
            th {
                padding: 8px;
                text-align: center; 
            }

            td {
                padding: 5px 5px;
                width: 0;
                height: 0;
            }
        </style>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased">
        <?php
            function generateTable($heightFire, $widthFire, $arrayCellFire, $colorPatter) {
                echo '<table><tbody>';

                for ($row = 0; $row < $heightFire; $row++) {
                    echo '<tr>';

                    for ($column = 0; $column < $widthFire; $column++) {
                        $index = $row * $widthFire + $column;
                        $cellValue = isset($colorPatter[$arrayCellFire[$index]]) ? $colorPatter[$arrayCellFire[$index]] : '';

                        echo '<td style="background: ' . $cellValue . ';">';
                        echo '.';
                        echo '</td>';
                    }
                    echo '</tr>';
                }
                echo '</tbody></table>';
            }

            function calcFirePropagation($heightFire, $widthFire, $arrayCellFire, $colorPatter) {
                foreach ($arrayCellFire as $index => $cellValue) {
                    $decay = rand(1, 2);
                    $intensity = 36;
                    if (!($index >= $widthFire * $heightFire - $widthFire)) {
                        if ($index + $heightFire + $decay >= count($arrayCellFire)) {
                            return $arrayCellFire[$index + $heightFire] - $decay;
                        }
            
                        $intensity = $arrayCellFire[$index + $heightFire] - $decay;
            
                        if ($intensity < 0) {
                            $intensity = 0;
                        }
                    }
                    $arrayCellFire[$index - $decay] = $intensity;
                }
                generateTable($heightFire, $widthFire, $arrayCellFire, $colorPatter);
            }

            calcFirePropagation($heightFire, $widthFire, $array, $colorPatter);
        ?>
  </body>
</html>
