<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a Fastkart</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f7f7f7; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 20px; border-radius: 10px;">
        <h2 style="color: #0da487;">¡Bienvenido a Fastkart!</h2>

        <p>Hola <strong>{{ $user->name }}</strong>,</p>

        <p>
            Gracias por registrarte en nuestra tienda. Ahora puedes explorar productos,
            agregar favoritos y realizar tus compras fácilmente.
        </p>

        <p style="margin-top: 20px;">
            <a href="{{ url('/') }}"
               style="background:#0da487; color:white; padding:12px 20px; text-decoration:none; border-radius:6px;">
                Ir a la tienda
            </a>
        </p>

        <p style="margin-top: 30px; font-size: 12px; color: #777;">
            Este correo fue enviado automáticamente. No respondas a este mensaje.
        </p>
    </div>
</body>
</html>
