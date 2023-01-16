<?php

class Vaults{


    private $conn;

    public function __construct($db){
        $this -> conn = $db;
    }

    public function getEachVault() {
        try {
            $stmt = "SELECT c.username, v.count_no, c.customer_id, v.vault_id, v.principal_amount * v.count_no as grand FROM vault as v INNER JOIN customer as c on c.customer_id = v.customer_id";
            $result = $this -> conn -> query($stmt);
            return $result;
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
    }

    public function getDaysCount($id) {
        try {
            $sql = "SELECT count_no as count from vault where vault_id = $id";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $total_days = $stmt -> fetch();
            $result = $total_days['count'];
            return $result;
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
        
    }

    public function getAllColumns($field){
        try {
            $stmt = "SELECT  $field from vault";
            $result = $this -> conn -> query($stmt);
            return $result;
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        } 
    }

    public function getSavings($id) {
        try {
            $sql = "SELECT principal_amount * count_no as saved from vault where vault_id = $id";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $total_savings = $stmt -> fetch();
            $result = $total_savings['saved'];
            return $result;
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
    }

    public function getVaultOwner($id){
        try {
            $sql = "SELECT c.username as user FROM customer as c INNER JOIN vault AS v ON v.customer_id = c.customer_id where v.vault_id = $id";
            $stmt = $this -> conn ->prepare($sql);
            $stmt -> execute();
            $user_dict = $stmt -> fetch();
            return $user_dict['user'];
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
        
    }

    public function getCharge($id){
        try {
            $sql = "SELECT principal_amount as principal from vault WHERE vault_id = $id";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $principal_dict = $stmt -> fetch();
            $sql = "SELECT count_no as count from vault WHERE vault_id = $id";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $count_dict = $stmt -> fetch();
            if ($count_dict['count'] % 31 == 0 ) {
                $incomplete_month = 0;
            } else {
                $incomplete_month = 1;
            }
            $full_month = floor($count_dict['count']/31) ;
            $num_months = $full_month + $incomplete_month;
            if ($principal_dict['principal'] > 1000 ) {
                $charge = 1000;
            } else {
                $charge = $principal_dict['principal'];
            }
            $total_charge = $num_months * $charge;
            return $total_charge;
        } catch (\Throwable $th) {
            
        }
    }

    public function getMonthCount($id){
        try {
            $sql = "SELECT count_no from vault WHERE  vault_id = $id";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $count_dict = $stmt -> fetch();
            if ($count_dict['count_no'] % 31 == 0 ) {
                $incomplete_month = 0;
            } else {
                $incomplete_month = 1;
            }
            $full_month = floor($count_dict['count_no']/31) ;
            $num_months = $full_month + $incomplete_month;
            return $num_months;
    
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
    }

    public function getPrincipal($id){
        try {
            $sql = "SELECT principal_amount as principal FROM vault WHERE vault_id = $id";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $result = $stmt -> fetch();
            return $result['principal'];
        } catch (\Throwable $th) {
            //throw $th;
        }
    }



    public function getIndividualVault($v_id){
        try {
            $sql = "SELECT c.username, v.principal_amount, v.count_no FROM vault as v INNER JOIN customer as c ON c.customer_id= v.customer_id WHERE v.vault_id = $v_id";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $result = $stmt -> fetch();
            return $result;
    
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
    }


    public function getProfitEstimate(){
        try {
            $sql = "SELECT SUM((count_no / 31) * principal_amount) AS profit FROM vault;";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $result = $stmt -> fetch();
            return $result;
            
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
    }



    public function getTotalSavings(){
        try {
            $sql = "SELECT SUM(principal_amount*count_no) AS total FROM vault;";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $result = $stmt -> fetch();
            return $result;
            
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
    }



    public function getVaultCount(){
        try {
            $sql = "SELECT COUNT(*) AS count FROM vault;";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $result = $stmt -> fetch();
            return $result;
            
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
    }


    

    public function payIntoVault($newcount, $id){
        try {
            $sql = "UPDATE vault SET count_no=$newcount WHERE vault_Id = $id;";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            return true;
            
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
    }



    public function withdrawFromVault($id){
        try {
            $sql = "UPDATE vault SET count_no = 0 WHERE vault_Id = $id;";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            return true;
            
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
    }

    public function delete($id){
        try {
            $sql = "DELETE FROM vault WHERE vault_id = $id";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            return true;
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
    }

    public function insert($user, $principal, $count){
        try {
            $sql = "INSERT INTO vault (customer_id, principal_amount, count_no) VALUES ($user, $principal, $count);";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            return true;
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
        

    }
}










class Users{
    private $conn;

    public function __construct($conn){
        $this -> conn = $conn;
    }

    public function getUserCount($username){
        $qry = "SELECT COUNT(*) as num FROM users WHERE username = '$username'";
        $stmt = $this -> conn -> prepare($qry);
        $stmt -> execute();
        $result = $stmt -> fetch();
        return $result;
    }

    public function insertUser($username, $password){
        $newpassword = md5($password.$username);
            try {
                $userCount = $this -> getUserCount($username);
                if ($userCount['num'] == 0) {
                    $sql = "INSERT INTO users(username, password) VALUES('$username', '$newpassword')";
                    $stmt = $this -> conn -> prepare($sql);
                    $stmt -> execute();
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                throw $e -> getMessage();
                return false;
            }
        }


        function getUser($username, $password){
            try {
                    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
                    $stmt = $this -> conn -> prepare($sql);
                    $stmt -> execute();
                    $result = $stmt -> fetch();
                    return $result;
        
            } catch (PDOException $e) {
                throw $e -> getMessage();
                return false;
            }
        }
}



class Customers{
    private $conn;
    private $table = 'customer';

    public function __construct($db){
        $this -> conn = $db;
    }

    public function selectAll(){
        try {
            $sql = "SELECT * FROM customer";
            $result = $this -> conn -> query($sql);
            return $result;
        } catch (PDOException $e) {
            throw $e -> getMessage;
        }
    }

    public function insert($username){
        try {
            $sql="INSERT INTO customer (username) VALUES ('$username')";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            return true;
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
    }

    public function delete($id){
        try {
            $sql = "DELETE FROM customer WHERE vault_id = $id";
        } catch (PDOException $e) {
            throw $e -> getMessage();
            return false;
        }
    }
    
}


?>