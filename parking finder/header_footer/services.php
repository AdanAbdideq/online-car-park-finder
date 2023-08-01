<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Reset default browser styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
}

/* .container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
} */

/* Banner styles */
.banner {
  background-image: url('../image/car_park.jpg');
  background-size: cover;
  background-position: center;
  height: 500px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  color: #fff;
  text-align: center;
}

.banner h2 {
  font-size: 36px;
  margin-bottom: 20px;
}

.banner p {
  font-size: 18px;
  margin-bottom: 40px;
}

.banner .btn {
  padding: 12px 30px;
  background-color: #64bcf4;
  color: #fff;
  border-radius: 4px;
  text-decoration: none;
  text-transform: uppercase;
  transition: background-color 0.3s;
}

.banner .btn:hover {
  background-color: #5bacdf;
}

/* Services section styles */
.services {
  /* background-color: #f5f5f5; */
  position: relative;
  margin-top: -10%;  
}

.services .container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: flex-start;
  margin-top: 70px;
}

.service {
  flex-basis: calc(34.33% - 40px);
  height: 300px;
  margin-bottom: 40px;
  padding: 20px;
  border-radius: 4px;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  box-shadow: 0 0 40px rgba(0, 0, 0, 0.8);
}

.service i {
  font-size: 48px;
  color: #64bcf4;
  margin-bottom: 20px;
}

.service h3 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.service p {
  font-size: 16px;
  color: #888;
}
header{
  margin-bottom: 20px;
  margin-top: 20px;
}
    </style>
</head>
<body>
  <header>
    <?php include"header.html"; ?>
  </header>
    <main>
    <section class="banner">
       
    </section>

    <section class="services">
        <div class="container">
            <div class="service">
                <i class="fas fa-car"></i>
                <h3>Car Wash</h3>
                <p>We offer professional car wash services to keep your vehicle clean and sparkling.</p>
            </div>
            <div class="service">
                <i class="fas fa-concierge-bell"></i>
                <h3>Concierge Options</h3>
                <p>Enjoy personalized concierge services for a convenient and delightful experience.</p>
            </div>
            <div class="service">
                <i class="fas fa-shield-alt"></i>
                <h3>Safe And Secure</h3>
                <p>Your vehicle's safety and security are our top priorities. Rest assured with our measures.</p>
            </div>
        </div>
    </section>
    </main>
    <footer>
        <?php include "footer.html"?>
    </footer>
</body>
</html>
