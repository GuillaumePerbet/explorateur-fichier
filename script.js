//update navigator from directory url
function navigate(url){
    setSessionUrl(url);
    breadcrumbUpdate(url);
    filesListUpdate(url);
    setSessionSort();
}

//stock current url in session storage
function setSessionUrl(url){
    sessionStorage.setItem("url",url);
}

//update breadcrumb in navigator from directory url
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

//update files list in navigator from directory url
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

//create folder form handler
const createFolderForm = document.getElementById("createFolder");
createFolderForm.addEventListener("submit", (e)=>{
    e.preventDefault();
    //send current url and new folder name
    const formData = new FormData(createFolderForm);
    formData.append("url", sessionStorage.getItem("url"));
    fetch("php/createFolder.php", {method : "POST" , body : formData}).then(res=>navigate(sessionStorage.getItem("url")));
});

//create file form handler
const createFileForm = document.getElementById("createFile");
createFileForm.addEventListener("submit", (e)=>{
    e.preventDefault();
    //send current url and new file name
    const formData = new FormData(createFileForm);
    formData.append("url", sessionStorage.getItem("url"));
    fetch("php/createFile.php", {method : "POST" , body : formData}).then(res=>navigate(sessionStorage.getItem("url")));
});

//delete file at url and update navigator
function deleteFile(event,url){
    const formData = new FormData();
    formData.append('url',url);
    fetch('php/deleteFile.php',{method: 'POST', body: formData}).then(res=>navigate(sessionStorage.getItem("url")));
    if (event){
        event.stopPropagation();
    }
}

//show content of file at url
function openFile(url){
    const formData = new FormData();
    formData.append('url',url);
    fetch('php/openFile.php',{method: 'POST', body: formData}).then(res=>res.json()).then(data=>alert(data));

}

//stock url and name of copied file in session storage
function copyFile(event,url,fileName){
    sessionStorage.setItem("copyFileName",fileName);
    sessionStorage.setItem("copySourceUrl", url);
    event.stopPropagation();
}

//stock url and name of cutted file in session storage
//stock cut mode
function cutFile(event,url,fileName){
    sessionStorage.setItem("copyFileName",fileName);
    sessionStorage.setItem("copySourceUrl", url);
    sessionStorage.setItem("cutMode", true);
    event.stopPropagation();
}

//paste copied or cuuted file in current directory
function pasteFile(){
    //get informations from session storage
    const sourceUrl = sessionStorage.getItem("copySourceUrl");
    const fileName = sessionStorage.getItem("copyFileName");
    const cutMode = sessionStorage.getItem("cutMode");
    const currentUrl = sessionStorage.getItem("url");
    //if file was previously copied or cut
    if (sourceUrl){
        const formData = new FormData();
        formData.append("sourceUrl", sourceUrl);
        formData.append("currentUrl", currentUrl);
        formData.append("fileName", fileName);
        //POST informations to copy file handler
        fetch("php/copyFile.php",{method : "POST", body : formData}).then(res=>{
            if(cutMode){
                //delete source if cut mode
                deleteFile(false,sourceUrl);
            }else{
                //update navigator
                navigate(currentUrl);
            }
            //clear copy information storage
            sessionStorage.removeItem("cutMode");
            sessionStorage.removeItem("copySourceUrl");
            sessionStorage.removeItem("copyFileName");
        });
    }
}

//Reversed sort
function filesListRevUpdate(url){
    const listFilesElt = document.getElementById("listFiles");
    listFilesElt.innerHTML = "";
    const formData = new FormData();
    formData.append("url",url);
    fetch("php/listFilesRev.php", {method: "POST", body: formData}).then(res=>res.json()).then(data=>{
        data.forEach(element => {
            listFilesElt.innerHTML += element;
        });
    });
}

//check btn onclick event
const sortBtn = document.getElementById('sortBtn');
sortBtn.addEventListener('click', flipSort);

function setSessionSort() {
    if (!sessionStorage.getItem("sort")) {
        sessionStorage.setItem("sort", 0);
    }
}

//flip state / rev sort if necessary
function flipSort() {
    let state = sessionStorage.getItem("sort");
    state ^= 1;
    sessionStorage.setItem("sort", state);
    let url = sessionStorage.getItem("url");
    if (state === 0) {
        filesListUpdate(url);
    } else {
        filesListRevUpdate(url);
    }
}