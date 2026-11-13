<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>
<body>

<div class="contenedor">

  <ul class="lista-platos">
          <li>lentejas</li>
    <li>paella</li>
    <li>tortilla</li>
    <li>gazpacho</li>
    <li>cocido</li>
     </ul>
   <!-- ── 1. GET con XMLHttpRequest vanilla ── -->
<div class="bloque">
    <form action="" method="get" id="form1">
    <label for="buscar1">Plato:
        <input type="text" name="buscar" id="buscar1">
    </label>
    <input type="submit" value="Buscar">
</form>
 
        <div class="resultados">
            <h3>Resultado</h3>
            <!-- Aquí aparecerán los resultados filtrados con nombre e ingredientes -->
            <ul id="resultado1"></ul>
        </div>
</div>


<!-- ── 1. POST con XMLHttpRequest vanilla ── -->
<div class="bloque">
<form action="" method="post" id="form2">
    <label for="buscar2">Plato:
        <input type="text" name="buscar" id="buscar2">
    </label>
    <input type="submit" value="Buscar">
</form>
 
        <div class="resultados">
            <h3>Resultado</h3>
            <!-- Aquí aparecerán los resultados filtrados con nombre e ingredientes -->
            <ul id="resultado2"></ul>
        </div>
</div>



<!-- ── 1. GET con JQUERY ── -->
<div class="bloque">
<form action="" method="get" id="form3">
    <label for="buscar3">Plato:
        <input type="text" name="buscar" id="buscar3">
    </label>
    <input type="submit" value="Buscar">
</form>
 
        <div class="resultados">
            <h3>Resultado</h3>
            <!-- Aquí aparecerán los resultados filtrados con nombre e ingredientes -->
            <ul id="resultado3"></ul>
        </div>
</div>



<!-- ── 1. POST con JQUERY ── -->

<div class="bloque">
<form action="" method="post" id="form4">
        <label for="buscar4">Plato:
            <input type="text" name="buscar" id="buscar4">
        </label>
        <input type="submit" value="Buscar">
    </form>
   
        <div class="resultados">
            <h3>Resultado</h3>
            <!-- Aquí aparecerán los resultados filtrados con nombre e ingredientes -->
            <ul id="resultado4"></ul>
        </div>
</div>
</div>
     
    <script>
 function mostrarResultados(datos, idResultado) {

        const lista = document.getElementById(idResultado);

      
        lista.replaceChildren();

        datos.forEach(function(plato) {
            const li = document.createElement('li');

            const h4 = document.createElement('h4');
            h4.textContent = plato.plato;

            const p = document.createElement('p');
            p.textContent = 'Ingredientes: ' + plato.ingredientes;

            li.appendChild(h4);
            li.appendChild(p);
            lista.appendChild(li);
        });

        console.log('mostrarResultados → pintado terminado en: ' + idResultado);
    }


//get vainilla

    const formUno = document.getElementById("form1");

   formUno.addEventListener('submit', (e) => {
    e.preventDefault();

    const termino = document.getElementById('buscar1').value;
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = () => {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
                    console.log(xhttp.responseText);

            mostrarResultados(
                JSON.parse(xhttp.responseText),
                'resultado1'
            );
        }
    };

    const url = "buscar.php?buscar=" + encodeURIComponent(termino);

    xhttp.open("GET", url, true);
    xhttp.send();
});




//post vainilla
const formDos = document.getElementById("form2");

formDos.addEventListener('submit', (e) => {
    e.preventDefault();

    const termino = document.getElementById('buscar2').value;
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = () => {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
                    console.log(xhttp.responseText);

            mostrarResultados(
                JSON.parse(xhttp.responseText),
                'resultado2'
            );
        }
    };

    const url = "buscar.php?buscar=" + encodeURIComponent(termino);

    xhttp.open("GET", url, true);
    xhttp.send();
});

//get jquery
    $('#form3').on('submit', (e) => {
        e.preventDefault();

        const termino = $('#buscar3').val();
        console.log('GET jQuery → término buscado: ' + termino);

        $.ajax({
            url: 'buscar.php',       // a dónde mandamos la petición
            method: 'GET',           // método HTTP
            data: { buscar: termino }, // datos que mandamos, jQuery los convierte a ?buscar=termino
            dataType: 'json',        // le decimos a jQuery que esperamos JSON de vuelta
            success: (datos) => {
                // success se ejecuta cuando el servidor responde correctamente
                console.log('GET jQuery → respuesta del servidor: ', datos);
                mostrarResultados(datos, 'resultado3');
            }
        });

        console.log('GET jQuery → petición enviada a buscar.php?buscar=' + encodeURIComponent(termino));
    });

       $('#form4').on('submit', (e) => {
        e.preventDefault();

        var termino = $('#buscar4').val();
        console.log('POST jQuery → término buscado: ' + termino);

        $.ajax({
            url: 'buscar.php',
            method: 'POST',
            data: { buscar: termino }, // jQuery lo mete en el cuerpo de la petición
            dataType: 'json',
            success: (datos) => {
                console.log('POST jQuery → respuesta del servidor: ', datos);
                mostrarResultados(datos, 'resultado4');
            }
        });

        console.log('POST jQuery → petición enviada a buscar.php con cuerpo buscar=' + encodeURIComponent(termino));
    });

    </script>
</body>
</html>