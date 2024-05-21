<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Personnages Gaulois</title>
</head>
<body>
	<table>
		<caption> Personnages d'Astérix</caption>
	</table>

<?php
try {
$mysqlClient = new PDO(
	'mysql:host=localhost;dbname=gaulois;charset=utf8',
	'root',
	'');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table personnage
$sqlQuery = 'SELECT * FROM personnage';
$personnagesStatement = $mysqlClient->prepare($sqlQuery);
$personnagesStatement->execute();
$personnages = $personnagesStatement->fetchAll();
// On récupère tout le contenu de la table spécialité
$sqlQuery = 'SELECT * FROM specialite';
$specialitesStatement = $mysqlClient->prepare($sqlQuery);
$specialitesStatement->execute();
$specialites = $specialitesStatement->fetchAll();
// On récupère tout le contenu de la table lieu
$sqlQuery = 'SELECT * FROM lieu';
$lieuxStatement = $mysqlClient->prepare($sqlQuery);
$lieuxStatement->execute();
$lieux = $lieuxStatement->fetchAll();
?>
	<tr>
		<th>Personnage</th>
		<th>Spécialité</th>
		<th>Lieu</th>
	</tr>

<!-- On affiche chaque personnage un par un -->
<?php
foreach ($personnages as $personnage) {
?>
    <p><?php echo $personnage['nom_personnage']; ?></p>
<?php
}
?>
</body>
</html>






