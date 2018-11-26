<?php require 'include/template_top.php';?>
    <link rel='stylesheet' href='<?php es('css/header.css');?>'>
    <link rel='stylesheet' href='<?php es('css/browse.css');?>'>
  </head>
  <body>
    <?php require 'views/header.php'; ?>
    <div class='resultheading'>
      <h1 class='searchheading'>Search Result</h1>
      <div id='countresult'>
        <span>Found </span><span id='count'><?php e(sizeof($results) - 1);?></span><span> result(s)</span>
      </div>
    </div>
<?php for($i = 0; $i < count($results) - 1; $i++) { ?>
    <div class='resultcontent'>
      <div class='bookdetail'>
        <div class='bookimgreview'>
          <img class='image' src='<?php e($results[$i]->cover);?>'>
        </div>
        <div class='book'>
          <div class='bookname'><?php e($results[$i]->title);?></div>
          <div class='bookscore'>
            <span class='bookauthor'><?php
              if(is_array($results[$i]->authors)) {
                for($j = 0; $j < count($results[$i]->authors); $j++) {
                  e($results[$i]->authors[$j]);
                  e(', ');
                }
              } else {
                e($results[$i]->authors);
              }?></span>
            <span>&nbsp;-&nbsp;</span>
            <span class='bookrating'><?php e(number_format($results[$i]->rating,1));?></span>
            <span>/5.0 (</span>
            <span class='bookvotecount'><?php e(0);?></span>
            <span>&nbsp;votes)</span>
          </div>
          <div class='bookdesc'><?php e($results[$i]->description);?></div>
        </div>
      </div>
      <!-- <a href='<?php eu('detail', $result['idBook']);?>'> -->
      <a>
        <button class='detail'>Detail</button>
      </a>
    </div>
<?php } ?>
  </body>
</html>
