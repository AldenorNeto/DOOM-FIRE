# Doom Fire em JavaScript e PHP

Este repositório contém uma implementação do famoso efeito Doom Fire em duas linguagens: **JavaScript** e **PHP**. O efeito de fogo foi originalmente popularizado pelo jogo **DOOM** e aqui ele é recriado utilizando técnicas simples de manipulação de arrays e cores.

![Image](https://github.com/user-attachments/assets/cab320e3-3333-45d3-81c3-0ead2e61b560)

## Como Executar

### JavaScript

Para rodar a versão em **JavaScript**, basta abrir o arquivo `index.html` em qualquer navegador moderno.

### PHP

Para rodar a versão em **PHP**, execute o seguinte comando no terminal dentro do diretório do projeto:

```bash
php -S localhost:8000
```

Em seguida, acesse `http://localhost:8000` no seu navegador.

## Algoritmo de Propagação do Fogo

As funções responsáveis por calcular a propagação do fogo são muito semelhantes entre as duas linguagens. Elas seguem a mesma lógica de espalhamento do calor pelo array de células.

### Implementação em JavaScript:

```jsx
const calcFirePropagation = () => {
    arrayCellFire.forEach((_, index) => {
        const decay = Math.floor(Math.random() * 3);
        let intensity = 36;

        const newValue = arrayCellFire[index + heightFire] - decay;

        if (!(index >= totalLengthFire - widthFire)) {
            if (index + heightFire + decay >= arrayCellFire.length) {
                return newValue;
            }

            intensity = newValue;
            if (intensity < 0) {
                intensity = 0;
            }
        }

        arrayCellFire[index - decay] = intensity;
    });

    updateDOM(arrayCellFire);
};
```

### Implementação em PHP:

```php
function calcFirePropagation(&$fireArray, $widthFire, $heightFire, $totalLengthFire) {
    for ($h = 0; $h < $heightFire; $h++) {
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
```

Ambas seguem a mesma lógica de cálculo de propagação, ajustando a intensidade do fogo com base na célula inferior e um fator de decaimento aleatório.
