<?php

include_once 'address.php';
include_once '../modals/Database.php';
include_once '../modals/FaddressGeo.php';

class Faddress
{

    static function addNewAddress(Address $address)
    {   //Function to add a new user to the system

        $con=Database::getConnection();
        $req=$con->prepare('INSERT INTO address(County,Constituency,Ward,Details,Holder,userId) VALUES(?,?,?,?,?,?)');
        $req->execute(array(
            $address->getCounty(),
            $address->getConstituency(),
            $address->getWard(),
            $address->getDescription(),
            $address->getHolder(),
            $address->getUserId()
            
        ));
        
        // Get the inserted address ID
        $addressId = $con->lastInsertId();
        
        // Save address with geo coordinates
        if ($addressId) {
            FaddressGeo::saveAddressWithGeo(
                $addressId,
                $address->getUserId(),
                $address->getCounty(),
                $address->getConstituency(),
                $address->getWard(),
                $address->getDescription()
            );
        }
        
        return $addressId;
    }

    static function updateAddress(Address $address)
    {   // Function to update a specific user

        $con=Database::getConnection();
        $req=$con->prepare('UPDATE address SET County=?,Constituency=?,Ward=?,Details=?,Holder=?,userId=? WHERE AddressId=?');
        $req->execute(array(
            $address->getCounty(),
            $address->getConstituency(),
            $address->getWard(),
            $address->getDescription(),
            $address->getHolder(),
            $address->getUserId(),
            $address->getId()
        ));
        
        // Update geo coordinates for the address
        FaddressGeo::saveAddressWithGeo(
            $address->getId(),
            $address->getUserId(),
            $address->getCounty(),
            $address->getConstituency(),
            $address->getWard(),
            $address->getDescription()
        );
    }

    /*static function checkUserId($userId)
    {   //Function to check if a email already exist in the database

        $con=Database::getConnection();
        $req=$con->prepare('SELECT * FROM address WHERE email=?');
        $req->execute(array($userId));
        if($req->rowCount()==0)
        {
            return true;
        }
        return false;
    }*/
  
    static function getAllAddress()
    {   // Function to get all the contractor admin

        $con=Database::getConnection();
        $req=$con->prepare('SELECT * FROM address ');
        $req->execute(array());
        return $req->fetchAll();
    }



    static function getAddressInfoById($userId)
    {   // Function to get information on a specific admin

        $con=Database::getConnection();
        $req=$con->prepare('SELECT * FROM address WHERE userId=?');
        $req->execute(array($userId));
        return $req->fetch();
    }
    



    static function deleteAddress($addressId)
    {   // Function to delete an admin from the system

        $con=Database::getConnection();
        $req=$con->prepare('DELETE FROM address WHERE AddressId=?');
        $req->execute(array($idUser));

    }
}