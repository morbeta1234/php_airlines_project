<?php
include_once 'php/user_session.php';

$userSession = new UserSession();
$userSession->closeSession();  //para que cuando retroceda en la pagina no pueda ingresar de nuevo sin ingresar contraseña

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio de sesion</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3> ¿Ya tienes una cuenta?</h3>
                    <p> Inicia sesion para entrar en la página </p>
                    <button id = "btn__iniciar-sesion">Iniciar sesión</button>
                </div>
                <div class="caja__trasera-crear">
                    <h3>¿Deseas crear usuarios aleatorios?</h3>
                    <p>Crea muchas cuentas de DGAC solo al presionar el botón</p>
                    <button id="btn__crear">Crear datos</button>
                </div>
            <div class="contenedor__login">
                <form action="php/iniciar_sesion.php" method="POST" class="formulario__login">
                    <h2>Iniciar sesión</h2>
                    <input type="text" placeholder="Username" name="username">
                    <label class="lbl-nombre">
                        <span class="text-nomb"> 
                            
                        </span>
                    </label>
                    <input type="password" placeholder="Contraseña" name="password">
                    <label class="lbl-pass">
                        <span class="text-pass"> 
                            
                        </span>
                    </label>
                    <button>Ingresar
                    </button> 
                </form>
                <form action="" class="formulario__crear">
                    <h2>Crear datos</h2>
                    <input type="text" placeholder="Nombre completo">
                    <label class="lbl-nombre_completo">
                        <span class="text-nomb"> 
                        </span>
                    </label>
                    <input type="text" placeholder="rut">
                    <label class="lbl-rut">
                        <span class="text-nomb"> 
                        </span>
                    </label>
                    <input type="text" placeholder="correo">
                    <label class="lbl-correo">
                        <span class="text-nomb"> 
                        </span>
                    </label>
                    <button> Crear datos</button>
                </form>
            </div>
        </div>
    </main>
    <script src="assets/js/script.js"></script>
</body>
</html>