<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 09/06/19
 * Time: 18:45
 */

class UsersTable {
	public static $name = 'utilisateur';
	public static $primary_key = 'identifiant_utilisateur';

	public static $fields = [
		'identifiant_utilisateur' => [
			'filter'  => FILTER_VALIDATE_INT,
			'options' => [
				"min_range" => 0
			]
		],
		'civilite' => [
			'filter'  => FILTER_VALIDATE_REGEXP,
			'options' => [
				'regexp' => '/M\.|Mlle|Mme|[0-3]/'
			]
		],
		'nom' => [
			'filter' => FILTER_SANITIZE_STRING,
			'flags'  => FILTER_FLAG_NO_ENCODE_QUOTES
		],
		'prenom' => [
			'filter' => FILTER_SANITIZE_STRING,
			'flags'  => FILTER_FLAG_NO_ENCODE_QUOTES
		],
		'date_naissance' => [
			'filter'  => FILTER_VALIDATE_REGEXP,
			'options' => [
				'regexp' => '/[0-9]{4}-[0-9]-[0-9]/'
			]
		],
		'adresse' => [
			'filter' => FILTER_SANITIZE_STRING,
			'flags'  => FILTER_FLAG_NO_ENCODE_QUOTES
		],
		'adresse_complement' => [
			'filter' => FILTER_SANITIZE_STRING,
			'flags'  => FILTER_FLAG_NO_ENCODE_QUOTES
		],
		'mot_de_passe' => [
			'filter' => FILTER_CALLBACK,
			'options' => 'hashUserPassword'
		],
		'email' => [
			'filter' => FILTER_VALIDATE_EMAIL
		],
		'tel' => [
			'filter' => FILTER_VALIDATE_REGEXP,
			'options' => [
				'regexp' => '/([+0-9][-. ]?){10,13}/'
			]
		],
		'mobile' => [
			'filter' => FILTER_VALIDATE_REGEXP,
			'options' => [
				'regexp' => '/([+0-9][-. ]?){10,13}/'
			]
		],
		'abonnement_newsletter' => [
			'filter' => FILTER_VALIDATE_BOOLEAN
		],
		'pref_accept_conditions' => [
			'filter' => FILTER_VALIDATE_BOOLEAN
		],
		'pref_heure_repas' => [
			'filter' => FILTER_VALIDATE_REGEXP,
			'options' => [
				'regexp' => '/([0-9]{2}:?){3}/'
			]
		],
		'date_dispo' => [
			'filter' => FILTER_VALIDATE_REGEXP,
			'options' => [
				'regexp' => '/[0-9]{4}-[0-9]-[0-9]/'
			]
		],
		'motivation' => [
			'filter' => FILTER_VALIDATE_REGEXP,
			'options' => [
				'regexp' => '/0|10|20|30|40|50|60|70|80|90|100/'
			]
		],
		'biographie' => [
			'filter' => FILTER_SANITIZE_STRING,
			'flags'  => FILTER_FLAG_NO_ENCODE_QUOTES
		],
		'philosophie' => [
			'filter' => FILTER_SANITIZE_STRING,
			'flags'  => FILTER_FLAG_NO_ENCODE_QUOTES
		],
		'code_commune_insee_ville' => [
			'filter'  => FILTER_VALIDATE_REGEXP,
			'options' => [
				'regexp' => '/[a-z0-9]{3,15}/i'
			]
		],
		'id_langage_langage' => [
			'filter' => FILTER_VALIDATE_INT
		],
		'id_niveau_niveau' => [
			'filter' => FILTER_VALIDATE_INT
		]
	];
}