<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return; // securiser

# donner un exemple d'url pour le formulaire de choix
define('URLS_OPENWEB_EXEMPLE', '/articles/xhtml_une_heure<br />/openwebgroup/bios/collectif');
# specifier le form de config utilise pour ces urls
define('URLS_OPENWEB_CONFIG', '');

// TODO: une interface permettant de verifier qu'on veut effectivment modifier
// une adresse existante
define('CONFIRMER_MODIFIER_URL', false);
if (!defined('_URLS_ARBO_MAX')) define('_URLS_ARBO_MAX', 55);
if (!defined('_URLS_ARBO_MIN')) define('_URLS_ARBO_MIN', 3);

$GLOBALS['url_arbo_terminaisons']=array(
 'rubrique' => '/',
  'mot' => '',
  'groupe' => '/',
  'defaut' => '');
define ('_url_arbo_minuscules',1);
$GLOBALS['url_arbo_parents']=array(
	'article'=>array('id_rubrique','rubrique'),
	'rubrique'=>array('id_parent','rubrique'),
	'breve'=>'',
	'site'=>'',
	'mot'=>''
);
$GLOBALS['url_arbo_types']=array(
	'rubrique'=>'', // pas de type pour les rubriques
	'article'=>'',
	'breve'=>'',
	'mot'=>'',
	'auteur' => 'openwebgroup/bios'
);

include_spip("urls/arbo");

function renseigner_url_openweb($type,$id_objet){
	return renseigner_url_arbo($type,$id_objet);
}
/**
 * API : retourner l'url d'un objet si i est numerique
 * ou decoder cette url si c'est une chaine
 * array([contexte],[type],[url_redirect],[fond]) : url decodee
 *
 * http://doc.spip.org/@urls_arbo_dist
 *
 * @param string|int $i
 * @param string $entite
 * @param string|array $args
 * @param string $ancre
 * @return array|string
 */
function urls_openweb_dist($i, $entite, $args='', $ancre='') {

	// cas particulier des urls auteur : on les decode comme une url propre
	// car toute l'url est en base
	if (strpos($i,"/openwebgroup/bios/")!==false){
		// mais on force le html base quand meme !
		define('_SET_HTML_BASE',1);
		$urls_propres = charger_fonction("propres","urls");
		define('_FORCE_URLS_PROPRES',true); // pour ne pas etre renvoye vers arbo
		$res = $urls_propres($i, $entite, $args, $ancre);
		return $res;
	}
	elseif (strpos($i,"/openwebgroup/plan/")!==false){
		// recuperer les &debut_xx;
		if (is_array($args))
			$contexte = $args;
		else
			parse_str($args,$contexte);
		$contexte['page'] = 'plan';
		return array($contexte, 'plan', null, null);
	}
	elseif (strncmp($i,"/recherche/",11)==0){
		// recuperer les &debut_xx;
		if (is_array($args))
			$contexte = $args;
		else
			parse_str($args,$contexte);
		$contexte['page'] = 'recherche';
		return array($contexte, 'recherche', null, null);
	}
	elseif (strncmp($i,"/actualite/",11)==0){
		// recuperer les &debut_xx;
		if (is_array($args))
			$contexte = $args;
		else
			parse_str($args,$contexte);
		$contexte['page'] = 'actualites';
		return array($contexte, 'actualites', null, null);
	}


	$urls_arbo = charger_fonction("arbo","urls");
	return $urls_arbo($i, $entite, $args, $ancre);

}

?>