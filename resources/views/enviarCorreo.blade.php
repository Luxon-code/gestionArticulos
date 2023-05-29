<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de usuario</title>
</head>
<body>
    <p>Hola!! Binvenido a nuestro sistema</p>
    <p>Te registraste con las siguientes credenciales</p>
    <ul>
        <li>{{$usuario->usuNombre}}</li>
        <li>{{$usuario->usuContraseña}}</li>
    </ul>
    <p>Esperamos que disfrutes de nuestros servicios...</p>
</body>
</html>