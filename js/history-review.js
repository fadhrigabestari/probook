var rating = 0;
function ratingStar(id) {  
  for ( i=1;i<=5;i++){
    if(i<=id){
      document.getElementById(i).src=probookStaticBase+'img/filledstar.png';
    } else{
      document.getElementById(i).src=probookStaticBase+'img/emptystar.png';
    }
    
  }
  rating = id;
  document.getElementById("rating").value = id;
}

function mouseOver(id) {  
  for ( i=1;i<=5;i++){
    if(i<=id){
      document.getElementById(i).src=probookStaticBase+'img/filledstar.png';
    } else{
      document.getElementById(i).src=probookStaticBase+'img/emptystar.png';
    }
    
  }
}
function mouseOut(id) {  
  for ( i=1;i<=5;i++){
    if(i<=rating){
      document.getElementById(i).src=probookStaticBase+'img/filledstar.png';
    } else{
      document.getElementById(i).src=probookStaticBase+'img/emptystar.png';
    }
    
  }
}

function validateRating() {
  rating = document.getElementById('rating').value;
  if(rating==0) {
    return false;
  } else {
    return true;
  }
}

function validateComment() {
  comment = document.getElementById('comment').value;
  if(comment.length == 0 || comment.length > 50) {
    return false;
  } else {
    return true;
  }
}

function redElement(elementId, red) {
  var classList = document.getElementById(elementId).classList;
  if (red)
    classList.add('redborder');
  else
    classList.remove('redborder');
  return red;
}

function redComment() {
  return redElement('comment', !validateComment());
}

function redRating() {
  return redElement('rating', !validateRating());
}

document.getElementById('comment').onblur = redComment;
document.getElementById('rating').onblur = redRating;

document.getElementById('ratingcomment').addEventListener("submit", function(event) {
  var invalid = [
    redComment(), redRating()
  ];
  if (invalid.some(x => x))
    event.preventDefault();
});
