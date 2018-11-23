<?php require 'include/template_top.php';?>
    <link rel='stylesheet' href='<?php es('css/header.css');?>'>
    <link rel='stylesheet' href='<?php es('css/browse.css');?>'>
  </head>
  <body>
    <?php require 'views/header.php'; ?>
    <div class='resultheading'>
      <h1 class='searchheading'>Search Result</h1>
      <div id='countresult'>
        <span>Found </span><span id='count'><?php e(sizeof($results));?></span><span> result(s)</span>
      </div>
    </div>
<?php foreach ($results as $result) { ?>
    <div class='resultcontent'>
      <div class='bookdetail'>
        <div class='bookimgreview'>
          <img class='image' src='<?php es("uploadimg/${result['cover']}");?>'>
        </div>
        <div class='book'>
          <div class='bookname'><?php e($result['title']);?></div>
          <div class='bookscore'>
            <span class='bookauthor'><?php e($result['author']);?></span>
            <span>&nbsp;-&nbsp;</span>
            <span class='bookrating'><?php e(number_format($result['rating'],1));?></span>
            <span>/5.0 (</span>
            <span class='bookvotecount'><?php e($result['reviewCount']);?></span>
            <span>&nbsp;votes)</span>
          </div>
          <div class='bookdesc'><?php e($result['description']);?></div>
        </div>
      </div>
      <a href='<?php eu('detail', $result['idBook']);?>'>
        <button class='detail'>Detail</button>
      </a>
    </div>
<?php } ?>
  </body>
</html>
