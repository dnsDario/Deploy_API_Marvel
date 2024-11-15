<?php
#Inicializar una nueva sesión de cURL; ch = cURL handle
$API_URL = "https://whenisthenextmcufilm.com/api";
$ch = curl_init(($API_URL));

// Indicar que queremos recibir el resultado de la petición y no mostrarla en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Ejecutar la petición y guardar el resultado
$result = curl_exec($ch);
//decodificamos el json que hemos recibido de la API

/* Una alternativa a todo lo anterior, sería utilizar file_get_contents --> $result = file_get_contents(API_URL), y obtienes el json igual,
es la opción más fácil en el caso de que solo quieras hacer un GET de una API. Con el cURL es más fácil ver los estados, y sirve también para hacer POST, PUT, etc */

$data = json_decode($result, true);
//cerramos el cURL
curl_close($ch);

/* ¡¡ El código no se continua ejecutando hasta que no resuelve los cURL, de manera síncrona !! */


?>

<head>

    <html lang="es">
    <meta charset="UTF-8" />
    <title>La próxima película de Marvel</title>
    <meta name="descripción" content="La próxima película de Marvel" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Centered viewport -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
</head>
<main>
    <pre style="font-size:12px; width: 80vw; overflow: scroll; height: 150px"><?= var_dump($data); ?></pre> <!-- con pre se visualizan los datos de forma adecuada -->
    <section>
        <h4>La próxima película de Marvel será:</h4>
        <h1> <?= $data["title"] ?></h2>
        <h3> Fecha de estreno: <?= $data["release_date"] ?></h3>
        <img src="<?= $data["poster_url"] ?>" alt="poster_peli" style="border-radius: 16px">
        <p>Sinopsis: <?= $data["overview"] ?></p>
    </section>

    <section>
        <h4>Y la siguiente será:</h4>
        <h1> <?= $data["following_production"]["title"] ?></h1>
        <h3> Fecha de estreno: <?= $data["following_production"]["release_date"] ?></h3>
        <img src="<?= $data["following_production"]["poster_url"] ?>" alt="poster_peli" style="border-radius: 16px">
        <p>Sinopsis: <?= $data["following_production"]["overview"] ?></p>
    </section>

</main>

<style>
    main {
        display: flex;
        flex-direction: column;
        width: 100vw;
        align-items: center;
    }

    section {
        display: flex;
        flex-direction: column;
        width: 70vw;
        text-align: center;
        align-items: center;
    }

    img {
        width: 600px;
        margin-bottom: 50px;
    }
</style>