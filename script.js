// take url : JSON
// update session storage url
function setSessionUrl(url){
    sessionStorage.setItem("url",url);
}

// take url : JSON
// update #breadcrumb element
function breadcrumbUpdate(url){
    const breadcrumbElt = document.getElementById("breadcrumb");
    breadcrumbElt.innerHTML = "";
    const formData = new FormData();
    formData.append("url",url);
    fetch("php/breadcrumb.php", {method: "POST", body: formData}).then(res=>res.json()).then(data=>{
        data.forEach(element => {
            breadcrumbElt.innerHTML += element;
        });
    });
}

// take url : JSON
// update #listFiles element
function filesListUpdate(url){
    const listFilesElt = document.getElementById("listFiles");
    listFilesElt.innerHTML = "";
    const formData = new FormData();
    formData.append("url",url);
    fetch("php/listFiles.php", {method: "POST", body: formData}).then(res=>res.json()).then(data=>{
        data.forEach(element => {
            listFilesElt.innerHTML += element;
        });
    });
}

// TEST STF
// A button has been clicked ?
function btnFlipState(button, state) {
    const btn = document.getElementById(button);
    var state = state ^ 1;
    btn.addEventListener("click", setSessionBtnState(btn, state));
}

// Save buttons state
// button = button id
// state : O = inactive / 1 = active
function setSessionBtnState(button, state) {
    sessionStorage.setItem(button,state);
}
// TEST STF

function navigate(url){
    setSessionUrl(url);
    breadcrumbUpdate(url);
    filesListUpdate(url);
}