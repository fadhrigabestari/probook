<?php require 'include/template_top.php';?>
    <link rel='stylesheet' href='<?php es('css/header.css');?>'>
    <link rel='stylesheet' href='<?php es('css/browse.css');?>'>
  </head>
  <body>
      <?php require 'views/header.php';?>
      <h1 class='searchheading'>Search Book</h1>
      <form id='searchform'>
        <input type='text' id='search' name='search' placeholder='Input search terms...'>
        <br>
        <input type='submit' id='submitbt' value='Search'>
      </form>
    <script type='text/javascript' src='<?php es('js/search-book.js');?>'></script>
  </body>
</html>
