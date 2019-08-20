<DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf8">
		<title>Olá PHP</title>
	</head>
	<body>
		<?php
			//Boas vidas em php
			echo "Olá Mundão <br>";
			
			//Váriaveis
			$idade = 33;
			$nome = "Bruno";
			echo "Nome: $nome <br> Idade: $idade <br>";
			
			//Conversão de váriaves
			$result = "2";
			echo "Resultado do exemplo 1: " . $result;
			var_dump($result);
			
			$result = $result + 1;
			echo "Resultado do exemplo 2: " . $result;
			var_dump($result);
			
			$result = $result + 3.5;
			echo "Resultado do exemplo 3: " . $result;
			var_dump($result);
			
			$result = 11;
			var_dump($result);
			$result = (double) $result;
			echo "Resultado do exemplo 4: " . $result;
			var_dump($result);
			
			$result = 7.9;
			var_dump($result);
			$result = (int) $result;
			echo "Resultado do exemplo 5: " . $result;
			var_dump($result);
			
			//Operadores aritiméticos
			$a = 2;
			$b = 4;
			$c = 7;
			
			$result = $a + $b;
			echo "Soma: " . $result . "<br>";
			
			$result = $b - $a;
			echo "Subtração: " . $result . "<br>";
			
			$result = $b * $a;
			echo "Multiplicação: " . $result . "<br>";
			
			$result = $b / $a;
			echo "Divisão: " . $result . "<br>";
			
			$result = $c % $a;
			echo "Resto da divisão: " . $result . "<br>";
			
			$result = $c / $a;
			echo "Valor: R$ " . number_format($result, 2, ",", ".") . "<br>";
			
			//Operadores de atribuição
			$a = 1;
			$b = 2;
			$c = 3;
			$result = 0;
			
			$result += $a; //é a mesma coisa que: $result = $result + $a;
			echo "Resultado da Adição: " . $result . "<br>";
			
			$result -= $b;
			echo "Resultado da Subtração: " . $result . "<br>";
			
			$result *= $b;
			echo "Resultado da Multiplicação: " . $result . "<br>";
			
			$result /= $b;
			echo "Resultado da Divisão: " . $result . "<br>";
			
			$result %= $b;
			echo "Resultado da Módulo: " . $result . "<br>";

			$d = "Bom";
			$d .= "Dia";
			echo "Resultado da concatenação: " . $d . "<br>";
			
			//Operador de incremento e decremento
			echo "<h3>Pós-incremento</h3>";
			$a = 5;
			echo "Deve ser o número 5: " . $a++ . "<br>";
			echo "Deve ser o número 6: " . $a . "<br>";
			
			echo "<h3>Pré-incremento</h3>";
			$a = 5;
			echo "Deve ser o número 6: " . ++$a . "<br>";
			echo "Deve ser o número 6: " . $a . "<br>";
			
			echo "<h3>Pós-decremento</h3>";
			$a = 5;
			echo "Deve ser o número 5: " . $a-- . "<br>";
			echo "Deve ser o número 4: " . $a . "<br>";
			
			echo "<h3>Pré-decremento</h3>";
			$a = 5;
			echo "Deve ser o número 4: " . --$a . "<br>";
			echo "Deve ser o número 4: " . $a . "<br>";
			
			//Operadores de comparação
			$a = 10;
			$b = 8;
			
			if($a == $b){
				echo "Verdadeiro: o número $a é igual ao valor $b <br>"; 
			}else{
				echo "Falso: o número $a e diferente do valor $b <br>";
			}
			
			
			
			
			
			
			
			
		?>
	</body>
</html>