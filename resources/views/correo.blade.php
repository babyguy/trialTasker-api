<!DOCTYPE html>
<html>
<head>
    <title>Correo de confirmacion Registro TrialTasker</title>
</head>
<body>
    <h1>Hola {{$name}} bienvenido a Trial Tasker! </h1>
    <p>Porfavor confirma tu correo electronico.</p>

    <p>para confirmar da click en el sigueinte enlace.</p>

    <a href="{{url('register/verifty/' . $confirmation_code)}}">
        Clik para confirmar tu correo electronico.
    </a>

</body>
<script>
</script>
</html>

