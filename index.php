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
$sqlQueryPersonnages = '
	SELECT p.nom_personnage
	FROM personnage p
	';
$personnagesStatement = $mysqlClient->prepare($sqlQueryPersonnages);
$personnagesStatement->execute();
$personnages = $personnagesStatement->fetchAll();

$sqlQuerySpecialites = '
	SELECT l.nom_lieu
	FROM lieu l
	INNER JOIN personnage p ON p.id_lieu = l.id_lieu
	';
$specialitesStatement = $mysqlClient->prepare($sqlQuerySpecialites);
$specialitesStatement->execute();
$specialites = $specialitesStatement->fetchAll();

$sqlQueryLieux = '
	SELECT s.nom_specialite
	FROM specialite s
	INNER JOIN personnage p ON p.id_specialite = s.id_specialite
	';
$lieuxStatement = $mysqlClient->prepare($sqlQueryLieux);
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
echo '<tr>';
foreach ($personnages as $personnage) {
	echo '<td>'.$personnage['nom_personnage'].'</tr></td>';
};
echo '</tr>';
echo '<tr>';
foreach ($specialites as $specialite) {
	echo '<td>'.$specialite['nom_specialite'].'</tr></td>';
};
echo '</tr>';
echo '<tr>';
foreach ($lieux as $lieu) {
	echo '<td>'.$lieu['nom_lieu'].'</tr></td>';
};
echo '</tr>';

 ?>
	</table>
<?php
?>
</body>
</html>






