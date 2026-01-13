<?php

include_once 'trash.php';
include_once '../modals/Database.php';

class Ftrash
{

    static function addNewTrash(trash $trash)
    {   //Function to add a new user to the system

        $con=Database::getConnection();
        $req=$con->prepare('INSERT INTO trash(Weight,collectDay,Ward,Details,trashType,userId) VALUES(?,?,?,?,?,?)');
        $req->execute(array(
            $trash->getWeight(),
            $trash->getCollectDate(),
            $trash->getWard(),
            $trash->getDescription(),
            $trash->getTrashType(),
            $trash->getUserId()
            
        ));
        
    }

    static function updateTrash(Trash $trash)
    {   // Function to update a specific user

        $con=Database::getConnection();
        $req=$con->prepare('UPDATE trash SET Weight=?,collectDay=?,Ward=?,Details=?,issueDate=?,trashType=?,userId=? WHERE trashId=?');
        $req->execute(array(
            $trash->getWeight(),
            $trash->getCollectDate(),
            $trash->getWard(),
            $trash->getDescription(),
            $trash->getIssueDate(),
            $trash->getUserId(),
            $trash->getTrashId()
        ));
    }

  
  
    static function getAllTrash()
    {   // Function to get all the contractor admin

        $con=Database::getConnection();
        $req=$con->prepare('SELECT * FROM trash ');
        $req->execute(array());
        return $req->fetchAll();
    }


    static function getTrash($trashId)
    {   // Function to get all the contractor admin

        $con=Database::getConnection();
        $req=$con->prepare('SELECT FROM trash where trashId=?');
        $req->execute(array($trashId));
        return $req->fetch();
    }
    
    static function geLastTrashId()
    {   // Function to get all the contractor admin

        $con=Database::getConnection();
        $lastId= $con->lastInsertId();
        return $lastId;
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