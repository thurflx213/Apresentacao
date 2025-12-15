<?php
namespace App\Koketsu\Database;


use PDO;
use PDOException;
use Exception;
use App\Koketsu\Database\Config;

class Database {
    private static $instance = null;
    private $conn;
    private $config;

    private function __construct() {
        $this->config = Config::get();
        $dbConfig = $this->config['database'];
        $driver = $dbConfig['driver'];
        try {
            $persistent = isset($dbConfig['options']['persistent']) && $dbConfig['options']['persistent'] === true;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            if ($persistent) {
                $options[PDO::ATTR_PERSISTENT] = true;
            }

            switch ($driver) {
                case 'mysql':
                    $mysqlConfig = $dbConfig['mysql'];
                    $dsn = "mysql:host={$mysqlConfig['host']};dbname={$mysqlConfig['db_name']};charset={$mysqlConfig['charset']}";
                    $this->conn = new PDO($dsn, $mysqlConfig['username'], $mysqlConfig['password'], $options);
                    break;
                case 'sqlite':
                    $sqliteConfig = $dbConfig['sqlite'];
                    $dsn = "sqlite:{$sqliteConfig['path']}";
                    $this->conn = new PDO($dsn, null, null, $options);
                    break;
                case 'sqlsrv':
                    $sqlsrvConfig = $dbConfig['sqlsrv'];
                    $dsn = "sqlsrv:Server={$sqlsrvConfig['host']};Database={$sqlsrvConfig['db_name']}";
                    $this->conn = new PDO($dsn, $sqlsrvConfig['username'], $sqlsrvConfig['password'], $options);
                    break;
                case 'pgsql':
                    $pgsqlConfig = $dbConfig['pgsql'];
                    $dsn = "pgsql:host={$pgsqlConfig['host']};port={$pgsqlConfig['port']};dbname={$pgsqlConfig['db_name']}";
                    $this->conn = new PDO($dsn, $pgsqlConfig['username'], $pgsqlConfig['password'], $options);
                    break;
                default:
                    throw new Exception("Driver de banco desconhecido: {$driver}");
            }
        } catch (PDOException $exception) {
            error_log('Database connection error: ' . $exception->getMessage());
            throw $exception;
        } catch (Exception $exception) {
            error_log('Database error: ' . $exception->getMessage());
            throw $exception;
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->conn;
    }

    /**
     * Alias semântico para obter a conexão PDO
     *
     * @return PDO
     */
    public static function getConnection() {
        return self::getInstance();
    }

    public static function destroyInstance(){
        if (self::$instance !== null) {
            if (isset(self::$instance->conn)) {
                self::$instance->conn = null;
            }
            self::$instance = null;
        }
    }

}