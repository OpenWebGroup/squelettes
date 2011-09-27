<?php
//$type_urls = "openweb";
$toujours_paragrapher = true;

// La coquette se passe des class="spip" !
// Cf.: http://romy.tetue.net/spip.php?article415
function coquette($letexte) {
	$letexte = str_replace('i class="spip"', 'i', $letexte);
	$letexte = str_replace('strong class="spip"', 'strong', $letexte);
	$letexte = str_replace('p class="spip"', 'p', $letexte);
	$letexte = str_replace('p class="spip_note"', 'p', $letexte);
	$letexte = str_replace('h3 class="spip"', 'h3', $letexte);
	$letexte = str_replace('hr class="spip"', 'hr', $letexte);
	$letexte = str_replace('class="spip_logos"', '', $letexte);
	$letexte = str_replace('class=\'spip_logos\'', '', $letexte);
	$letexte = str_replace('blockquote class="spip"', 'blockquote', $letexte);
	$letexte = str_replace('<code class="spip_code"', '<code', $letexte);
	$letexte = str_replace('<code class=\'spip_code\'', '<code', $letexte);
	$letexte = str_replace('<form action="/" method="get"><div><textarea', '<textarea', $letexte);
	$letexte = str_replace('</textarea></div></form>', '</textarea>', $letexte);
	$letexte = str_replace(' class="spip_in"', '', $letexte);
	// Ensuite je renomme :
	$letexte = str_replace('spip_out', 'out', $letexte);
	$letexte = str_replace('spip_url', 'out', $letexte);
	$letexte = str_replace('spip_glossaire', 'out', $letexte);
	$letexte = str_replace('spip_note', 'note', $letexte);
	$letexte = str_replace('spip_cadre', 'cadre', $letexte);
return $letexte;
}

$quota_cache = 100;

function autoriser_travaux($faire,$quoi,$id,$qui){
        return intval($qui['id_auteur'])?true:false;
}
