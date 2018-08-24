<?php
//Classe définissant la méthode de connexion à la base de données
class Connection
{
    public static function set($config)
	{
	    try
        {
            return new PDO(
                $config['dsn'] . ';dbname=' . $config['dbname'],
                $config['user'],
                $config['pwd'],
                $config['options']
            );
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
	}
}