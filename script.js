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

//create folder event
const createFolderForm = document.getElementById("createFolder");
createFolderForm.addEventListener("submit", (e)=>{
    e.preventDefault();
    //send formData with "url" and "folderName"
    const formData = new FormData(createFolderForm);
    formData.append("url", sessionStorage.getItem("url"));
    fetch("php/createFolder.php", {method : "POST" , body : formData}).then(res=>navigate(sessionStorage.getItem("url")));
});