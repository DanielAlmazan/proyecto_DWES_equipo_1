<?php
	// We're not including the header.php file, because I didn't manage to
	// make it work with the relative path.
	$title = "Index";
	
	// We'll need the function euros2pesetas, so we include the file
	include("Actividades_Tema3/MyPHPLibraries/conversor.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='Actividades_Tema3/css/style.css'>
	<link rel='stylesheet' href='Actividades_Tema3/css/tablesStyle.css'>
	<title><?=$title?></title>
</head>
<body>
	<header>
		<h1>Probando el LocalHost del repositorio</h1>
	</header>
	<main>
	
<?php
	// Defining the array for a very special receipt
	$ticket = array(
		"Arroz Basmati" => 1.5,
		"Cebolla" => 0.8,
		"Calabacín" => 1.2,
		"Zanahoria" => 1.2,
		"Patata" => 0.5,
		"Jengibre" => 0.5,
		"Curry" => 2.4,
		"Soja Texturizada" => 2.5,
		"Cocaína" => 1000
	);
	
	?>
	<table>
		<thead>
			<tr>
				<th>Producto</th>
				<th>Precio</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			// We iterate through the array, printing the product and its price
			foreach ($ticket as $product => $price) {
				/* echo "<tr>
					<td>$product</td>
					<td>$price € / " . euros2pesetas($price) . " pts</td>
					</tr>"; */
			}
			
			?>
				</tbody>
				<tfoot>
					<tr>
						<td>Total</td>
						<td>
							<?php
								// We print the total price of the ticket
								/* echo array_sum($ticket) . " € ";
								echo "/ " . euros2pesetas(array_sum($ticket)) . " pts"; */
							?>
						</td>
					</tr>
				</tfoot>
			</table>
			
<?php
	// Including the file footer.php
	include("Actividades_Tema3/MyPHPLibraries/footer.php");
?>
