function breadcrumb(url){
    url = `url=${url}`;
    fetch("php/breadcrumb.php", {method: "POST" , headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: url});
}