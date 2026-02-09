<?php

class GeocodingService
{
    /**
     * Geocode an address to get latitude and longitude coordinates
     * Uses OpenStreetMap Nominatim API (free, no API key required)
     * 
     * @param string $address The full address string
     * @return array|false Returns array with 'lat' and 'lon' on success, false on failure
     */
    static function geocodeAddress($address)
    {
        if (empty($address)) {
            return false;
        }

        // Clean and encode the address
        $address = trim($address);
        $encodedAddress = urlencode($address);
        
        // Use OpenStreetMap Nominatim API
        $url = "https://nominatim.openstreetmap.org/search?q={$encodedAddress}&format=json&limit=1";
        
        // Set user agent (required by Nominatim)
        $options = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: TakaWasteCollection/1.0'
                ],
                'timeout' => 10
            ]
        ];
        
        $context = stream_context_create($options);
        
        try {
            $response = @file_get_contents($url, false, $context);
            
            if ($response === false) {
                return false;
            }
            
            $data = json_decode($response, true);
            
            if (empty($data) || !isset($data[0]['lat']) || !isset($data[0]['lon'])) {
                return false;
            }
            
            return [
                'lat' => (float)$data[0]['lat'],
                'lon' => (float)$data[0]['lon'],
                'display_name' => $data[0]['display_name'] ?? $address
            ];
        } catch (Exception $e) {
            error_log("Geocoding error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Build full address string from components
     * 
     * @param string $county
     * @param string $constituency
     * @param string $ward
     * @param string $details
     * @return string Full address string
     */
    static function buildFullAddress($county, $constituency, $ward, $details)
    {
        $parts = array_filter([$details, $ward, $constituency, $county, 'Kenya']);
        return implode(', ', $parts);
    }
    
    /**
     * Geocode address components
     * 
     * @param string $county
     * @param string $constituency
     * @param string $ward
     * @param string $details
     * @return array|false Returns array with 'lat' and 'lon' on success, false on failure
     */
    static function geocodeAddressComponents($county, $constituency, $ward, $details)
    {
        $fullAddress = self::buildFullAddress($county, $constituency, $ward, $details);
        return self::geocodeAddress($fullAddress);
    }
}




