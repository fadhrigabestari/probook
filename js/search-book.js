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
