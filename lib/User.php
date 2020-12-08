<?php
include_once('Session.php');
include('Database.php');
	
class User
{
	private $db;

	public function __construct()
	{
		$this->db=new Database();
	}

	public function userRegistration($data)
	{
		$name=$data['name'];
		$username=$data['username'];
		$email=$data['email'];
		$password=md5($data['password']);
		$chk_email=$this->emailCheck($email);

		if ($name=="" || $username=="" || $email=="" || $password=="") {
			$msg="<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty</div>";
			return $msg;
		}

		if (strlen($username)<3) {
			$msg="<div class='alert alert-danger'><strong>Error ! </strong>Username is too short</div>";
			return $msg;
		}elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
			$msg="<div class='alert alert-danger'><strong>Error ! </strong>Username must only contain alphanumerical, dashes, underscores!</div>";
		}

		if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
			$msg="<div class='alert alert-danger'><strong>Error ! </strong>The email address is not valid</div>";
			return $msg;
		}

	if ($chk_email == true) {
		$msg="<div class='alert alert-danger'><strong>Error ! </strong>The email address already exist</div>";
			return $msg;
	}

	$sql="INSERT INTO user (name, username, email, password) values(:name, :username, :email, :password)";
	$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':name',$name);
		$query->bindValue(':username',$username);
		$query->bindValue(':email',$email);
		$query->bindValue(':password',$password);
		$result = $query->execute();
		if ($result) {
			$msg="<div class='alert alert-success'><strong>Success ! </strong>You have been registered!!</div>";
			return $msg;
		}
		else{
			$msg="<div class='alert alert-danger'><strong>Sorry ! </strong>There has been a problem to insert</div>";
			return $msg;
		}
}

	public function emailCheck($email){
		$sql="SELECT email from user WHERE email= :email";
		$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':email',$email);
		$query->execute();
		if ($query->rowCount()>0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function getLoginUser($email, $password){
		$sql="SELECT * from user WHERE email= :email AND password= :password LIMIT1";
		$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':email',$email);
		$query->bindValue(':password',$password);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	public function userLogin($data){
		$email=$data['email'];
		$password=md5($data['password']);
		$chk_email=$this->emailCheck($email);

		if ($email=="" || $password=="") {
			$msg="<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty</div>";
			return $msg;
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
			$msg="<div class='alert alert-danger'><strong>Error ! </strong>The email address is not valid</div>";
			return $msg;
		}

	if ($chk_email == false) {
		$msg="<div class='alert alert-danger'><strong>Error ! </strong>The email address Not exist</div>";
			return $msg;
	}
	$result=$this->getLoginUser($email, $password);
	if ($result) {
		Session::init();
		Session::set("login", true);
		Session::set("id", $result->id);
		Session::set("name", $result->name);
		Session::set("username", $result->username);
		Session::set("loginmsg", "<div class='alert alert-success'><strong>Success ! </strong>You are logged in</div>");
		header("Location: index.php");
	}
	else{
		$msg="<div class='alert alert-danger'><strong>Error ! </strong>Data not found</div>";
			return $msg;
	}
	}
}
?>