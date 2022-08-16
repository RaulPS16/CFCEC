var selectElement = document.querySelector('#select');

selectElement.addEventListener('change', (event) =>{
    var resultado = document.querySelector('#btnCambiarRol');
    resultado.setAttribute('href','url');
    console.log(selectElement.getAttribute('href'));
})