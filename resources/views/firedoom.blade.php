<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fire DOOM</title>
        <style>
            body{
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
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased">
        <script>
            const colorPatter = {!! $patterJS !!};
            const heightFire = {{ $heightFire }};
            const widthFire = {{ $widthFire }};

            let arrayCellFire = {!! $arrayJS !!};
        
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
