<?php

echo '<html>';
echo '<head>';
echo '<title>Accueil</title>';

// Here, we're adding the links to Bootstrap CSS and jQuery via their CDNs
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.css"> ';
echo '<script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.min.js">';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>';
echo '<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=647c5fc840353a0019caf23d&product=sop" async="async"></script>';
echo '<link rel="stylesheet" type="text/css" href="css/accueil.css">';
echo '<link rel="stylesheet" type="text/css" href="css/global.css">';
echo '<link rel="stylesheet" type="text/css" href="css/carrousel.css">';
include 'login-check.php';
echo '</head>';
echo '<body>';
?>
<nav class="bg">

	<?php
	include 'navbar.php';
	?>
	<div class="video-container">
		<video
			src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/public/Images/Video/ECE%20undefined.mp4?t=2023-06-05T13%3A21%3A46.734Z"
			autoplay muted loop></video>
	</div>



	<h2> ECE'In est le novueau réseau social en vogue à visée des objectifs professionnels. Que
		vous soyez étudiant/e
		de licence, master ou doctorat, ou étudiant/e apprenti dans un entreprise, ou étudiant/e qui
		cherche un stage dans une entreprise ou peut-être un/e enseignant/e ou employé de l’Ecole qui
		cherche des partenaires pour votre projet de recherche ou autre, ce site web s'adresse à toutes et
		à tous qui souhaitent prendre leur vie professionnelle au sérieux, trouver de nouvelles
		opportunités pour développer leur carrière et se connecter avec d'autres personnes pour des buts
		professionnels.</h2>
	<?php
	include 'caroussel.php';
	?>

	<!--
======================================================
		Partie Evénement de la semaine
======================================================
-->

	<?php
	$sql = "SELECT tabimages
	FROM evenement
	WHERE DATE(date) >= '2023-06-05'
	  AND DATE(date) <= '2023-06-11';
	";
	$sql2 = "SELECT nom, organisateur, description
FROM evenement
WHERE DATE(date) >= '2023-06-05'
  AND DATE(date) <= '2023-06-11';
