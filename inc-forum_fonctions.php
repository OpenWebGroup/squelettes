<?php


function filtre_nofollow_dist($str){
	if($str) {
		$liens = extraire_balises($str,'a');
		foreach($liens as $lien){
			$rel = extraire_attribut($lien,'rel');
			$rel = ($rel?"$rel ":"")."nofollow";
			$ln = inserer_attribut($lien,'rel',$rel);
			$str = str_replace($lien,$ln,$str);
		}
	}
	return $str;
}
