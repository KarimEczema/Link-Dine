<nav class="navigation">

	<div class="nav-left">
		<a href="accueil"><img
				src="https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/public/Images/Image/LOGO.png?t=2023-06-05T17%3A06%3A28.235Z"></a>
	</div>
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

<script> window.addEventListener("scroll", function () {
		var navbar = document.querySelector(".navigation");
		navbar.classList.toggle("scrolled", window.scrollY > 0);
	});
</script>