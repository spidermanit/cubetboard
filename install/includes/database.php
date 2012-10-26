<?php

class Database {

    /**
     * Creates the database in the mysql server.
     * @param array $post, the database server details
     * @return boolean True if database created successfully
     */
    function createDatabase($post) {

        $con = $this->connectToServer($post, null);

        $result = $con->query("CREATE DATABASE IF NOT EXISTS " . $post['db_name']);

        $con->close();

        return true;
    }

    /**
     * Connects to the mysql server.
     * @param array $post, the database server details
     * @return Returns a MySQL link identifier on success, false otherwise
     */
    function connectToServer($post) {

        $con = new mysqli($post['db_host'], $post['db_user'], $post['db_password'], $post['db_name']);
//        var_dump(mysqli_connect_errno());die;
        if (mysqli_connect_errno()) {
            return false;
        } else {
            return $con;
        }
    }

    /**
     * Creates the database table in the mysql server.
     * @param array $post, the database server details
     * @return boolean True if tables created successfully
     */
    function createTable($post) {

        $con = $this->connectToServer($post);

        if (!$con) {
            return false;
        } else {

            if (isset($post['db_sample']) && !empty($post['db_sample'])) {
                $sqlFileName = 'cubetboard_sample.sql';
            } else {
                $sqlFileName = 'cubetboard_empty.sql';
            }

            $dbQuery = file_get_contents('assets/sql/' . $sqlFileName);
            
//            $prefixedQuery  = str_replace('%PREFIX%', '', $dbQuery);

//            $con->multi_query($prefixedQuery);
            $con->multi_query($dbQuery);
            
            $con->close();

            return true;
        }
    }

    /**
     * Inserts the admin username and password in the admin_users table.
     * @param array $post, the database server details
     * @return boolean True if tables created successfully
     */
    function createAdmin($post) {

        $con = $this->connectToServer($post);

        if (!$con) {
            return false;
        } else {

            sleep(10);

            $query = "INSERT INTO `admin_users` (username, password) VALUES 
            ('" . $post['admin_username'] . "', '" . md5($post['admin_pass']) . "')";

            $con->query($query);

            if (mysqli_errno($con)) {
//                var_dump(mysqli_error($con));
//                die;
                return false;
            } else {
                $con->close();

                return true;
            }
        }
    }

}

?>
