<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verificación de correo electrónico</title>
</head>
<body>
    <p>Hola {{ $user->name }},</p>
    <p>Gracias por registrarte en nuestra aplicación. Por favor, haz clic en el siguiente enlace para verificar tu dirección de correo electrónico:</p>
    <a href="{{ $url }}">Verificar correo electrónico</a>
    <p>Si no has creado una cuenta, no es necesario que realices ninguna acción.</p>
</body>
</html>
