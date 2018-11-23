<?php require 'include/template_top.php';?>
        <link rel='stylesheet' href='<?php es('css/register.css');?>'>
    </head>
    <body>
        <div class="grid-container">
            <div class="polkadot">
                <p>REGISTER</p>
                <div class='columncontainer'>
                    <form method='POST' id='registerform'>
                        <div class='rowcontainer flexstart mediummarginleft smallmargintop '>
                            <div class='mediumfont mediumflex textalignright '>Name</div>
                            <input type='text' placeholder="Input name" class='smallmarginleft mediumfont largeflex verylargemarginright' id='profile-name' name='name'>
                        </div>
                        <div class='rowcontainer flexstart mediummarginleft smallmargintop '>
                            <div class='mediumfont largeflex textalignright'>Username</div>
                            <input type='text' placeholder="Input username" class='smallmarginleft mediumfont mediumflex' id='profile-username' name='username'>
                            <img class='checkmark marginright verysmallmarginleft' id='usercheck' src='<?php es('img/clear.png');?>'>
                        </div>
                        <div class='rowcontainer flexstart mediummarginleft smallmargintop '>
                                <div class='mediumfont mediumflex textalignright'>Email</div>
                                <input type='text' placeholder="Input email" class='smallmarginleft mediumfont mediumflex' id='profile-email' name='email'>
                                <img class='checkmark marginright verysmallmarginleft' id='emailcheck' src='<?php es('img/clear.png');?>'>
                        </div>

                        <div class='rowcontainer flexstart mediummarginleft smallmargintop '>
                                <div class='mediumfont mediumflex textalignright'>Password</div>
                                <input type='password' placeholder="Input password" class='smallmarginleft mediumfont largeflex verylargemarginright' id='profile-password' name='password'>
                        </div>
                        <div class='rowcontainer flexstart mediummarginleft smallmargintop '>
                                <div class='mediumfont mediumflex textalignright'>Confirm password</div>
                                <input type='password' placeholder="Confirm password" class='smallmarginleft mediumfont largeflex verylargemarginright' id='profile-confirm-password' name='confirm-password'>
                        </div>
                        <div class='rowcontainer flexstart mediummarginleft smallmargintop '>
                            <div class='mediumfont mediumflex textalignright'>Address</div>
                            <textarea placeholder="Input address" class='smallmarginleft mediumfont largeflex verylargemarginright' rows='4' id='profile-address' name='address'></textarea>
                        </div>
                        <div class='rowcontainer flexstart mediummarginleft smallmargintop '>
                            <div class='mediumfont mediumflex textalignright'>Phone Number</div>
                            <input placeholder="Input phone number" class='smallmarginleft mediumfont largeflex verylargemarginright' id='profile-phone' name='phone' />
                        </div>
                        <div class='rowcontainer mediummarginleft smallmargintop mediumfont largeflex '>
                                <a href="<?php eu('login')?>">
                                        Already have an account?
                                </a><br/>
                            </div>
                        <div class="smallmargintop">
                                <input id='registerbt' type = "submit" value ="REGISTER"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      <script type='text/javascript' src='<?php es('js/user-register.js');?>'></script>
    </body>
</html>
