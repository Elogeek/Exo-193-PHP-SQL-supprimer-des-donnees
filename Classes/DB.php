<?php

/**
 * Handle MySQL Connection with PDO.
 * Class DB
 */
class DB
{
    private string $server = 'localhost';
    private string $db = 'table_test_deux';
    private string $user = 'root';
    private string $pwd = 'dev';

    private static PDO $dbInstance;

    /**
     * DbStatic constructor.
     */
    public function __construct(string $server,string  $db, string $user, string $pwd) {

        $this->server = $server;
        $this->db = $db;
        $this->user = $user;
        $this->pwd = $pwd;

        try {
            self::$dbInstance = new PDO("mysql:host=$this->server;dbname=$this->db;charset=utf8", $this->user, $this->pwd);
            self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
        return self::$dbInstance;
    }

    /**
     * Return PDO instance.
     */
    public static function getInstance(): ?PDO {
        if( is_null(self::$dbInstance) ) {
            new self();
        }
        return self::$dbInstance;
    }

    /**
     * Avoid instance to be cloned.
     */
    public function __clone() {}
}
