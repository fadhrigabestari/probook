<?php require 'include/template_top.php';?>
    <link rel='stylesheet' href='<?php es('css/header.css');?>'>
    <link rel='stylesheet' href='<?php es('css/history.css');?>'>

  </head>
  <body>
  <?php require 'views/header.php'; ?>
    <h1 class="history">History</h1>
    <?php foreach ($results as $result) { ?>
      <div class='historycontent'>
        <div class='bookdetail'>
          <div class='booking'><img class='image' src='<?php es("uploadimg/${result['cover']}");?>'></div>
          <div class='book1'>
            <div class='bookname'><?php e($result['title']);?></div>
            <div class='countbook'><span>Jumlah :&nbsp;</span><span id='count'><?php e($result['quantity']);?></span></div>
            <?php if(($result['comment'])!==null) { ?>
              <div class='review'>Anda sudah memberikan review</div>
            <?php } else { ?>
              <div class='review'>Belum direview.</div>
              <?php //require 'views/history-review.php';
             } ?>
          </div>
          <div class="book2">
            <div class='orderdate'> <?php e($result['orderdate']);?></div></br>
            <div class='ordernumber' id='count'>Nomor Order : # <?php e($result['idTransaction']);?></div>
            </br></br></br></br></br></br>

            <?php if(is_null($result['comment'])) { ?>
              <a href="<?php eu('review', $result['idTransaction']);?>">
                <button class='detail'>Review</button>
              </a>
              <?php //require 'views/history-review.php';
             } ?>
          </div>
        </div>
      </div>
    <?php } ?>
  </body>
</html>
