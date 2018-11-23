<?php
function button($path, $id, $text) {
  global $router_mainpath;
  switch (basename($router_mainpath)) {
    case 'search':
    case 'detail':
    case 'order' :
      $active = 'search';
      break;
    case 'history':
    case 'review':
      $active = 'history';
      break;
    case 'profile':
    case 'update':
      $active = 'profile';
      break;
    default:
      $active = '';
  }
  $url = make_url($path);
  $page = basename($url);
  $class = ($active == $page) ? 'tablink-active ' : '';
?>
  <a href='<?php e($url); ?>'>
    <button class='<?php e($class);?>tablink headerborder' id='<?php e($id); ?>'><?php e($text); ?></button>
  </a>
<?php
}

global $auth_user;
?>
    <div class='headercolumn'>
      <div class='header'>
        <div id='title'>
          <span id='pro'>Pro</span><span id='book'>-Book</span>
        </div>
        <div id='greetuser'>
          <span id='greet'>Hi, </span><span id='username'><?php e($auth_user['username']);?></span>
        </div>
        <div id='logo'>
          <a href='<?php eu('logout');?>'>
            <img id='onofflogo' src='<?php es('img/logout-logo.png');?>'>
          </a>
        </div>
      </div>
      <div>
        <?php button('search', 'browsepage', 'Browse'); ?>
        <?php button('history', 'historypage', 'History'); ?>
        <?php button('profile', 'profilepage', 'Profile'); ?>
      </div>
    </div>
