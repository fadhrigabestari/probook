angular.module('bookApp', []).controller('BookController', function($scope) {
    var control = this;
    console.log("control: ");
    console.log(control);
    control.books = [];
    control.bookTitle = "";

    control.search = function() {
        while (control.books.length > 0) {
          control.books.pop();
        }
        var xhttp = new XMLHttpRequest();
        document.getElementById("loader").style.display="block";
        xhttp.onreadystatechange = function() {
            console.log(this.status);
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                json = JSON.parse(this.responseText);
                angular.forEach(json.item, function(book) {
                    control.books.push(book);
                });
                document.getElementById("loader").style.display="none";
                $scope.$apply();
            }
        };
        xhttp.open("POST", "search?search="+control.bookTitle,true);
        xhttp.setRequestHeader("Content-type", "application/x-ww-form-urlencoded");
        xhttp.send("title=" + control.bookTitle)
    }
});

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

