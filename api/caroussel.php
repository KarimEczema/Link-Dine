<script type="text/javascript">
	$(document).ready(function() {
		var $img = $('#carrousel img');
		var max = $img.length;
		var i = 0; // compteur
		$img.css('margin-left','0').css('display', 'none'); //on cache les images
		$img.eq(i).css('display', 'inline'); //on affiche l'image courante
		$img.eq(i+1).css('margin-left','50px').css('display', 'inline');
		$img.eq(i+2).css('margin-left','50px').css('display', 'inline');
		$img.eq(i+3).css('margin-left','50px').css('display', 'inline');
		//si on clique sur « next » ou « > »
		$('.next').click(function () { // image suivante
			 i+=4; // on incrémente le compteur
			 if (i < max-4) {
			 i = i+4;
			 $img.css('margin-left','0').css('display', 'none'); //on cache
			 $img.eq(i).css('display', 'inline'); //on affiche l'image courante
			 $img.eq(i+1).css('margin-left','50px').css('display', 'inline');
			 $img.eq(i+2).css('margin-left','50px').css('display', 'inline');
			 $img.eq(i+3).css('margin-left','50px').css('display', 'inline'); } else {
			 i = 0;
			 }
		 });
		//si on clique sur « prev » ou « < »
		 $('.prev').click(function () { // groupe des images précédentes
			 i-=4; // on décrémente le compteur
			 if (i >= 0) {
			 $img.css('margin-left','0').css('display', 'none'); //on cache
			 $img.eq(i).css('display', 'inline'); //on affiche l'image courante
			 $img.eq(i+1).css('margin-left','50px').css('display', 'inline');
			 $img.eq(i+2).css('margin-left','50px').css('display', 'inline');
			 $img.eq(i+3).css('margin-left','50px').css('display', 'inline');
			 } else {
			 i = 0;
			 }
		 });
	});
</script>