function submitFormById(id) {
    const form = document.getElementById(`form-edit-${id}`)
    form.submit();
}

function showImage(event) {
    const thumb = document.getElementById('thumb');
    thumb.src = URL.createObjectURL(event.target.files[0]);
}

function validateSearch(){
    let validate = document.getElementById('validate').value;
    if(validate.trim() === '') {
       alert('Inserisci almeno un titolo per effettuare la ricerca');
        return false;
    }
    return true;
}
