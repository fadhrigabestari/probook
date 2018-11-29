function fetchDataGet(url){
    fetch(url)
    .then(response => response.json())
    .then(data => { console.log('yey');console.log(data);}) // Prints result from `response.json()` in getRequest
    .catch(error => console.error(error));
}