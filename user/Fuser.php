<?php

include_once 'User.php';
include_once 'Database.php';

class Fuser
{

    static function addNewUser(User $user)
    {   //Function to add a new admin to the system

        $con=Database::getConnection();
        $req=$con->prepare('INSERT INTO user SET fullname=?,email=?,phone=?,password=?,action=?');
        $req->execute(array(
            $user->getFullname(),
            $user->getEmail(),
            $user->getPhone(),
            sha1($user->getPassword()),
            $user->getAction(),
            $user->getDateCreated()
        ));
        return $con->lastInsertId();
    }

    static function updateUser(Admin $admin)
    {   // Function to update a specific admin

        $con=Database::getConnection();
        $req=$con->prepare('UPDATE admin user SET fullname=?,email=?,phone=?,password=?,action=? WHERE userId=?');
        $req->execute(array(
            $user->getFullname(),
            $user->getEmail(),
            $user->getPhone(),
            sha1($user->getPassword()),
            $user->getAction(),
            $user->getId()
        ));
    }

    static function checkEmail($email)
    {   //Function to check if a username already exist in the database

        $con=Database::getConnection();
        $req=$con->prepare('SELECT * FROM user WHERE email=?');
        $req->execute(array($email));
        if($req->rowCount()==0)
        {
            return true;
        }
        return false;
    }
  
    static function getAllUser()
    {   // Function to get all the contractor admin

        $con=Database::getConnection();
        $req=$con->prepare('SELECT * FROM user ');
        $req->execute(array());
        return $req->fetchAll();
    }



    static function getInfoUserById($idUser)
    {   // Function to get information on a specific admin

        $con=Database::getConnection();
        $req=$con->prepare('SELECT * FROM user WHERE userId=?');
        $req->execute(array($idUser));
        return $req->fetch();
    }
    
    static function login($email,$password)
    {   // Function to Login

        $con=Database::getConnection();
        $req=$con->prepare('SELECT * FROM user WHERE email=? AND password=?');
        $req->execute(array($email,sha1($password)));
        if($req->rowCount()==0)
        {
            return false;
        }
        return $req->fetch();
    }

    static function checkLastUser($idPart)
    {   // Function to check the number of admin in the system in order to avoid deleting all the admin

        $con=Database::getConnection();
        $req=$con->prepare('SELECT * FROM usersWHERE idPart=? AND role!=?');
        $req->execute(array($idPart,'monitor'));

        return $req->rowCount();
    }


    static function deleteUser($idUser)
    {   // Function to delete an admin from the system

        $con=Database::getConnection();
        $req=$con->prepare('DELETE FROM user WHERE userId=?');
        $req->execute(array($idUser));

    }
}