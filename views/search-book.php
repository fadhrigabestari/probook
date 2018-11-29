<?php require 'include/template_top.php';?>
    <link rel='stylesheet' href='<?php es('css/header.css');?>'>
    <link rel='stylesheet' href='<?php es('css/browse.css');?>'>
  </head>
  <body ng-app= "bookApp">
      <?php require 'views/header.php';?>
      <div ng-controller="BookController">
        <h1 class='searchheading'>Search Book</h1>
        <form id='searchform' ng-submit="BookController.search()">
          <input type='text' ng-model= "BookController.bookTitle" id='search' name='search' placeholder='Input search terms...'>
          <br>
          <input type='submit' id='submitbt' value='Search'>
        </form>
        <p> {{controller.bookTitle}} </p>

        <!-- result -->
        <div ng-repeat= "book in BookController.books">
          <p> {{book.title}} </p>
      </div>
    <script type='text/javascript' src='<?php es('js/search-book.js');?>'></script>
  </body>
</html>
