<?php
    const MENSAGEM = 'Olá Mundo';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Fire DOOM</title>
    <style>
      body {
        display: flex;
        justify-content: center;
        align-content: center;
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
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link
      href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
      rel="stylesheet"
    />
  </head>
  <body class="antialiased">
  <h1><?php echo MENSAGEM; ?></h1>

    <script>
      const colorPatter = [
        "#070707",
        "#1f0707",
        "#2f0f07",
        "#470f07",
        "#571707",
        "#671f07",
        "#771f07",
        "#8f2707",
        "#9f2f07",
        "#af3f07",
        "#bf4707",
        "#c74707",
        "#df4f07",
        "#df5707",
        "#df5707",
        "#d75f07",
        "#d75f07",
        "#d7670f",
        "#cf6f0f",
        "#cf770f",
        "#cf7f0f",
        "#cf8717",
        "#c78717",
        "#c78f17",
        "#c7971f",
        "#bf9f1f",
        "#bf9f1f",
        "#bfa727",
        "#bfa727",
        "#bfaf2f",
        "#b7af2f",
        "#b7b72f",
        "#b7b737",
        "#cfcf6f",
        "#dfdf9f",
        "#efefc7",
        "#ffffff",
      ];
      const heightFire = 50;
      const widthFire = heightFire;

      let arrayCellFire = Array(heightFire * widthFire).fill(0);

      const tableElement = document.createElement("table");
      document.body.appendChild(tableElement);

      const tbodyElement = document.createElement("tbody");
      tableElement.appendChild(tbodyElement);

      const renderFireTable = () => {
        const tbodyElementInnerHTML = [
          ...arrayCellFire.map((intensity, index) => {
            let innerHTML = "";
            let rest = index % widthFire;
            if (rest === 0) {
              innerHTML += index ? `</tr><tr>` : `<tr>`;
            }

            innerHTML += `<td id="${Math.floor(
              index / widthFire
            )}|${rest} -> ${index}" style="background: ${
              colorPatter[intensity]
            };"></td>`;

            return innerHTML;
          }),
          "</tr>",
        ];
        tbodyElement.innerHTML = tbodyElementInnerHTML.join("");
      };

      const calcFirePropagation = () => {
        arrayCellFire.forEach((v, index) => {
          const decay = Math.floor(Math.random() * 3);
          let intensity = 36;
          if (!(index >= widthFire * heightFire - widthFire)) {
            if (index + heightFire + decay >= arrayCellFire.length) {
              return arrayCellFire[index + heightFire] - decay;
            }

            intensity = arrayCellFire[index + heightFire] - decay;

            if (intensity < 0) {
              intensity = 0;
            }
          }
          arrayCellFire[index - decay] = intensity;
        });

        renderFireTable();
      };

      setInterval(calcFirePropagation, 100);

      calcFirePropagation();
    </script>
  </body>
</html>

