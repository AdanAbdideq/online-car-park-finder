<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sign up</title>
  <link rel="icon" type="image/png" href="../images\image.png"/>
  <script src="insert.js"></script> 
  <style>
    body {
  font-family: sans-serif;
  background-color: #f1f8fc;
}

.container {
  width: 400px;
  margin: 30px auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.login,
.signup {
  margin-top: 20px;
}

.login h2,
.signup h2 {
  text-align: center;
}

form {
  width: 100%;
}

input[type="text"],
input[type="password"],
input[type="email"],
label {
  margin-left: 30px;
  width: 80%;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 4px;
}

input[type="submit"] {
  width: 97%;
  background-color: #000;
  color: #fff;
  cursor: pointer;
  border: none;
  height: 36px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

input[type="submit"]:hover {
  background-color: #333;
}

  </style>
  <head> 
    
    </head> 
    <body> 
      
        <div class="container">
      <form action="connect.php" method="post">
        <h2>Create an Account</h2> 
        <div id="names">
          <input type="text" placeholder="First Name" name="firstname" required id="name"/> 
          <input type="text" placeholder="Last Name" name="lastname" required id="name"/> 
        </div>

        <input type="email" name="email" placeholder="Email" name="email" id="email" required />

          <div id="gender">
          <label for="">Gender</label>
          <label for="male">Male<input type="radio" name="gender" id="male" value="m"></label>
          <label for="female">Female<input type="radio" name="gender" id="female" value="f"></label>
        </div>

        <div id="password">
          <input type="password" name="password" placeholder="Password" required />   
          <input type="password" name="confirmpassword" placeholder="Confirm Password" required /> 
          
        </div>
        <div id="remember"> <label><input type="checkbox" /> Remember Me</label> 
        </div> 
        <br> 
        <input type="submit" value="Sign Up" /> 
        <p>Already have an account? <a href="./login.php" style="color:red;">Login</a></p>
      </form> 
      </div>
      <script src="insert.js"></script>
    </body>
    </html>