function takePhoto(photoName=""){
    let fileInput = document.getElementById('photo');
    let file = fileInput.files[0];
    if(file!=undefined){
        let formData = new FormData();

        formData.append('photo', file);

        let xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('imagePreview').innerHTML = xhr.responseText;
            }
        };
        xhr.open('POST', 'upload.php', true);
        xhr.send(formData);
    }
    else{
        let photo = document.getElementById('imagePreview');
        if(photoName=="")
            photo.innerHTML="";
        else{
            photo.innerHTML = `<img src='\\images\\${photoName}' width='150'/>`
        }

    }


}
function selectPhoto(){
    document.getElementById("photo").click();
}
function deleteProduct(id){
    if(confirm(`Ви впевнені, що хочете видалити продукт з індексом ${id}?`)){
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            console.log('Ready state:', xhr.readyState);
            console.log('Status:', xhr.status);

            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    console.log('Response:', xhr.responseText);
                } else {
                    console.error('Error:', xhr.status, xhr.statusText);
                }
            }
        };
        xhr.open('DELETE', 'delete.php?id='+id, true);
        xhr.send();

    }

}



