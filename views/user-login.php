<?php require 'include/template_top.php';?>
        <link rel='stylesheet' href='<?php es('css/login.css');?>'>
    </head>
    <body>
        <div class="grid-container">
            <div class="polkadot">
                <p>LOGIN</p>
                <div class='columncontainer'>
                  <form method='POST' id='loginform'>
                    <div class='rowcontainer flexstart mediummarginleft smallmargintop '>
                        <div class='mediumfont mediumflex textalignright'>Username</div>
                        <input type='text' class='smallmarginleft mediumfont largeflex verylargemarginright' id='username' name="username">
                    </div>
                    <div class='rowcontainer flexstart mediummarginleft smallmargintop '>
                        <div class='mediumfont mediumflex textalignright'>Password</div>
                        <input type='password' class='smallmarginleft mediumfont largeflex verylargemarginright' id='password' name="password">
                    </div>
                    <div class='rowcontainer mediummarginleft smallmargintop mediumfont largeflex '>
                        <a href="<?php eu('register')?>">
                            Don't have an account?
                        </a><br/>
                    </div>
                    <div class="smallmargintop">
                        <input id='loginbt' type = "submit" value ="LOGIN"/>
                    </div>
                  </form>
            </div>
        </div>
      <script type='text/javascript' src='<?php es('js/user-login.js');?>'></script>
    </body>
</html>
