<?php

/* 
 * Purpose: Common page elements as PHP methods
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     18 Feb 2017
 */


/* ---- Constants / Defines --- */
// roles must match database, since these are limited in nature - easier to 
// make use of them as defined constants.
define( "ROLE_TENANT", 1 );
define( "ROLE_LANDLORD", 2 );
define( "ROLE_SERVICE", 3 );

define( "NEW_REQUEST", -1 );
define( "NEW_PROPERTY", -1 );

define( "INITIAL_REQUEST_STATUS", 2 );  // initial status should always be "Pending"

function displayHomePageHeader($pageTitle) {
    $pageHeader = <<< HEAD
<!DOCTYPE html>
  <html>
    <head>
      <meta charset=\"UTF-8\">
      <title>Property Maintentance</title>
    
       <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
       <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    $(".nav a").on("click", function(){
        $(".nav").find(".active").removeClass("active");
        $(this).parent().addClass("active");
        });
</script>
       <!-- other CSS -->    
       <link rel="stylesheet" href="./common/css/footer.css"> 
       <link rel="stylesheet" href="./common/css/login.css"> 
            
   </head>
            
    <body>
         
        <!-- Static navbar -->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
          <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Property Maintenance Portal</a>
        </div>
      </div>
    </nav>
      
    <div class = "container">
    <div class = "starter-template">
       
HEAD;
    echo $pageHeader;
}

function displayPageHeader($pageTitle) {
    $pageHeader = <<< HEAD
<!DOCTYPE html>
  <html>
    <head>
      <meta charset=\"UTF-8\">
      <title>Property Maintentance</title>
    
       <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
       <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap-theme.min.css">
            
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
       <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
       
            
<script type='text/javascript'>
    $(".nav a").on("click", function(){
        $(".nav").find(".active").removeClass("active");
        $(this).parent().addClass("active");
        });

            $(document).ready(function(){
  $('.selectpicker').selectpicker({
    width:'125px'
  });

</script>
       <!-- other CSS -->    
       <link rel="stylesheet" href="./common/css/footer.css"> 
       <link rel="stylesheet" href="./common/css/content.css"> 
   </head>
            
    <body>
         
        <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Property Maintenance Portal</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="requestMaint.php">Enter Maintenance Request</a></li>
                <li><a href="propertyMaint.php">Property Maintenance</a></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
      
    <div class = "container">
    <div class = "starter-template">
       
HEAD;
    echo $pageHeader;
}

function displayPageFooter() {
    $year = date('Y');
    $pageFooter = <<< FOOTER
</div>
            </div>
  <footer class="footer">
    <div class="container">
      <p class="text-muted">&copy; $year CIS665 Team 116</p>
    </div>
  </footer>
</div>
           

</body>
</html>

FOOTER;
    
    echo $pageFooter;
}

function displayHomePageFooter() {
    $year = date('Y');
    $pageFooter = <<< FOOTER
</div>
            </div>
    <footer class="footer">
        <div class="container">
           <p class="text-muted">&copy; $year CIS665 Team 116</p>
        </div>
    </footer>
</div>
           

</body>
</html>

FOOTER;
    
    echo $pageFooter;
}
