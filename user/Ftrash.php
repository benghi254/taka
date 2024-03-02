<?php

include_once 'trash.php';
include_once '../modals/Database.php';

class Ftrash
{

    static function addNewTrash(trash $trash)
    {   //Function to add a new user to the system

        $con=Database::getConnection();
        $req=$con->prepare('INSERT INTO trash(Weight,collectDay,Ward,Details,issueDate,trashType,userId) VALUES(?,?,?,?,?,?,?)');
        $req->execute(array(
            $address->getWeight(),
            $address->getCollectDate(),
            $address->getWard(),
            $address->getDescription(),
            $address->getIssueDate(),
            $address->getUserId()
            
        ));
        
    }

    static function updateTrash(Trash $trash)
    {   // Function to update a specific user

        $con=Database::getConnection();
        $req=$con->prepare('UPDATE trash SET Weight=?,collectDay=?,Ward=?,Details=?,issueDate=?,trashType=?,userId=? WHERE trashId=?');
        $req->execute(array(
            $address->getWeight(),
            $address->getCollectDate(),
            $address->getWard(),
            $address->getDescription(),
            $address->getIssueDate(),
            $address->getUserId(),
            $address->getTrashId()
        ));
    }

  
  
    static function getAllTrash()
    {   // Function to get all the contractor admin

        $con=Database::getConnection();
        $req=$con->prepare('SELECT * FROM trash ');
        $req->execute(array());
        return $req->fetchAll();
    }



    static function getTrashInfoById($userId)
    {   // Function to get information on a specific admin

        $con=Database::getConnection();
        $req=$con->prepare('SELECT * FROM trash WHERE userId=?');
        $req->execute(array($userId));
        return $req->fetch();
    }
    



    static function deleteTrash($trashId)
    {   // Function to delete an admin from the system

        $con=Database::getConnection();
        $req=$con->prepare('DELETE FROM address WHERE trashId=?');
        $req->execute(array($trashId));

    }
}