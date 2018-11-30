<?php require 'include/template_top.php';?>
    <link rel='stylesheet' href='<?php es('css/header.css');?>'>
    <link rel='stylesheet' href='<?php es('css/browse.css');?>'>
    <link rel='stylesheet' href='<?php es('css/loader.css');?>'>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  </head>
  <body ng-app= "bookApp">
      <?php require 'views/header.php';?>
      <div ng-controller="BookController as control">
        <h1 class='searchheading'>Search Book</h1>
        <form id='searchform' ng-submit="control.search()">
          <input type='text' ng-model= "control.bookTitle" id='search' name='search' placeholder='Input search terms...'>
          <br>
          <input type='submit' id='submitbt' value='Search'>
        </form>
        <div class="lds-facebook" style="display:none" id="loader"><div></div><div></div><div></div></div>

        <!-- result -->
        <div ng-if="control.books.length> 0">
            <div class='resultheading'>
                <h1 class='searchheading'>Search Result</h1>
                <div id='countresult'>
                  <span>Found </span><span id='count'></span>{{control.books.length}}<span> result(s)</span>
                </div>
            </div>

            <div ng-repeat= "book in control.books">
                <div class='bookdetail'>
                    <div class='bookimgreview'>
                        <img class='image' ng-src='{{book.cover}}'>
                    </div>
                    <div class='book'>
                        <div class='bookname' id='bookname'> {{book.title}}</div>
                        <div class='bookscore'>
                          <span class='bookauthor' id='bookauthor'>{{book.authors}}</span>
                          <span>&nbsp;-&nbsp;</span>
                          <span class='bookrating'>{{book.rating}}</span>
                          <span>/5.0 (</span>
                          <span class='bookvotecount'>{{book.ratingCount}}</span>
                          <span>&nbsp;votes)</span>
                        </div>
                        <div class='bookdesc' id='bookdesc'>{{book.description}}</div>
                    </div>
              </div>
              <a href='<?php eu('detail', '{{book.idBook}}');?>'>
                <button class='detail'>Detail</button>
              </a>
            </div>
        </div>
    <script type='text/javascript' src='<?php es('js/search-book.js');?>'></script>
  </body>
</html>