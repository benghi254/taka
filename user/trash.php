<?php
class Trash
{

    private $trashId;
    
    private $weight;
    private $collectDate;
    private $ward;
    private $description;
    private $trashType;
    private $userId;
    private $issueDate;
    
    

    /**
     * Trash constructor.
     * @param $trashId
     * 
     * @param $weight
     * @param $collectDate
     * @param $ward
     * @param $description
     * @param $trashType
     * @param $userId
     * @param $issueDate
     */
    public function __construct($trashId, $weight, $collectDate, $ward, $description, $trashType, $userId, $issueDate)
    {
        $this->trashId = $trashId;       
        $this->weight = $weight;
        $this->collectDate = $collectDate;
        $this->ward = $ward;
        $this->description = $description;
        $this->trashType = $trashType;
        $this->userId = $userId;
        $this->issueDate = $issueDate;
        
    }

    /**
     * @return mixed
     */
    public function getTrashId()
    {
        return $this->trashId;
    }

    /**
     * @param mixed $trashId
     */
    public function setTrashId($trashId)
    {
        $this->trashId = $trashId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
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
     * @param mixed $weight
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
     * @param mixed $collectDate
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
     * @param mixed $ward
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
     * @param mixed $description
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
     * @param mixed $issueDate
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
     * @param mixed $trashType
     */
    public function setTrashType($trashType)
    {
        $this->trashType = $trashType;
    }


}