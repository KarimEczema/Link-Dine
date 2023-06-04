<header>
		<div class="container-fluid">
			<div class="row">
				 <div class="col-sm-8"><h3>ECE-in : Social Media Professionnel de l'ECE Paris</h3></div>
				 <div class="col-sm" ><img src="image" width="121" height="49.5"></div>
			</div>		
		</div>
</header>
	
<nav class = "navigation">
	<ul id="liste1">
		<li id="accueil"><a href="accueil">Accueil</a></li>
		<li id="reseau"><a href="reseau">Mon réseau</a></li>
		<li id="vous"><a href="vous">Vous</a></li>
		<li id="notifs"><a href="notifications">Notifications</a></li>
		<li id="emploisnav"><a href="emplois">Emplois</a></li>
		<li id="chat"><a href="chat">Messagerie</a></li>
		<?php if ($iduser == 1): ?>
			<li id="admin"><a href="admin">Admin</a></li>
		<?php else: ?>
			<li id="auteur"><a href="auteur">Auteur</a></li>
		<?php endif; ?>
		<li id="deco" style="float:right"><a href="index">Deconnexion</a></li>
	</ul>
</nav>