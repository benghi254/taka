<?php


//header('Location: user/userLogin.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EcoClean Waste Collection</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f4f8fc;
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #0056b3, #1e90ff);
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .hero {
            padding: 80px 20px;
            text-align: center;
            background: #e6f1ff;
        }

        .hero h2 {
            color: #0056b3;
            font-size: 36px;
        }

        .hero p {
            max-width: 700px;
            margin: auto;
            font-size: 18px;
        }

        .section {
            padding: 60px 40px;
            max-width: 1100px;
            margin: auto;
        }

        .section h2 {
            text-align: center;
            color: #0056b3;
            margin-bottom: 30px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card h3 {
            color: #1e90ff;
        }

        footer {
            background: #0056b3;
            color: white;
            padding: 30px;
            text-align: center;
        }

        footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<header>
    <h1>EcoClean</h1>
    <nav>
        <a href="public/login.php">login</a>
        <a href="user/register.php">Sign Up</a>
    </nav>
</header>

<section class="hero">
    <h2>Reliable & Eco-Friendly Waste Collection</h2>
    <p>
        EcoClean provides fast, affordable and environmentally responsible waste
        management solutions for homes and businesses.
    </p>
</section>

<section class="section">
    <h2>Our Services</h2>
    <div class="cards">
        <div class="card">
            <h3>Residential Waste</h3>
            <p>Weekly household garbage pickup with recyclable separation.</p>
        </div>
        <div class="card">
            <h3>Commercial Waste</h3>
            <p>Reliable waste collection for offices, shops and industries.</p>
        </div>
        <div class="card">
            <h3>Recycling</h3>
            <p>Plastic, paper, glass and metal recycling services.</p>
        </div>
        <div class="card">
            <h3>Bulk & Hazardous Waste</h3>
            <p>Safe disposal of bulky items and hazardous materials.</p>
        </div>
    </div>
</section>

<section class="section">
    <h2>Areas We Serve</h2>
    <div class="cards">
        <div class="card"><p>Nairobi</p></div>
        <div class="card"><p>Nyeri</p></div>
        <div class="card"><p>Mombasa</p></div>
        <div class="card"><p>Greenfield Suburbs</p></div>
        <div class="card"><p>Industrial Park Zone</p></div>
    </div>
</section>

<footer>
    <h2>Contact Us</h2>
    <p>Email: support@ecocleanwaste.com</p>
    <p>Phone: + (254) 7-123-4567</p>
    <p>Address: 45 KWS langata, nairobi</p>
    <p>&copy; 2026 EcoClean Waste Collection</p>
</footer>

</body>
</html>
