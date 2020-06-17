//take url : JSON
//update html components
function navigate(url){
    setSessionUrl(url);
    breadcrumbUpdate(url);
    filesListUpdate(url);
}

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

<<<<<<< HEAD
//create folder event
const createFolderForm = document.getElementById("createFolder");
createFolderForm.addEventListener("submit", (e)=>{
    e.preventDefault();
    //send formData with "url" and "folderName"
    const formData = new FormData(createFolderForm);
    formData.append("url", sessionStorage.getItem("url"));
    fetch("php/createFolder.php", {method : "POST" , body : formData}).then(res=>navigate(sessionStorage.getItem("url")));
});

//create file event
const createFileForm = document.getElementById("createFile");
createFileForm.addEventListener("submit", (e)=>{
    e.preventDefault();
    //send formData with "url" and "fileName"
    const formData = new FormData(createFileForm);
    formData.append("url", sessionStorage.getItem("url"));
    fetch("php/createFile.php", {method : "POST" , body : formData}).then(res=>navigate(sessionStorage.getItem("url")));
});
=======
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
>>>>>>> 236cdf9044a99c16ac94f902c6e0b1f7bcefcb56
