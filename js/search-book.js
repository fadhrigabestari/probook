function validateSearch() {
  name = document.getElementById('search').value;
  return (name.length > 0);
}

function redSearch() {
  return redElement('search', !validateSearch());
}

function redElement(elementId, red) {
  var classList = document.getElementById(elementId).classList;
  if (red)
    classList.add('redborder');
  else
    classList.remove('redborder');
  return red;
}

document.getElementById('search').onblur = redSearch;

document.getElementById('searchform').addEventListener("submit", function(event) {
  var invalid = [
    redSearch()
  ];
  if (invalid.some(x => x))
    event.preventDefault();
});

angular.module('bookApp', []).controller('BookController', function($scope) {
    var control = this;
    control.books = [];
    control.bookTitle = "";

    control.search = function() {
        while (control.books.length > 0) {
          control.books.pop();
        }
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                json = JSON.parse(this.responseText);
                angular.foreach(json.item, function(book) {
                    control.books.push(book);
                });
                $scope.apply();
            }
        };
        xhttp("POST", "./search.php" ,true);
        xhttp.setRequestHeader("Content-type", "application/x-ww-form-urlencoded");
        xhttp.send("title=" + control.bookTitle)
    }
});
