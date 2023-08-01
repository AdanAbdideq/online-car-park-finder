<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>I.G.S car park</title>
  <link rel="stylesheet" href="body.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


</head>
<body>

<section class="topimg">
  <img src="../image/map2.jpg" alt="" style="width: 100%; height: 400px;">
  <div class="search-overlay"></div>
  <div class="search-section">
    <h2>Find the Perfect Parking Spot</h2>
    <form action="search-handler.php" method="GET">
      <input type="text" id="locationInput" name="location" placeholder="Enter your location" required>
      <input type="submit" value="Search">
    </form>
    <div id="autocompleteResults"></div>
  </div>
</section>

<script>
  const locationInput = document.getElementById('locationInput');
  const autocompleteResults = document.getElementById('autocompleteResults');
  let timeoutId;

  locationInput.addEventListener('input', function() {
    clearTimeout(timeoutId);
    const searchQuery = this.value.trim();

    if (searchQuery.length > 0) {
      timeoutId = setTimeout(function() {
        fetchAutocompleteResults(searchQuery);
      }, 300);
    } else {
      clearAutocompleteResults();
    }
  });

  function fetchAutocompleteResults(searchQuery) {
    const url = `autocomplete-handler.php?query=${encodeURIComponent(searchQuery)}`;

    fetch(url)
      .then(response => response.json())
      .then(data => {
        displayAutocompleteResults(data);
      })
      .catch(error => console.error(error));
  }

  function displayAutocompleteResults(results) {
    autocompleteResults.innerHTML = '';

    if (results.length > 0) {
      const ul = document.createElement('ul');

      results.forEach(result => {
        const li = document.createElement('li');
        const link = document.createElement('a');
        link.textContent = result;
        link.href = `./search-handler.html?location=${encodeURIComponent(result)}`;
        li.appendChild(link);
        ul.appendChild(li);
      });

      autocompleteResults.appendChild(ul);
    }
  }
</script>



<section class="features">
    <div class="feature">
        <i class="fas fa-search"></i>
        <h3>Search</h3>
        <p>Search for available parking options in your area.</p>
    </div>
    <div class="feature">
        <i class="fas fa-map-marked-alt"></i>
        <h3>View Maps</h3>
        <p>View detailed maps to locate parking spots.</p>
    </div>
    <div class="feature">
        <i class="fas fa-car"></i>
        <h3>Book Online</h3>
        <p>Book and pay for parking spots online.</p>
    </div>
</section>

<section class="abt-mh">
    <div class="container"> 
        <div class="row">
              <div class="col-lg-6"  data-aos="slide-right" data-aos-offset="200">
                <div class="content-img m-auto p-2">
                  <img src="../image/parking.jpg" alt="" class="img-responsive img-fluid m-auto" height="auto" width="auto">
                </div>
              </div>

              <div class="col-lg-6 abt-mh-content" data-aos="slide-left" data-aos-offset="200">
              <p>I.G.S Online Car Park Finder revolutionizes car parking with its user-friendly platform, connecting car owners with available spaces. We believe in the power of community and invite you to join us in improving our system. By adding more parking lots to our database, you can contribute to enhancing convenience, security, and time-saving benefits for car owners everywhere. Together, we can create a comprehensive and reliable resource for finding the perfect parking spot. Join I.G.S Online Car Park Finder today and be a part of the solution!</p>
                <div class="abt-mh-heading"> <a href="join-us.php">Join Us</a></div>

              </div>
            <div>
            </div>
        </div>
    </div>
</section>

<section>

