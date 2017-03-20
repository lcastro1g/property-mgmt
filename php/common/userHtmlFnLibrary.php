<?php

/* 
 * Purpose: User common page elements as PHP methods
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     20 Feb 2017
 */

require_once ("./common/dto/User.php");

function displayLogin($error, $redirect) {
    $login = <<< LOGIN
<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
            </div>
            <div style="padding-top:30px" class="panel-body">
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <form id="loginform" class="form-horizontal" role="form" action="login.php" method="post">
                    <input type="hidden" name="redirect" value="$redirect" />
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username" maxlength="50" required>
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password" maxlength="50" required>
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button id="btn-login" type="submit" name="login" class="btn btn-success"><i class="icon-hand-right"></i>Login</button>
                            <span class="help-inline"><strong>$error</strong></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                Don't have an account!
                                <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                    Sign Up Here
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="panel-title">Sign Up</div>
                <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
            </div>
            <div class="panel-body">
                <form id="signupform" class="form-horizontal" role="form" action="register.php" method="post">

                    <div id="signupalert" style="display:none" class="alert alert-danger">
                        <p>Error:</p>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email Address" maxlength="75" autofocus data-error="email address is invalid" required>
                            <div class="help-block with-errors"></div> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" class="form-control" name="firstname" placeholder="First Name" maxlength="50" data-error="First name has invalid characters" required>
                            <div class="help-block with-errors"></div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-md-3 control-label">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" class="form-control" name="lastname" placeholder="Last Name" maxlength="50" data-error="Last name has invalid characters" required>
                            <div class="help-block with-errors"></div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-md-3 control-label">Username</label>
                        <div class="col-md-9">
                            <input type="text" data-minlength-"8" class="form-control" id="inputUsername" name="username" maxlength="50" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Password</label>
                        <div class="col-md-9">
                            <input type="password" data-minlength="8" class="form-control" id="inputPassword" name="password" maxlength="50" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-md-3 control-label">Role</label>
                        <div class="col-md-9">
                            <select name="roleid" id="role" class="form-control">
LOGIN;
    echo $login;
}
function displayLoginSubmit() {
    $loginSubmit = <<< LOGINSUBMIT
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-signup" type="submit" name="register" class="btn btn-success"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>            

LOGINSUBMIT;
    echo $loginSubmit;
}

function displayRoles() {
    $roleList = getRoleList();  // get the roles to populate the list box
    foreach ($roleList as $aRole)
    {
       extract($aRole);
       $output .= <<<HTML
       <option value="$RoleID">$Role</option>
HTML;
    }
    echo $output;
}

function displayRegisterUser(User $user) {
    
    $firstname = $user->getFirstName();
    $lastname = $user->getLastName();
    $email = $user->getEmail();
    $username = $user->getUsername();
    $password = $user->getPassword();
    $role = $user->getRoleID();
    
    $register = <<< REGISTER
            <div class="container">
                <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>
                        <div class="panel-body">
                            <form id="signupform" class="form-horizontal" role="form" action="register.php" method="post">

                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email Address" value="$email" maxlength="75" autofocus data-error="email address is invalid" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" class="form-control" name="firstname" placeholder="First Name" value="$firstname" maxlength="50" data-error="First name has invalid characters" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" class="form-control" name="lastname" placeholder="Last Name" value="$lastname" maxlength="50" data-error="Last name has invalid characters" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-md-3 control-label">Username</label>
                                    <div class="col-md-9">
                                        <input type="text" data-minlength-"8" class="form-control" id="inputUsername" name="username" value="$username" placeholder="Username" maxlength="50" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" data-minlength="8" class="form-control" id="inputPassword" name="password" value="$password" placeholder="Password" maxlength="50" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="role" class="col-md-3 control-label">Role</label>
                                    <div class="col-md-9">
                                        <select name="roleid" id="role" class="form-control">
REGISTER;
    echo $register;
}

function displayRegisterUserSubmit($error,$redirect) {
    $registerSubmit = <<< REGISTERSUBMIT
</select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- Button -->
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="submit" name="register" class="btn btn-success"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                                        <br><br>
                                        <div class="alert alert-info">
                                           <strong>Warning!&nbsp;</strong>$error
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="loginbox" style="display:none; margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="panel-title">Sign In</div>
                        </div>
                        <div style="padding-top:30px" class="panel-body">
                            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                            <form id="loginform" class="form-horizontal" role="form" action="login.php" method="post">
                                <input type="hidden" name ="redirect" value ="$redirect" />
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username" maxlength="50" required>
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="login-password" type="password" class="form-control" name="password" placeholder="password" maxlength="50" required>
                                </div>
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-12 controls">
                                        <button id="btn-login" type="submit" name="login" class="btn btn-success"><i class="icon-hand-right"></i>Login</button>
                                        <span class="help-inline"><strong></strong></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                            Don't have an account!
                                            <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                                Sign Up Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
REGISTERSUBMIT;
    echo $registerSubmit;
}

function displayTransitionMessage($message) {
    $transitionMsg = <<< TRANSITIONMSG
 <div class="container">
        <div class="alert alert-success"><strong>Info!</strong>$message</div>
 </div>

TRANSITIONMSG;
    echo $transitionMsg;
}

