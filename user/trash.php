<?php
class Trash
{

    private $trashId;
<<<<<<< HEAD
    
=======
    private $userId;
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
    private $weight;
    private $collectDate;
    private $ward;
    private $description;
<<<<<<< HEAD
    private $trashType;
    private $userId;
    private $issueDate;
    
    

    /**
     * Trash constructor.
     * @param $trashId
     * 
=======
    private $issueDate;
    private $trashType
    

    /**
     * Admin constructor.
     * @param $trashId
     * @param $userId
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
     * @param $weight
     * @param $collectDate
     * @param $ward
     * @param $description
     * @param $trashType
<<<<<<< HEAD
     * @param $userId
=======
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
     * @param $issueDate
     */
    public function __construct($trashId, $weight, $collectDate, $ward, $description, $trashType, $userId, $issueDate)
    {
<<<<<<< HEAD
        $this->trashId = $trashId;       
=======
        $this->trashId = $trashId;
        $this->userId = $userId;
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
        $this->weight = $weight;
        $this->collectDate = $collectDate;
        $this->ward = $ward;
        $this->description = $description;
<<<<<<< HEAD
        $this->trashType = $trashType;
        $this->userId = $userId;
        $this->issueDate = $issueDate;
        
=======
        $this->issueDate = $issueDate;
        $this->trashType = $trashType;
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
    }

    /**
     * @return mixed
     */
    public function getTrashId()
    {
<<<<<<< HEAD
        return $this->trashId;
    }

    /**
     * @param mixed $trashId
     */
    public function setTrashId($trashId)
    {
        $this->trashId = $trashId;
=======
        return $this->addressId;
    }

    /**
     * @param mixed $id
     */
    public function setTrashId($addressId)
    {
        $this->addressId = $addressId;
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
<<<<<<< HEAD
     * @param mixed $userId
=======
     * @param mixed $username
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
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
<<<<<<< HEAD
     * @param mixed $weight
=======
     * @param mixed $username
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
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
<<<<<<< HEAD
     * @param mixed $collectDate
=======
     * @param mixed $username
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
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
<<<<<<< HEAD
     * @param mixed $ward
=======
     * @param mixed $role
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
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
<<<<<<< HEAD
     * @param mixed $description
=======
     * @param mixed $password
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
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
<<<<<<< HEAD
     * @param mixed $issueDate
=======
     * @param mixed $dateCreated
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
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
<<<<<<< HEAD
     * @param mixed $trashType
=======
     * @param mixed $dateCreated
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
     */
    public function setTrashType($trashType)
    {
        $this->trashType = $trashType;
    }


}