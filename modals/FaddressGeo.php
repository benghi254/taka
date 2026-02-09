<?php

include_once '../modals/Database.php';
include_once '../modals/GeocodingService.php';

class FaddressGeo
{
    /**
     * Save address with geo coordinates
     * 
     * @param int $addressId The address ID from the address table
     * @param int $userId The user ID
     * @param string $county
     * @param string $constituency
     * @param string $ward
     * @param string $details
     * @return bool|int Returns geoId on success, false on failure
     */
    static function saveAddressWithGeo($addressId, $userId, $county, $constituency, $ward, $details)
    {
        $con = Database::getConnection();
        
        // Build full address and geocode it
        $fullAddress = GeocodingService::buildFullAddress($county, $constituency, $ward, $details);
        $geoData = GeocodingService::geocodeAddressComponents($county, $constituency, $ward, $details);
        
        if ($geoData === false) {
            // Log geocoding failure but still save the record
            error_log("Failed to geocode address for userId: $userId, addressId: $addressId");
            $latitude = null;
            $longitude = null;
        } else {
            $latitude = $geoData['lat'];
            $longitude = $geoData['lon'];
        }
        
        try {
            // Check if record already exists
            $checkStmt = $con->prepare('SELECT geoId FROM address_geo_coordinates WHERE addressId = ? OR userId = ? LIMIT 1');
            $checkStmt->execute([$addressId, $userId]);
            $existing = $checkStmt->fetch(PDO::FETCH_ASSOC);
            
            if ($existing) {
                // Update existing record
                $stmt = $con->prepare('UPDATE address_geo_coordinates 
                                       SET fullAddress = ?, latitude = ?, longitude = ?, 
                                           county = ?, constituency = ?, ward = ?, details = ?,
                                           geocoded_at = NOW(), updated_at = NOW()
                                       WHERE geoId = ?');
                $stmt->execute([
                    $fullAddress,
                    $latitude,
                    $longitude,
                    $county,
                    $constituency,
                    $ward,
                    $details,
                    $existing['geoId']
                ]);
                return $existing['geoId'];
            } else {
                // Insert new record
                $stmt = $con->prepare('INSERT INTO address_geo_coordinates 
                                      (addressId, userId, fullAddress, latitude, longitude, 
                                       county, constituency, ward, details, geocoded_at) 
                                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())');
                $stmt->execute([
                    $addressId,
                    $userId,
                    $fullAddress,
                    $latitude,
                    $longitude,
                    $county,
                    $constituency,
                    $ward,
                    $details
                ]);
                return $con->lastInsertId();
            }
        } catch (PDOException $e) {
            error_log("Error saving address geo coordinates: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Get geo coordinates by address ID
     * 
     * @param int $addressId
     * @return array|false
     */
    static function getGeoByAddressId($addressId)
    {
        $con = Database::getConnection();
        $stmt = $con->prepare('SELECT * FROM address_geo_coordinates WHERE addressId = ? LIMIT 1');
        $stmt->execute([$addressId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get geo coordinates by user ID
     * 
     * @param int $userId
     * @return array|false
     */
    static function getGeoByUserId($userId)
    {
        $con = Database::getConnection();
        $stmt = $con->prepare('SELECT * FROM address_geo_coordinates WHERE userId = ? LIMIT 1');
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get all geo coordinates
     * 
     * @return array
     */
    static function getAllGeoCoordinates()
    {
        $con = Database::getConnection();
        $stmt = $con->prepare('SELECT * FROM address_geo_coordinates ORDER BY created_at DESC');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Update geo coordinates for an existing address
     * 
     * @param int $geoId
     * @param string $county
     * @param string $constituency
     * @param string $ward
     * @param string $details
     * @return bool
     */
    static function updateGeoCoordinates($geoId, $county, $constituency, $ward, $details)
    {
        $con = Database::getConnection();
        
        // Re-geocode the address
        $fullAddress = GeocodingService::buildFullAddress($county, $constituency, $ward, $details);
        $geoData = GeocodingService::geocodeAddressComponents($county, $constituency, $ward, $details);
        
        if ($geoData === false) {
            $latitude = null;
            $longitude = null;
        } else {
            $latitude = $geoData['lat'];
            $longitude = $geoData['lon'];
        }
        
        try {
            $stmt = $con->prepare('UPDATE address_geo_coordinates 
                                   SET fullAddress = ?, latitude = ?, longitude = ?,
                                       county = ?, constituency = ?, ward = ?, details = ?,
                                       geocoded_at = NOW(), updated_at = NOW()
                                   WHERE geoId = ?');
            $stmt->execute([
                $fullAddress,
                $latitude,
                $longitude,
                $county,
                $constituency,
                $ward,
                $details,
                $geoId
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Error updating geo coordinates: " . $e->getMessage());
            return false;
        }
    }
}



