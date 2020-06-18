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

//create file event
const createFileForm = document.getElementById("createFile");
createFileForm.addEventListener("submit", (e)=>{
    e.preventDefault();
    //send formData with "url" and "fileName"
    const formData = new FormData(createFileForm);
    formData.append("url", sessionStorage.getItem("url"));
    fetch("php/createFile.php", {method : "POST" , body : formData}).then(res=>navigate(sessionStorage.getItem("url")));
});

//take url : JSON, file : string
//delete file at url
function deleteFile(url,file){
    const formData = new FormData();
    formData.append('url',url+"\\"+file);
    fetch('php/deleteFile.php',{method: 'POST', body: formData}).then(res=>navigate(url));
}

//take url : JSON
//open file at url
function openFile(url){
    const formData = new FormData();
    formData.append('url',url);
    fetch('php/openFile.php',{method: 'POST', body: formData}).then(res=>res.json()).then(data=>alert(data));

}

//take url : JSON
//stock url and copy mode in session storage
function copyFile(url){
    sessionStorage.setItem("copyUrl", url);
    sessionStorage.setItem("copyMode", false);
}

//take url : JSON
//stock url and copy mode in session storage
function cutFile(url){
    sessionStorage.setItem("copyUrl", url);
    sessionStorage.setItem("copyMode", true);
}