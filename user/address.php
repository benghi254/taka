<?php
class Address
{

    private $id;
    private $userId;
    private $county;
    private $constituency;
    private $ward;
    private $description;
    private $holder
    

    /**
     * Admin constructor.
     * @param $id
     * @param $username
     * @param $role
     * @param $password
     * @param $dateCreated
     */
    public function __construct($id, $userId, $county, $constituency, $ward, $description, $dateCreated)
    {
        $this->id = $id;private $dateCreated;
        $this->userId = $userId;
        $this->county = $county;
        $this->constituency = $constituency;
        $this->ward = $ward;
        $this->descriptio = $description;
        $this->dateCreated = $dateCreated;
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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $username
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @param mixed $username
     */
    public function setCounty($county)
    {
        $this->county = $county;
    }

    /**
     * @return mixed
     */
    public function getConstituency()
    {
        return $this->constituency;
    }

    /**
     * @param mixed $username
     */
    public function setConstituency($constituency)
    {
        $this->constituency = $constituency;
    }

    /**
     * @return mixed
     */
    public function getWard()
    {
        return $this->ward;
    }

    /**
     * @param mixed $role
     */
    public function setWard($ward)
    {
        $this->ward = $ward;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $password
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }


}