";
	try {
		// Création du contact avec la BDD
		$conn = new PDO($dsn);
		$stmt = $conn->query($sql);
		$stmt2 = $conn->query($sql2);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	?>

	<?php $row['tabimages'] = trim($row['tabimages'], '{}');
	$decoded_images = json_decode($row['tabimages'], true); ?>
	<?php $row2 = $stmt2->fetch(PDO::FETCH_ASSOC) ?>

	<div class="eventsemaine">

		<h3 style="text-align: center; margin:3%; text-decoration:underline;">Evénement de la semaine :</h3>
		<h2 style="text-align: center; margin:1%">
			<?php echo htmlspecialchars($row2['nom']); ?>
		</h2>
		<h3 style="text-align: center; margin:1%">
			<?php echo htmlspecialchars($row2['organisateur']); ?>
		</h3>



		<div class="carousel" id="test1">
			<?php
			$valueCar = 1;
			$tabimages = explode(',', $row['tabimages']);
			?>
			<?php foreach ($tabimages as $image):
				if ($valueCar == 1) { ?>
					<input type="radio" name="item" value="<?php echo $valueCar; ?>" checked>
					<div><img src="<?php echo trim($image); ?>" style="height : 350px; width : 600px"></div>
					<?php $valueCar++;
				} else { ?>
					<input type="radio" name="item" value="<?php echo $valueCar; ?>">
					<div><img src="<?php echo trim($image); ?>" style="height : 350px; width : 600px"></div>
					<?php
					$valueCar++;
				}
				?>
			<?php endforeach; ?>
		</div>

	</div>

	<!--
======================================================
		Partie Evénements de mes amis (nouveaux posts)
======================================================
-->


	<h1 style="padding:10% ">Evénements de mes amis</h1>
	<?php
	try {
		// create a PostgreSQL database connection
		$conn = new PDO($dsn);

		// query to check if username exists
		$sql = "SELECT amis FROM users WHERE iduser = ?";
		$stmt = $conn->prepare($sql);

		// bind parameters and execute
		$stmt->execute([$iduser]);

		$amis = $stmt->fetch();



		if ($amis && $amis['amis'] !== null) {
			$amis = explode(',', trim($amis['amis'], '{}')); // convert the array string into a PHP array
	
			// Check that the user has friends
			if (!empty($amis)) {
				$combined = [];

				foreach ($amis as $ami) {
					// get posts
					$stmt = $conn->prepare("SELECT idpost, users.nom as username, lieu as title, date, descriptionpost as description, photo, datepublication FROM posts INNER JOIN users ON posts.iduser = users.iduser WHERE posts.iduser = ? ORDER BY datepublication DESC");
					$stmt->execute([$ami]);
					$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
				?>
				<div class="scroll-container">
					<table>
						<tbody>
							<?php


							foreach ($posts as $item) {
								?>
								<div class="scroll-page" id="eventperso">
									<div style="padding:2%; border:solid;">

										<?php
										echo "<div>";

										if ($item['title'] !== NULL) {
											echo "<h2>" . htmlspecialchars($item['title']) . "</h2>";

										}
										if (!empty($item['photo'])) {
											?>
											<img src="<?php echo trim($item['photo']); ?>" style="height : 350px; width : 600px"> <?php
										}

										echo "<p>Posté par: " . htmlspecialchars($item['username']) . "</p>"; ?>
										<h6 style="font-style:italic">Date de publication:
											<?php echo htmlspecialchars($item['datepublication']) ?>
										</h6>
										<br>

										<?php
										echo "<h6>" . htmlspecialchars($item['description']) . "</h6>";
										echo "</div>";
										$idpost = $item['idpost'];
										echo '<script>';
										echo 'var idpost = "' . $idpost . '";';
										echo '</script>';
										echo '<script>';
										echo 'var iduser = "' . $iduser . '";';
										echo '</script>';
										// Now you can use $likeCount in your HTML to display the number of likes for the post
						
										?>

										<!-- script pour changer les variables à chaque post -->
										<script>
											// Récupérer le bouton de like par son ID
											var boutonl = document.getElementById('boutonlike');

											// Changer la valeur du bouton
											boutonl.value = idpost;

										</script>

										<!-- Partie like -->
										<form>
											<button type="submit" id="like-<?php echo $idpost; ?>" name="ajouterlike"
												style="margin-top:10%; margin-left:3%;" class="like-button">like</button>
										</form>

										<script>
											$(document).ready(function () {

												$('.like-button').each(function () {
													var buttonId = $(this).attr('id');
													var idpost = buttonId.split('-')[1];

													$.ajax({
														url: 'get_likes',
														method: 'GET',
														data: {
															idpost: idpost
														},
														success: function (data) {
															$('#' + buttonId).text('like (' + data + ')');
														},
														error: function (xhr, status, error) {
															console.error(xhr);
														}
													});
												});

												// Handle click event on like button
												$('.like-button').click(function (e) {
													e.preventDefault();

													// Disable the button immediately to prevent multiple clicks
													$(this).prop('disabled', true);

													var buttonId = $(this).attr('id');
													var idpost = buttonId.split('-')[1];

													$.ajax({
														url: 'like',
														method: 'POST',
														data: {
															idpost: idpost,
															iduser: iduser
														},
														success: function (data) {
															$('#' + buttonId).text('like (' + data + ')');
														},
														error: function (xhr, status, error) {
															console.error(xhr);
														},
														complete: function () {
															// Re-enable the button when the AJAX request is complete
															$('#' + buttonId).prop('disabled', false);
														}
													});
												});
											});

										</script>

										<!-- Partie partage -->
										<!-- ShareThis BEGIN -->
										<p>Pour partager : </p>
										<div class="sharethis-inline-share-buttons">

										</div><!-- ShareThis END -->


									</div>


									<!-- Code php pour envoyer le commentaire -->
									<?php
									try {
										if ($_POST) {
											if (isset($_POST['ajouterlike']) && $_POST['ajouterlike'] == $idpost) {
												//On se connecte à la BDD
												$conn = new PDO($dsn);

												//On insère les données reçues
												$sql = "INSERT INTO like(idpost, iduser) VALUES(post, :personne)";
												$stmt = $conn->prepare($sql);
												$stmt->bindParam(':post', $idpost);
												$stmt->bindParam(':personne', $iduser);

												$stmt->execute();

												//Message de confirmation pour l'utilisateur
												echo "Vous aimez ce post";
											}
										}

									} catch (PDOException $e) {
										echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
									}
									?>

									<?php

							}
							?>
						</tbody>
					</table>
				</div>
				<?php

			} else {
				echo "This user has no friends.";
			}
		} else {
			echo "This user has no friends.";
		}

	} catch (PDOException $e) {
		// report error message
		echo $e->getMessage();
	}
	?>

	<!--
======================================================
		Partie derniers évènements de l'auteur
======================================================
-->


	<?php
	try {
		// create a PostgreSQL database connection
		$conn = new PDO($dsn);

		// get posts
		$stmt = $conn->prepare("SELECT lieu as title, date, descriptionpost as description, datepublication FROM posts WHERE iduser = ? ORDER BY datepublication DESC");
		$stmt->execute([$iduser]);
		$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// get formations
		$stmt = $conn->prepare("SELECT nom as title, (datedebut, ', ', datefin) as date,  institution as description, datepublication FROM formation WHERE iduser = ? ORDER BY datepublication DESC");
		$stmt->execute([$iduser]);
		$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// get projets
		$stmt = $conn->prepare("SELECT nom as title, NULL as date, description, datepublication FROM projet WHERE iduser = ? ORDER BY datepublication DESC");
		$stmt->execute([$iduser]);
		$projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// combine all and sort by datepublication
		$combined = array_merge($posts, $formations, $projets);
		usort($combined, function ($a, $b) {
			return $b['datepublication'] <=> $a['datepublication'];
		});



	} catch (PDOException $e) {
		// report error message
		echo $e->getMessage();
	}
	?>

	<br><br>
	<h1 style="padding:10% ">Mes événements</h1>


	<nav class="myEvents" style="margin-bottom:5%">
		<div class="scroll-container">
			<table>
				<tbody>
					<?php

					// display
					foreach ($combined as $item) {
						?>
						<div class="scroll-page" id="eventperso">
							<div style="padding:2%; border:solid;">

								<?php
								echo "<div>";
								echo "<h2>" . htmlspecialchars($item['title']) . "</h2>";
								?>
								<h6 style="font-style:italic">Date de publication:
									<?php echo htmlspecialchars($item['datepublication']); ?>
								</h6>

								<?php
								if ($item['description'] !== NULL) {
									echo "<h6>" . htmlspecialchars($item['description']) . "</h6>";
								}
								echo "</div>";
								?>

							</div>

							<script>
								function openForm(id) {
									document.getElementById("form-" + id).style.display = "block";
								}

								function closeForm(id) {
									document.getElementById("form-" + id).style.display = "none";
								}
							</script>

						<?php } ?>
				</tbody>
			</table>
		</div>
	</nav>


	<?php include 'foot.php'; ?>


</nav>
</body>

</html>