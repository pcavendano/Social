require('./bootstrap');
import './bootstrap';
import '../sass/app.scss'

let file = document.getElementById('file');
file.addEventListener('change', (event) => {
    let image = document.getElementById('output');
    console.log("aquis");
    image.src = URL.createObjectURL(event.target.files[0]);
})
