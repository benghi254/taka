<?php
session_start();
include_once '../modals/Database.php';
include_once '../modals/FaddressGeo.php';

if(!isset($_SESSION['username']))
{
   header("location: index.php"); 
}

$conn = Database::getConnection();

// Get all addresses with geo coordinates
$stmt = $conn->prepare("SELECT ag.*, u.fullname, u.Email, u.Mobile, a.County, a.Constituency, a.Ward, a.Details 
                        FROM address_geo_coordinates ag
                        LEFT JOIN user u ON ag.userId = u.userId
                        LEFT JOIN address a ON ag.addressId = a.AddressId
                        WHERE ag.latitude IS NOT NULL AND ag.longitude IS NOT NULL");
$stmt->execute();
$addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Also get trash bins with coordinates
$stmt = $conn->prepare("SELECT * FROM trash ");
$stmt->execute();
$trashBins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Interactive Collection Map</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <link rel="stylesheet" href="../assets/style/menu.css">
  <link rel="stylesheet" href="../assets/style/main.css">
  <style>
    body { margin: 0; padding: 0; }
    .map-header {
      text-align: center;
      padding: 1em;
      background: #fff;
      border-bottom: 1px solid #ddd;
    }
    #map {
      height: calc(100vh - 100px);
      width: 100%;
    }
    .map-legend {
      position: absolute;
      bottom: 20px;
      right: 20px;
      background: white;
      padding: 15px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.3);
      z-index: 1000;
    }
    .legend-item {
      display: flex;
      align-items: center;
      margin: 5px 0;
    }
    .legend-color {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      margin-right: 10px;
    }
  </style>
</head>
<body>
  <?php include_once '../commons/menu.php';?>
  <?php include_once '../commons/header.php';?>
  
  <div class="body-container">
    <div class="ml-24">
      <div class="map-header">
        <h2>Collection Map - Addresses & Trash Bins</h2>
      </div>
      <div id="map"></div>
      <div class="map-legend">
        <strong>Legend:</strong>
        <div class="legend-item">
          <div class="legend-color" style="background: #2563eb;"></div>
          <span>User Addresses</span>
        </div>
        <div class="legend-item">
          <div class="legend-color" style="background: #ef4444;"></div>
          <span>Trash Bins</span>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Initialize map centered on Nairobi, Kenya
    var nairobiCenter = [-1.286389, 36.817223];
    var map = L.map('map').setView(nairobiCenter, 13);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors',
      maxZoom: 19
    }).addTo(map);

    // Address data from PHP
    var addresses = <?php echo json_encode($addresses); ?>;
    var trashBins = <?php echo json_encode($trashBins); ?>;

    // Feature group to hold all markers for bounds fitting
    var markersGroup = new L.featureGroup().addTo(map);

    // Add markers for user addresses
    addresses.forEach(function(addr) {
      if(addr.latitude && addr.longitude && !isNaN(parseFloat(addr.latitude)) && !isNaN(parseFloat(addr.longitude))) {
        var marker = L.marker([parseFloat(addr.latitude), parseFloat(addr.longitude)], {
          icon: L.divIcon({
            className: 'address-marker',
            html: '<div style="background: #2563eb; width: 22px; height: 22px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>',
            iconSize: [22, 22]
          })
        });

        var popupContent = '<div style="min-width: 200px;">' +
          '<strong>User Address</strong><br>' +
          (addr.fullname ? '<b>Name:</b> ' + addr.fullname + '<br>' : '') +
          (addr.Email ? '<b>Email:</b> ' + addr.Email + '<br>' : '') +
          (addr.Mobile ? '<b>Phone:</b> ' + addr.Mobile + '<br>' : '') +
          '<hr>' +
          (addr.fullAddress ? '<b>Address:</b> ' + addr.fullAddress + '<br>' : '') +
          (addr.County ? '<b>County:</b> ' + addr.County + '<br>' : '') +
          (addr.Constituency ? '<b>Constituency:</b> ' + addr.Constituency + '<br>' : '') +
          (addr.Ward ? '<b>Ward:</b> ' + addr.Ward + '<br>' : '') +
          (addr.Details ? '<b>Details:</b> ' + addr.Details + '<br>' : '') +
          '</div>';
        
        marker.bindPopup(popupContent);
        markersGroup.addLayer(marker);
      }
    });

    // Add markers for trash bins
    trashBins.forEach(function(trash) {
      if(trash.lat && trash.longi && !isNaN(parseFloat(trash.lat)) && !isNaN(parseFloat(trash.longi))) {
        var marker = L.marker([parseFloat(trash.lat), parseFloat(trash.longi)], {
          icon: L.divIcon({
            className: 'trash-marker',
            html: '<div style="background: #ef4444; width: 22px; height: 22px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>',
            iconSize: [22, 22]
          })
        });

        var popupContent = '<div style="min-width: 200px;">' +
          '<strong>Trash Bin</strong><br>' +
          (trash.idTrash ? '<b>ID:</b> ' + trash.idTrash + '<br>' : '') +
          (trash.address ? '<b>Address:</b> ' + trash.address + '<br>' : '') +
          (trash.area ? '<b>Area:</b> ' + trash.area + '<br>' : '') +
          (trash.typeTrash ? '<b>Type:</b> ' + trash.typeTrash + '<br>' : '') +
          '</div>';
        
        marker.bindPopup(popupContent);
        markersGroup.addLayer(marker);
      }
    });


    // Fit map to show all markers if any exist
    if(markersGroup.getLayers().length > 0) {
      map.fitBounds(markersGroup.getBounds().pad(0.1), { maxZoom: 15 });
    }
  </script>
</body>
</html>