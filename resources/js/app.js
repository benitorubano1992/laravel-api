import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])
const btnDelete = document.querySelectorAll('.delete-btn');
btnDelete.forEach(btn => {
    btn.addEventListener('click', event => {
        event.preventDefault();
        console.log(event.currentTarget.dataset.title);
        const modal = new bootstrap.Modal(
            document.getElementById("my-modal")
        );
        document.querySelector(".modal-title").textContent = `Vuoi eliminare il progetto ${event.currentTarget.dataset.title}?`;
        const modalBtn = document.querySelector("#delete-project");
        modalBtn.addEventListener('click', () => {
            btn.parentElement.submit();
        })
        modal.show();
    })
})



//image preview create

const coverInput = document.getElementById("cover_image");

coverInput.addEventListener('change', (e) => {
    const uploadedFile = e.target.files[0];
    console.log(uploadedFile);
    if (uploadedFile) {
        const reader = new FileReader();
        reader.addEventListener('load', () => {
            console.log(reader.result);
            document.querySelector(".image-preview").innerHTML = `<img src="${reader.result}" alt="cover-image">`;
        })
        reader.readAsDataURL(uploadedFile);
    }
})