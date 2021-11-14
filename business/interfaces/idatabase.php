<?php
namespace cst323;

/**
 * IDatabase
 * Interface for the database connection objects.
 */
interface IDatabase {    
    /**
     * getConnection
     * Return the connection to a database using PDO
     * @return PDO
     */
    public function getConnection();
}
?>