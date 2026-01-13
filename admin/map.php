<!DOCTYPE html>
<html>
<head>
  <title>Interactive Household Map</title>
  <meta charset="UTF-8">
  <style>
    body { margin: 0; padding: 0; }
    h2 { text-align: center; margin: 1em 0; }
  </style>
</head>
<body>
  <h2>Collection Map</h2>
  <?php
  $map_html = file_get_contents('http://localhost:5000/map');
  echo $map_html;
  ?>
</body>
</html>