<?php
class Trash
{

    private $trashId;
    private $userId;
    private $weight;
    private $collectDate;
    private $ward;
    private $description;
    private $issueDate;
    private $trashType
    

    /**
     * Admin constructor.
     * @param $trashId
     * @param $userId
     * @param $weight
     * @param $collectDate
     * @param $ward
     * @param $description
     * @param $issueDate
     */
    public function __construct($trashId, $weight, $collectDate, $ward, $description, $issueDate, $trashType,$userId)
    {
        $this->trashId = $trashId;
        $this->userId = $userId;
        $this->weight = $weight;
        $this->collectDate = $collectDate;
        $this->ward = $ward;
        $this->description = $description;
        $this->issueDate = $issueDate;
        $this->trashType = $trashType;
    }

    /**
     * @return mixed
     */
    public function getTrashId()
    {
        return $this->addressId;
    }

    /**
     * @param mixed $id
     */
    public function setTrashId($addressId)
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
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $username
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getCollectDate()
    {
        return $this->collectDate;
    }

    /**
     * @param mixed $username
     */
    public function setCollectDate($collectDate)
    {
        $this->collectDate = $collectDate;
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
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setIssueDate($issueDate)
    {
        $this->issueDate = $issueDate;
    }
      /**
     * @return mixed
     */
    public function getTrashType()
    {
        return $this->trashType;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setTrashType($trashType)
    {
        $this->trashType = $trashType;
    }


}