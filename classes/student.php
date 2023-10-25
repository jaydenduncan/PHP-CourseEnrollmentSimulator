<?php
class Student {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $studentNum;
    private $username;
    private $password;
    private $pfp;
    private $classes;
    private $registered;

    public function __construct($id, $fn, $ln, $email, $stuNum, $username, $password, $pfp, $registered) {
        $this->id = $id;
        $this->firstName = $fn;
        $this->lastName = $ln;
        $this->email = $email;
        $this->studentNum = $stuNum;
        $this->username = $username;
        $this->password = $password;
        $this->pfp = $pfp;
        $this->classes = array();
        $this->registered = $registered;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setFirstName($fn) {
        $this->firstName = $fn;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setLastName($ln) {
        $this->lastName = $ln;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setStudentNum($stuNum) {
        $this->studentNum = $stuNum;
    }

    public function getStudentNum() {
        return $this->studentNum;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPfp($pfp) {
        $this->pfp = $pfp;
    }

    public function getPfp($pfp) {
        return $this->pfp;
    }

    public function addClass($stuClass) {
        array_push($this->classes, $stuClass);
    }
    
    public function getClasses() {
        return $this->classes;
    }

    public function setRegistered($registered) {
        $this->registered = $registered;
    }

    public function getRegistered(){
        return $this->registered;
    }

    public function __toString() {
        return "ID: " . $this->id . "<br>" .
        "First Name: " . $this->firstName . "<br>" . 
        "Last Name: " . $this->lastName . "<br>" . 
        "Email: " . $this->email . "<br>" . 
        "Student Number: " . $this->studentNum . "<br>" . 
        "Username: " . $this->username . "<br>" . 
        "Password: " . $this->password . "<br>" . 
        "PFP URL: " . $this->pfp . "<br>" . 
        "Registered: " . $this->registered . "<br>";
    }
}