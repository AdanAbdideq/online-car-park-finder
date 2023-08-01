<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Feedback</title>
    <style>

        /* Existing styles */
        
        @import url(https://fonts.googleapis.com/css?family=Roboto:300,400);
        @import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css);
        
        .testmon {
            margin-top: 100px;
        }
        
        .testmon h5 {
            margin-left: 40%;
            color: goldenrod;
        }
        
        .testmon h3 {
            margin-left: 37%;
            font-size: 32px;
            font-weight: bold;
        }
        
        .testmon p {
            margin-left: 10%;
        }
        
        .container {
            display: flex;
            overflow-x: hidden; /* Hide the overflow */
            max-width: 100%;
            position: relative;
        }
        
        .card {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
            color: #9e9e9e;
            font-family: 'Roboto', Arial, sans-serif;
            font-size: 16px;
            margin: 35px 10px 10px;
            max-width: 310px;
            min-width: 250px;
            position: relative;
            text-align: center;
            width: 100%;
            background-color: #ffffff;
            border-radius: 5px;
            border-top: 5px solid #d2652d;
        }
        
        .card figcaption {
            padding: 13% 10% 12%;
        }
        
        .card figcaption:before {
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
            background-color: #fff;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
            color: #d2652d;
            content: "\f10e";
            font-family: 'FontAwesome';
            font-size: 32px;
            font-style: normal;
            left: 50%;
            line-height: 60px;
            position: absolute;
            top: -30px;
            width: 60px;
        }
        
        .card h3 {
            color: #3c3c3c;
            font-size: 20px;
            font-weight: 300;
            line-height: 24px;
            margin: 10px 0 5px;
        }
        
        .card h4 {
            font-weight: 400;
            margin: 0;
            opacity: 0.5;
        }
        
        .card blockquote {
            font-style: italic;
            font-weight: 300;
            margin: 0 0 20px;
        }
        
        .scroll-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            position: absolute;
            font-size: 18px;
            font-weight: bold;
            padding: 12px 24px;
            outline: none;
            cursor: pointer;
        }
        
        .scroll-button-left {
            left: 0;
        }
        
        .scroll-button-right {
            right: 0;
        }

        
        .scroll-button:focus {
            box-shadow: 0 0 0 3px rgba(78, 154, 241, 0.5);
        }
        
        .hidden-feedback {
            display: none;
        }
        
        .show-feedback {
            display: block;
        }
        
        .testmon h2{
            margin-left: 45%;
            width: 100px;
            height: 10px;
            background-color: goldenrod;
        }
        
        
        .futuristic-button {
            background-color: #4e9af1;
            color: #ffffff;
            border: none;
            border-radius: 50px;
            padding: 12px 24px;
            font-size: 18px;
            font-weight: bold;
            outline: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }
        
        .futuristic-button:hover {
            background-color: #3682d8;
        }
        
        .futuristic-button:focus {
            box-shadow: 0 0 0 3px rgba(78, 154, 241, 0.5);
        }      

* {
  margin: 20px;
}

    </style>
</head>
<body>
    <main>
    <div class="testmon">
        <h5>TESTIMONIALS</h5>
        <h3>WHAT CLIENTS SAY</h3>
        <h2></h2>
        <p>The system has completely transformed the way we operate. It has streamlined our processes, 
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

    <div class="scroll-button scroll-button-left">
        <button class="futuristic-button" onclick="scrollFeedbacks('left')">Left</button>
    </div>
    <div class="scroll-button scroll-button-right">
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
    </main>
</body>
</html>
