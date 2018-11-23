<?php require 'include/template_top.php';?>
    <link rel='stylesheet' href='<?php es('css/header.css');?>'>
    <link rel='stylesheet' href='<?php es('css/profile.css');?>'>
  </head>
  <body>
    <?php require 'views/header.php';?>
    <form method='POST' enctype='multipart/form-data' id='updateform'>
      <h1 class='verylargefont yellowfont helvetica mediummarginleft mediumpaddingtop'>
        Edit Profile</h1>
      <div class='rowcontainer flexcenter smallmargintop mediummarginleft mediummarginbottom'>
        <img class='normalmarginleft mediumimg smallborder solidborder' src='<?php es("uploadimg/${result['picture']}");?>'>
        <div class='columncontainer abnormalmarginleft'>
          <label for='dp' class='mediumfont'>Update profile picture</label>
          <div class='rowcontainer normalmargintop'>
            <input type='text' class='normalfont smallheight morewidthcontainer selfaligncenter' id='profile-picture' name='fakepicture' placeholder="Input file picture" disabled>
            <label for='dp-file' class='mediummarginleft' id='browsebt'>Browse</label>
          </div>
          <input type='file' class='smallmargintop' id='dp-file' name='picture'>
        </div>
      </div>
      <div class='columncontainer'>
        <div class='rowcontainer flexstart mediummarginleft smallmargintop smallmarginbottom'>
          <div class='normalfont smallflex normalmarginleft'>Name</div>
          <input type='text' class='smallmarginleft normalfont mediumflex normalmarginright' id='profile-name' name='name' value='<?php e($result['name']);?>'>
        </div>
        <div class='rowcontainer flexstart mediummarginleft smallmargintop smallmarginbottom'>
          <div class='normalfont smallflex normalmarginleft'>Address</div>
          <textarea class='smallmarginleft normalfont mediumflex normalmarginright' rows='6' id='profile-address' name='address'><?php e($result['address']);?></textarea>
        </div>
        <div class='rowcontainer flexstart mediummarginleft smallmargintop smallmarginbottom'>
          <div class='normalfont smallflex normalmarginleft'>Phone Number</div>
          <input type='text' class='smallmarginleft normalfont mediumflex normalmarginright' id='profile-phone' name='phone' value='<?php e($result['phone']);?>'>
        </div>
      </div>
      <div class='spacebetweencontainer'>
        <a href='<?php eu('profile');?>'>
          <input type='button' id='backbt' value='Back'>
        </a>
        <input type='submit' id='savebt' value='Save'>
      </div>
    </form>
    <script type='text/javascript' src='<?php es('js/edit-profile.js');?>'></script>
  </body>
</html>
