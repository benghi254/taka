<?php
class Address
{

    private $addressId;
    private $userId;
    private $county;
    private $constituency;
    private $ward;
    private $description;
    private $holder;
    

    /**
     * Admin constructor.
     * @param $addressId
     * @param $userId
     * @param $county
     * @param $constituency
     * @param $ward
     * @param $description
     * @param $holder
     */
    public function __construct($addressId, $county, $constituency, $ward, $description, $holder, $userId)
    {
        $this->addressId = $addressId;
        $this->userId = $userId;
        $this->county = $county;
        $this->constituency = $constituency;
        $this->ward = $ward;
        $this->description = $description;
        $this->holder = $holder;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->addressId;
    }

    /**
     * @param mixed $id
     */
    public function setId($addressId)
    {
        $this->addressId = $addressId;
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
    public function getHolder()
    {
        return $this->holder;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setHolder($holder)
    {
        $this->holder = $holder;
    }


}