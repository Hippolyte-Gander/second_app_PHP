<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Personnages Gaulois</title>
</head>
<body>

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
$sqlQuery = '
	SELECT p.nom_personnage, s.nom_specialite, l.nom_lieu
	FROM personnage p
	INNER JOIN specialite s ON s.id_specialite = p.id_specialite
	INNER JOIN lieu l ON l.id_lieu = p.id_lieu
	ORDER BY p.nom_personnage
	';
$personnagesStatement = $mysqlClient->prepare($sqlQuery);
$personnagesStatement->execute();
$personnages = $personnagesStatement->fetchAll();

?>
	<table>
		<thead>
			<tr>
				<th>Nom du Personnage</th>
				<th>Spécialité</th>
				<th>Lieu</th>
			</tr>
		</thead>
		<tbody>
<!-- On affiche chaque personnage un par un -->
<?php
foreach ($personnages as $personnage) {
	echo '<tr>';
	echo '<td>'.htmlspecialchars($personnage['nom_personnage']).'</td>';
	echo '<td>'.htmlspecialchars($personnage['nom_specialite']).'</td>';
	echo '<td>'.htmlspecialchars($personnage['nom_lieu']).'</td>';
	echo '</tr>';
};
?>
</tbody>
    </table>


</body>
</html>






