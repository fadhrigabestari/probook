<?php require 'include/template_top.php';?>
    <link rel='stylesheet' href='../css/header.css'>
    <link rel='stylesheet' href='../css/profile.css'>
  </head>
  <body>
    <?php include 'views/header.php';?>
    <div class='columncontainer verylargeheight flexcenter darkbluebg'>
      <a href='<?php eu('update');?>' class='selfalignend smallpaddingtop verysmallpaddingright'>
        <img src='<?php es('img/edit.png');?>'>
      </a>
      <img class='roundimg mediumborder yellowborder solidborder largeimg mediumflex'
        src='<?php es("uploadimg/${result['picture']}");?>'>
      <h1 class='smallflex helvetica largefont whitefont mediumpaddingbottom'>
        <?php e($result['name'])?></h1>
    </div>
    <div class='columncontainer'>
      <h1 class='largefont yellowfont helvetica mediummarginleft mediumpaddingtop mediummarginbottom'>
        My Profile</h1>
      <div class='rowcontainer largewidthcontainer largemarginleft flexcenter smallmarginbottom'>
        <img class='smallimg noborder' src='../img/username-logo.png'>
        <div class='mediumfont helvetica mediumflex smallpaddingleft'>Username</div>
        <div class='mediumfont helvetica largeflex'>@<?php e($result['username'])?></div>
      </div>
      <div class='rowcontainer largewidthcontainer largemarginleft flexcenter smallmarginbottom'>
        <img class='verysmallimg noborder verysmallpaddingleft verysmallpaddingright' src='<?php es('img/email-logo.png');?>'>
        <div class='mediumfont helvetica mediumflex'>Email</div>
        <div class='mediumfont helvetica largeflex'><?php e($result['email'])?></div>
      </div>
      <div class='rowcontainer largewidthcontainer largemarginleft flexcenter smallmarginbottom'>
        <img class='verysmallimg noborder verysmallpaddingleft verysmallpaddingright' src='<?php es('img/address-logo.png');?>'>
        <div class='mediumfont helvetica mediumflex smallpaddingleft'>Address</div>
        <div class='mediumfont helvetica largeflex'><?php e($result['address'])?></div>
      </div>
      <div class='rowcontainer largewidthcontainer largemarginleft flexcenter smallmarginbottom'>
        <img class='verysmallimg noborder verysmallpaddingleft verysmallpaddingright' src=<?php es('img/phone-logo.png');?>>
        <div class='mediumfont helvetica mediumflex smallpaddingleft'>Phone Number</div>
        <div class='mediumfont helvetica largeflex'><?php e($result['phone'])?></div>
      </div>
    </div>
  </body>
</html>
