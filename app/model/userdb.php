<?php
/**
 * Created by PhpStorm.
 * User: aghozlu-pc
 * Date: 1/4/2020
 * Time: 6:09 PM
 */

class Userdb
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }


	public function selectall(){
		
		$sql = "SELECT * FROM `user`";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
	}
    public function signin($email, $pass, $emus)
    {

        $sql = "SELECT Email, Username, Password FROM `user` WHERE $emus = :email AND Password = :pasword";
        $query = $this->db->prepare($sql);
        $query->bindParam(':email', $email);
        $query->bindParam(':pasword', $pass);
        $query->execute();
        return $query->fetchAll();
    }



    public function singup($email, $pass, $token)
    {

        $sql = "INSERT INTO `user` (Email, Password, Token) VALUES (:email, :pass, :token)";
        $query = $this->db->prepare($sql);
        $query->bindParam(':email', $email);
        $query->bindParam(':pass', $pass);
        $query->bindParam(':token', $token);
        //$parameters = array(':image' => $img, ':titles' => $title, ':texts' => $text);
        $query->execute();

    }


    // check user
    public function checkemail($email)
    {
        $sql = "SELECT * FROM `user` WHERE Email = :email";
        $query = $this->db->prepare($sql);
        $query->bindParam(':email', $email);
        $query->execute();
        return $query->fetchAll();

    }
    public function checkusername($username)
    {
        $sql = "SELECT * FROM `user` WHERE Username = :username";
        $query = $this->db->prepare($sql);
        $query->bindParam(':username', $username);
        $query->execute();
        return $query->fetchAll();
    }


	// example ->  sortby("user", "id", "DESC");
    public function sortby($table,$row ,$sort){

        $sql ="SELECT * FROM $table ORDER BY $row $sort "; // $row = id , $sort = ASC & DESC
        $query = $this->db->prepare($sql);

        $query->execute();
        return $query->fetchAll();
    }
}
