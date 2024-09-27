function submitFormById(id) {
    const form = document.getElementById(`form-edit-${id}`)
    form.submit();
}

function showImage(event) {
    const thumb = document.getElementById('thumb');
    thumb.src = URL.createObjectURL(event.target.files[0]);
}
