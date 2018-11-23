<?php require 'include/template_top.php';?>
    <link rel='stylesheet' href='<?php es('css/header.css');?>'>
    <link rel='stylesheet' href='<?php es('css/history-review.css');?>'>
  </head>

  <body>
      <?php require 'views/header.php'; ?>
      <div class="header">    
            <div class ="">
                <h1 class="bookname"><?php e($result['title']);?></h1>
                <div class="author"><?php e($result['author']);?></div>
            </div>
            <img class='image' src='<?php es("uploadimg/${result['cover']}");?>'>
      </div>
      <form method="POST" id="ratingcomment"action='<?php eu("review")?>'>
            <div class="rating">Add Rating</div>
            <div class="center" id="ratingborder">
              <img class='star' id="1" value= 1 src='<?php es("img/emptystar.png");?>' type="button" onclick="ratingStar(this.getAttribute('value'))" onmouseover="mouseOver(this.getAttribute('value'))" onmouseout="mouseOut(this.getAttribute('value'))">
              <img class='star' id="2" value= 2 src='<?php es("img/emptystar.png");?>' type="button" onclick="ratingStar(this.getAttribute('value'))" onmouseover="mouseOver(this.getAttribute('value'))" onmouseout="mouseOut(this.getAttribute('value'))">
              <img class='star' id="3" value= 3 src='<?php es("img/emptystar.png");?>' type="button" onclick="ratingStar(this.getAttribute('value'))" onmouseover="mouseOver(this.getAttribute('value'))" onmouseout="mouseOut(this.getAttribute('value'))">
              <img class='star' id="4" value= 4 src='<?php es("img/emptystar.png");?>' type="button" onclick="ratingStar(this.getAttribute('value'))" onmouseover="mouseOver(this.getAttribute('value'))" onmouseout="mouseOut(this.getAttribute('value'))">
              <img class='star' id="5" value= 5 src='<?php es("img/emptystar.png");?>' type="button" onclick="ratingStar(this.getAttribute('value'))" onmouseover="mouseOver(this.getAttribute('value'))" onmouseout="mouseOut(this.getAttribute('value'))">
            </div>
            <div class="comment">Add Comment</div>
            <textarea name= "comment" rows="5" id="comment"></textarea><br/>
            <input name="rating" type="hidden" id="rating"  value="0">
            <input name="idTransaction" type="hidden" value="<?php e($idTransaction);?>">
          <div class='spacebetweencontainer'>
            <a href="<?php eu('history');?>">
              <input type='button' id='backbt' value='Back'>
            </a>
              <input type='submit' id='submitbt' value ="submit"/>  
          </div>  
      </form>
      <script src="<?php es("js/history-review.js");?>"></script>
  </body>
</html>

            
          





