document.getElementById("btn__crear").addEventListener("click", crear_datos);
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciar_sesion);
var contenedor_login = document.querySelector(".contenedor__login");
var formulario_login = document.querySelector(".formulario__login");
var formulario_crear = document.querySelector(".formulario__crear");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_crear = document.querySelector(".caja__trasera-crear");

function crear_datos(){
    formulario_crear.style.display = "block";
    contenedor_login.style.left = "310px";
    formulario_login.style.display = "none";
    caja_trasera_crear.style.opacity = "0"
    caja_trasera_login.style.opacity = "1"

}

function iniciar_sesion(){
    formulario_crear.style.display = "none";
    contenedor_login.style.left = "-50px";
    formulario_login.style.display = "block";
    caja_trasera_crear.style.opacity = "1"
    caja_trasera_login.style.opacity = "0"

}