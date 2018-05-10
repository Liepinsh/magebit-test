<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Magebit test</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/></head>

</head>
<body>
    <div class="container">
    <!-- dark background shape -->
    <div class="square"></div>      
    <!-- 3D effect shapes for sliding block -->      
    <div class="trapezoid_signup"></div>
    <div class="trapezoid_login"></div>
        <!-- Dont have an account -->
        <div class="under left">
            <h2>Don't have an account?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do siusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <input type="button" value="Sign up" id="btn1"></input>
        </div>
        <!-- Have an account -->
        <div class="under right" >
            <h2>Have an account?</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
            <input type="button" value="Login" id="btn2"></input>
        </div>
        <!-- sliding block -->
        <!-- if session == signup, then show sign up form, else adds class and moves -->
        <?php if($_SESSION["location_state"] == 'signup')  {?>
            <div class="animation" id="swap">
        <?php } else { ?>
            <div class="animation moved" id="swap">
        <?php }  ?>

            <!-- errors list -->
            <div class="errors" style="">
                <ul id="list">

                    <!-- php errors and success list, from login or registration actions -->
                    <?php
                        if (isset($_SESSION['flash']) && isset($_SESSION['flash']['errors'])){
                            foreach ($_SESSION['flash']['errors'] as $error){
                                echo "<li>$error</li>";
                            }
                            unset($_SESSION['flash']['errors']);
                        }
                        if (isset($_SESSION['flash']) && isset($_SESSION['flash']['success'])){
                            foreach ($_SESSION['flash']['success'] as $success){
                                echo "<li>$success</li>";
                            }
                            unset($_SESSION['flash']['success']);
                        }
                    ?>
                
                </ul>
            </div>

    <!-- if session == signup, then show sign up form -->
    <?php if($_SESSION["location_state"] == 'signup')  {?>
        <div class="form" id="sign-up">
    <?php } else { ?>
        <div class="form hidden" id="sign-up">
    <?php }  ?>

                <!-- sign up form -->
                <form class="upper" method="post" action="registration_action.php" id="register_submit">
                    <!-- div for h2 and logo -->
                    <div class="text-logo">
                        <h2>Sign Up</h2>
                        <img src="img/1style.jpg" alt="Magebit logo">
                    </div>
                    <!-- input fields -->
                    <div class="fields">
                        <input type="text" class="name" name="name" id="inputNameSignUp" placeholder="You'r name" maxlength="30">
                        <label for="inputNameSignUp">Name</label>
                    </div>
                    <div class="fields">
                        <input type="email" class="email" name="email" id="inputEmailSignUp" placeholder="You'r email" maxlength="30">
                        <label for="inputEmailSignUp">Email</label>
                    </div>
                    <div class="fields">
                        <input type="password" class="password" name="password" id="inputPassordSignUp" placeholder="You'r password" maxlength="45">
                        <label for="inputPassordSignUp">Password</label>
                    </div>
                    <div>
                        <input name="signup" type="submit" value="Sign up" id="sign-up-btn"></input>
                    </div>
                </form>
            </div>

    <!-- if session == signup, then show login form -->
    <?php if($_SESSION["location_state"] == 'signup')  {?>
        <div class="form hidden" id="login">
    <?php } else { ?>
        <div class="form" id="login">
    <?php }  ?>

                <!-- login form -->
                <form class="upper" method="post" action="login_action.php" id="login_submit">
                    <!-- div for h2 and logo -->
                    <div class="text-logo">
                        <h2>Login</h2>
                        <img src="img/1style.jpg" alt="Magebit logo">
                    </div>
                    <!-- input fields -->
                    <div class="fields">
                        <input type="email" class="email" name="email" id="inputEmailLogin" placeholder="You'r email" maxlength="30">
                        <label for="inputEmailLogin">Email</label>
                    </div>
                    <div class="fields">
                        <input type="password" class="password" name="password" id="inputPassordLogin" placeholder="You'r password" maxlength="45">
                        <label for="inputPassordLogin">Password</label>
                    </div>
                    <div>
                        <input name="login" type="submit" value="Login" id="login-btn"></input>
                        <a href="">forgot?</a>                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<script>
    const but1 = document.getElementById('btn1');
    const but2 = document.getElementById('btn2');
    const swap = document.getElementById('swap');
    const login = document.getElementById('login');
    const signUp = document.getElementById('sign-up');
    const signUpButton = document.getElementById('sign-up-btn');
    const loginButton = document.getElementById('login-btn');
    const signUpName = document.getElementById('inputNameSignUp');
    const signUpEmail = document.getElementById('inputEmailSignUp');
    const signUpPassword = document.getElementById('inputPassordSignUp');
    const loginEmail = document.getElementById('inputEmailLogin');
    const loginPassword = document.getElementById('inputPassordLogin');
    const error = document.querySelector('.errors');
    const hidden = document.querySelectorAll('.hidden');
    const ul = document.getElementById("list");
    const registerSubmit = document.getElementById('register_submit');
    const loginSubmit = document.getElementById('login_submit');
    
    // listens if registration was submited
    registerSubmit.addEventListener('submit', submitAction);

    // if validation for signup is true, then submit form
    function submitAction(e){
        e.preventDefault();
        let isSignupFormValid = handleSignupClick();
        
        if (isSignupFormValid) {
            registerSubmit.submit()
        }
    }

    // listens if login was submited
    loginSubmit.addEventListener('submit', loginAction);

    // if validation for login is true, then submit form
    function loginAction(e){
        e.preventDefault();
        let isLoginFormValid = handleLoginClick();

        if (isLoginFormValid) {
            loginSubmit.submit()
        }
    }

    // toggles classes, to slide box, hide forms and reset inputs
    function toggleClass(e){
            e.preventDefault();
            swap.classList.toggle('moved');
            login.classList.toggle('hidden');
            signUp.classList.toggle('hidden');
            ul.innerHTML = "";
            loginEmail.value = "";
            loginPassword.value = "";
            signUpName.value = "";
            signUpEmail.value = "";
            signUpPassword.value = "";

        };
    // on button click, slides box
        but1.addEventListener('click', toggleClass);
        but2.addEventListener('click', toggleClass);

    // function for sign up
    function handleSignupClick(e) {
        let errors = [];
        ul.innerHTML = "";
        
    // sign up validation
        if (!signUp.classList.contains('hidden')){

        // name validation
            if (signUpName.value == ""){
                errors.push('Please insert Name');
            } else if (!(signUpName.value.match(/([A-Za-z])\w+/g))) {
                errors.push('Only letters from A-Z allowed in name field. Requires atleast two letters, to be a valid name.');
            };

        // email validation
            if (signUpEmail.value == ""){
                errors.push('Please insert Email');
            } else if (!(signUpEmail.value.match(/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g))) {
                errors.push('Please insert valid Email');
            };

        // password validation
            if (signUpPassword.value == ""){
                errors.push('Please insert Password');
            } else if (signUpPassword.value.length < 8){
                errors.push('Please insert Password with altleast 8 digits');
            };
        };

    // errors
        if (errors.length > 0){
            for (let index = 0; index < errors.length; index++) {
                const element = errors[index];
                const ul = document.getElementById("list");
                const li = document.createElement("li");

                li.appendChild(document.createTextNode(element));
                ul.appendChild(li);
            }
            error.style.display = 'block';
            return false;
        };
        return true;
    };

    // function for login
    function handleLoginClick(e) {
        // e.preventDefault();
        let errors = [];
        ul.innerHTML = "";

    // login validation
        if (!login.classList.contains('hidden')){
            
            // email validation
            if (loginEmail.value == ""){
                errors.push('Please insert Email');
            } else if (!(loginEmail.value.match(/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g))) {
                errors.push('Please insert valid Email');
            };
            
            // password validation
            if (loginPassword.value == ""){
                errors.push('Please insert Password');
            } else if (loginPassword.value.length < 8){
                errors.push('Please insert Password with altleast 8 digits');
            };
        };

    // errors
        if (errors.length > 0){
            for (let index = 0; index < errors.length; index++) {
                const element = errors[index];
                const ul = document.getElementById("list");
                const li = document.createElement("li");

                li.appendChild(document.createTextNode(element));
                ul.appendChild(li);
            }
            error.style.display = 'block';
            return false;
        };
        return true;
    };


</script>
</body>
</html>