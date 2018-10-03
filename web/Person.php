<?php

class Person
{
    private $id;
    private $firstname;
    private $lastname;
    private $username;
    private $email;
    private $birthdate;
    private $phone;
    private $passwordhash;
    private $street;
    private $homenumber;
    private $city;
    private $zip;
    private $country;
    private $role;
    private $lang;
    private $resetPassword;

    public function __construct()
    {
    }

    public function createFromDb($id, $firstname, $lastname, $username, $email, $birthdate, $phone, $street, $homenumber, $city, $zip, $country, $role, $lang, $resetPassword)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->birthdate = $birthdate;
        $this->phone = $phone;
        $this->street = $street;
        $this->homenumber = $homenumber;
        $this->city = $city;
        $this->zip = $zip;
        $this->country = $country;
        $this->role = $role;
        $this->lang = $lang;
        $this->resetPassword = $resetPassword;
    }

    public function createFromRegister($firstname, $lastname, $username, $email, $birthdate, $phone, $passwordhash, $street, $homenumber, $city, $zip, $country, $lang)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->birthdate = $birthdate;
        $this->phone = $phone;
        $this->passwordhash = $passwordhash;
        $this->street = $street;
        $this->homenumber = $homenumber;
        $this->city = $city;
        $this->zip = $zip;
        $this->country = $country;
        $this->role = 1;
        $this->lang = $lang;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param mixed $birthdate
     */
    public function setBirthdate($birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPasswordhash()
    {
        return $this->passwordhash;
    }

    /**
     * @param mixed $passwordhash
     */
    public function setPasswordhash($passwordhash): void
    {
        $this->passwordhash = $passwordhash;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street): void
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getHomenumber()
    {
        return $this->homenumber;
    }

    /**
     * @param mixed $homenumber
     */
    public function setHomenumber($homenumber): void
    {
        $this->homenumber = $homenumber;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip): void
    {
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param mixed $lang
     */
    public function setLang($lang): void
    {
        $this->lang = $lang;
    }

    /**
     * @return mixed
     */
    public function getResetPassword()
    {
        return $this->resetPassword;
    }

    /**
     * @param mixed $resetPassword
     */
    public function setResetPassword($resetPassword): void
    {
        $this->resetPassword = $resetPassword;
    }

    public function __toString()
    {
        return "id = ".$this->getId()
            ."<br />firstname = ".$this->getFirstname()
            ."<br />lastname = ".$this->getLastname()
            ."<br />username = ".$this->getUsername()
            ."<br />email = ".$this->getEmail()
            ."<br />birthdate = ".$this->getBirthdate()
            ."<br />phone = ".$this->getPhone()
            ."<br />street = ".$this->getStreet()
            ."<br />homenumber = ".$this->getHomenumber()
            ."<br />city = ".$this->getCity()
            ."<br />zip = ".$this->getZip()
            ."<br />country = ".$this->getCountry()
            ."<br />role = ".$this->getRole()
            ."<br />lang = ".$this->getLang();
    }

}