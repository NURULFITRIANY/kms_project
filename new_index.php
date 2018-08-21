<?php 

session_start();

 ?>


<?php 
include('adminKMS/koneksi.php'); //untuk 2 kondisi

// process form log in
if(isset($_POST['login'])){ //check if user already login

    

    $username = $_POST["username"]; // retrieve data (username) from form 
    $password = $_POST["user_password"]; // retrieve data (password) from form

    $query = "SELECT * FROM employees WHERE username = '$username' AND password = '$password'"; //retrieve data from database to fit existing data in database
    
    $execute = mysql_query($query); //to run the (above) query
    // var_dump($execute);
    $row = mysql_num_rows($execute);  //to check the result query 
    if($row > 0){
        $id=mysql_fetch_array($execute); // Retrieve ID employees
        $_SESSION['login']=$id['idemployees']; //create session to get access or passed through the session'login' in adminkms page
        header('Location:adminKMS/index.php');
    }
    else{
        echo "<script>alert('Your username or password is wrong');</script>";
    }

 }

// process form sign up

if(isset($_POST['signup'])){ //check if the form has been submitted

    $name = mysql_real_escape_string($_POST['full_name']); //makes sure that the user isn't trying to use apostrophes to access our database with MySQL injection
    $email = mysql_real_escape_string($_POST['user_email']); //makes sure that the user isn't trying to use apostrophes to access our database with MySQL injection

    // if statement checking for any errors

    if(empty($name) || empty($email)){ //check to see if the user submitted without his/her name
        // $action['result'] = 'error';
        // array_push($text,'You forgot your name');
        echo "Nama dan Email tidak boleh kosong";
    }        // echo "<script>alert('Please fill your name');</script>";
    //var_dump($action);
    // if(empty($email)){ //check to see if the user submitted without his/her email
    //     $action['result'] = 'error';
    //     array_push($text,'You forgot your email');
    // }       // echo "<script>alert('Please fill your email');</script>";
    //var_dump($action);

    //adding user to the database



    $password=substr(sha1(rand(uniqid())), 0,5); //send random password
   
    $add = mysql_query("INSERT INTO employees(idemployees, full_name, username, password, email) VALUES(NOT NULL,'$name','$email','$password','$email')");  //add to the database

    $execute = mysql_query($add); // to run the (above) variable of 'add'
    
    if($add){
        echo "You successed to register at KMS";

        $konten_email="Thank you, ".$name."<br/>Informasi login:<br/> Username : ".$email."<br/>Password : ".$password." ";

        mail($email, "Congartulation, You are part of PIONEER KMS", $konten_email);


        //the user was added to the database    
             
    } else {
        $action['result'] = 'error';
        array_push($text,'User could not be added to the database. Reason: ' . mysql_error()); //debugging when the query is error
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Knowledge Management System</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="plugin/ninja-slider.css" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="css/grayscale.css" rel="stylesheet"> 

    <!-- main css for sign up form -->
    <link href="css/main.css" rel="stylesheet">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <!-- <i class="fa fa-user"></i>  -->
                    <span class="light">KMS</span> ANTAM
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section
 -->
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                      <a id="drop1" class="page-scroll" href="#about">
                        About
                      </a>
                    </li>
                    <li class="dropdown">
                      <a id="drop1" class="page-scroll" href="#welcome">
                        Welcome
                      </a>
                    </li>
                    <li class="dropdown">
                      <a id="drop2" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Activity Stream
                        <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="drop2">
                        <li><a href="#newsandevent">News and Events</a></li>
                        <li><a href="#document">Documents</a></li>
                        <li><a href="#project">Project</a></li>
                        <li><a href="#brainstorming">Brainstorming</a></li>
                        <!-- <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li> -->
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a id="drop1" href="#contact" class="page-scroll">
                        Contact
                      </a>
                    </li>
                    <li class="dropdown">
                      <a id="signin" href="#contact">
                         <i class="fa fa-user"></i>
                      </a>
                    </li>
                </ul>
<!--               <ul class="nav navbar-nav">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    
                    <li>
                        <a class="page-scroll" href="#activitystream">Activity Stream</a>
                        <ul>
                            <li>
                                <a class="#" href="#documents">Documents</a>
                            </li>
                            <li>
                                <a class="#" href="#newsandevent">News and Event</a>
                            </li>
                            <li>
                                <a class="#" href="#project">Project</a>
                            </li>
                            <li>
                                <a class="#" href="#brainstorming">Brainstorming</a>
                            </li>
                            
                        </ul> 
                    </li>
                </ul> -->
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">KMS</h1>
                        <p class="intro-text">Gain knowledge inside your company<br>Let's be A PIOONER</p>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <!-- Indicates caution should be taken with this action -->
                                <button type="button" class="btn btn-primary" id="signup">Sign up</button>
                            </div>
                        </div>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated" href="#"></i>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-12"> <!-- mengatur lebar kolom: 1 s/d 12 -->
                <section>
                 <ul class="row" id="about">
                    <li class="col-lg-3"> <strong><span><abbr title="Knowledge Management System">KMS</abbr> Project</span></strong>
                         <p> A project to support all staff to gain more kowledges through brainstorming, sharing knowledges, and many more features in secure friendly website</p>
                            <span>  <a href="#">Find out more </a></span>
                    </li>
                    <li class="col-lg-3"> <strong><span>Find Our People </span></strong>
                         <p> Details of our staff, our designer, and our responsible admin from ANTAM Tbk and the University of Brawijaya.</p>
                        <span>  <a href="#">Find out more </a></span>
                    </li>
                     <li class="col-lg-3"> <strong><span>Our Partners</span></strong>
                        <p>As a collaborative project, we are a partnership of industry and academic members.</p>
                        <span>  <a href="#">Find out more </a></span>
                     </li>
                    <li class="col-lg-3"> <strong><span>Advisory Board</span></strong>
                        <p> Get to know better, being motivated, and more supported from leaders</p>
                         <span> <a href="#">Find out more </a></span>
                    </li>
                </ul>
                </section>
            </div>
        </div>
    </section>

    <!-- Welcome Section -->
    <section id="welcome" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-6">
                
                <section>
                    <div id="ninja-slider">
                        <div class="slider-inner">
                            
                            <ul>
                                <li>
                                    <div class="content">
                                            <h3> WELCOME </h3>
                                            <p> This project were developed to help company fill knowledges demands that are needing by staff in order to help them more knowledgeable or keep being developed. Through sharing knowledge in several ways, Designers believe, <em>Knowledge Management System</em> is very efficient method and away more fun.  Instead of traditional development for staff such as <em>Training, Seminar, etc</em> , it is better using technology to tansform faster and able to add many feautures that could make attractive for the users. </p>

                                             <p>This project basis from Theory Acceptance Model, which is analysing behaviour of end-user to use technology. This theory grounded designer analysing user behaviour and implemeting the result through design Knowledge Management System. Designer here choose <em> Website</em> as known that it the best tool to preserve information widely and secure </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="content">
                                            <h3> Mission </h3>
                                            <p> To help companies to optimise their human resourse by empowering them through knowledge </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="content">
                                          <h3> Goals </h3>
                                              <p> Explore and develop new <em>Knowledge Management System</em> technology for unique, responsive, intuitive, and productive users experiences. </p>
                                              <p> Address new beneficial of transform of knowledge effectively through sharing and brainstorming method. </p>
                                              <p> Avoid missing out the key business opprtunity by developed future knowledge management practice as assets. </p>
                                    </div>
                                </li>
                            </ul>
                            
                            <div class="fs-icon" title="Expand/Close"></div>

                        </div>
                    </div>
                </section>
            </div>

            
                <div class="col-lg-6">
                    <div id="gambar">
                        <img src="img/ios kms.png">
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Activity Stream -->
    <section id="activitystream" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-12">
                    <h2>Activity Stream</h2>
                    <li>
                      <a href="#documents" class="btn btn-default btn-lg">Documents</a>
                    </li>
                    <li>
                        <a href="#newsandevent" class="btn btn-default btn-lg">News and Event</a>
                    </li>
                    <li>
                        <a href="#project" class="btn btn-default btn-lg">Project</a>
                    </li>
                    <li>
                        <a href="#brainstorming" class="btn btn-default btn-lg">Brainstorming</a>
                    </li>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact</h2>
                <p></p>
                <p><a href="mailto:nurulekafitriany@ymail.com">nurulekafitriany@ymail.com</a>
                </p>
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://twitter.com/nn_hilal" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                    </li>
                    <li>
                        <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/105613859704295196228/posts" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Map Section
    <div id="map"></div> -->

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; Nurul Eka Fitriany 2014</p>
        </div>
    </footer>

    <!-- modal for pop up sign up form -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Sign Up</h4>
          </div>
          <div class="modal-body">
                 <form action="" method="post">
                   <fieldset>
                    <h1> Sign up</h1>
                    
                    <fieldset>
                      
                      <label for="name">Name:</label>
                      <input type="text" name="fullname"><br>

                      <label for="email">Email:</label>
                      <input type="email" id="email" name="user_email">
                       
                        
                    </fieldset>

<!--                     <button type="submit" onclick="alert('Our Team will contact you soon!')">Sign up</button> -->
                     
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="signup" class="btn btn-primary" onclick="alert('Our Team will contact you soon!')">Sign up</button>

                    </form>

          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- modal for pop up sign in form -->
    <div class="modal fade" id="loginModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Log In</h4>
          </div>
          <div class="modal-body">
                 
                    <form action="#" method="post" name="login">
                       <fieldset>
                        <h1> Log in</h1>
                        
                        <fieldset>

                          
                          <label for="username">Username:</label>
                          <input type="text" name="username"><br>

                          <label for="password">Password:</label>
                          <input type="password" id="password" name="user_password">
                           
                            
                        </fieldset>

<!--                         <button type="submit" onclick="alert('Let's start sharing!')">Log In</button> -->
                     
                      </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="login">Let's start</button>
                    </form>

                    </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

    <script src="plugin/ninja-slider.js" type="text/javascript"></script> 

    <script type="text/javascript">
        $('.dropdown-toggle').dropdown();
        // funtion for show sign up form
        $("#signup").click(function(){
             $('#myModal').modal();
        });
        // funtion for show sign in form
        $("#signin").click(function(){
             $('#loginModal').modal();
        });
    </script>

</body>

</html>