</section class="testmon">
<div class="testmon">
        <h5>TESTIMONIALS</h5>
        <h3 style="margin-top: 10px;">WHAT CLIENTS SAY</h3>
        <h2></h2>
        <p style="margin-top: 10px;">The system has completely transformed the way we operate. It has streamlined our processes, 
            saved us time and effort, and improved our overall efficiency. Our users are thrilled with the
         results, praising its user-friendly interface and powerful features. It has truly become an indispensable 
         tool for our organization</p>
    </div>

    <div class="container">
        <?php
        $host = 'localhost';
        $db = 'farhan';
        $user = 'root';
        $pass = '';

        try {
            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT feedback_text, user_id FROM feedback";
            $stmt = $pdo->query($query);
            $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $displayedFeedbacks = 2; // Number of feedbacks to always display
            $remainingFeedbacks = count($feedbacks) - $displayedFeedbacks;
            $remainingFeedbacksDisplayed = false;

            foreach ($feedbacks as $index => $feedback) {
                $feedback_text = $feedback['feedback_text'];
                $user_id = $feedback['user_id'];

                $query = "SELECT fullname FROM register WHERE id = :user_id";
                $stmt = $pdo->prepare($query);
                $stmt->execute(['user_id' => $user_id]);
                $user_row = $stmt->fetch(PDO::FETCH_ASSOC);

                $fullname = $user_row['fullname'];

                if ($index < $displayedFeedbacks) {
                    echo '<figure class="card show-feedback">
                            <figcaption>
                                <blockquote>
                                    <p>' . $feedback_text . '</p>
                                </blockquote>
                                <h3>' . $fullname . '</h3>
                            </figcaption>
                        </figure>';
                } else {
                    echo '<figure class="card hidden-feedback">
                            <figcaption>
                                <blockquote>
                                    <p>' . $feedback_text . '</p>
                                </blockquote>
                                <h3>' . $fullname . '</h3>
                            </figcaption>
                        </figure>';
                }
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>
    </div>

    <div class="scroll-button scroll-button-left" style="margin-left: 50px;">
        <button class="futuristic-button" onclick="scrollFeedbacks('left')">Left</button>
    </div>
    <div class="scroll-button scroll-button-right" style="margin-right: 50px;">
        <button class="futuristic-button" onclick="scrollFeedbacks('right')">Right</button>
    </div>

    <script>
      const container = document.querySelector('.container');
const scrollButtonLeft = document.querySelector('.scroll-button-left');
const scrollButtonRight = document.querySelector('.scroll-button-right');
const scrollAmount = 310;
let currentIndex = 0;

function scrollFeedbacks(direction) {
  const feedbacks = document.querySelectorAll('.card');
  const maxIndex = feedbacks.length - 3;
  let nextIndex;

  if (direction === 'left') {
    nextIndex = currentIndex > 0 ? currentIndex - 1 : maxIndex;
  } else if (direction === 'right') {
    nextIndex = currentIndex < maxIndex ? currentIndex + 1 : 0;
  }

  for (let i = currentIndex; i < currentIndex + 3; i++) {
    feedbacks[i].classList.remove('show-feedback');
    feedbacks[i].classList.add('hidden-feedback');
  }

  for (let i = nextIndex; i < nextIndex + 3; i++) {
    feedbacks[i].classList.remove('hidden-feedback');
    feedbacks[i].classList.add('show-feedback');
  }

  currentIndex = nextIndex;

  scrollButtonLeft.style.display = currentIndex > 0 ? 'flex' : 'none';
  scrollButtonRight.style.display = currentIndex < maxIndex ? 'flex' : 'none';
}

scrollFeedbacks('right');

function updateScrollButtonVisibility() {
  scrollButtonLeft.style.display = currentIndex > 0 ? 'flex' : 'none';
  scrollButtonRight.style.display = currentIndex < maxIndex ? 'flex' : 'none';
}

updateScrollButtonVisibility();


    </script>
<script>
  function initializeAutocomplete() {
    const locationInput = document.querySelector('input[name="location"]');
    const autocomplete = new google.maps.places.Autocomplete(locationInput);

    autocomplete.setFields(['address_component']);
    autocomplete.addListener('place_changed', function() {
      const place = autocomplete.getPlace();
      if (!place.geometry) {
        console.log('No geometry available for the selected place.');
        return;
      }
      const location = {
        name: place.name,
        address: place.formatted_address,
        latitude: place.geometry.location.lat(),
        longitude: place.geometry.location.lng()
      };

      console.log(location);
    });
  }

  window.addEventListener('DOMContentLoaded', initializeAutocomplete);
</script>

  <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
</body>
</html>
