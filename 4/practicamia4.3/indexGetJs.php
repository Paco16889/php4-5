<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <title>Empleados con filtros AJAX</title>
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <h1>Base de datos de empleados</h1>

  <table id="employees">
    <thead>
      <tr>
        <th>ID</th>
        <th>Apellido</th>
        <th>Nombre</th>
        <th>Título</th>
        <th>Tratamiento</th>
        <th>Nacimiento</th>
        <th>Contratación</th>
        <th>Dirección</th>
        <th>Ciudad</th>
        <th>Región</th>
        <th>C.P.</th>
        <th>País</th>
        <th>Teléfono</th>
        <th>Jefe</th>
      </tr>
    </thead>
    <tbody id="tbody"></tbody>
  </table>

  <div id="filter">
    <h2>Filtrado</h2>
    <form id="formulario">
      <label for="lastname">Apellido:
        <input type="text" id="lastname" name="lastname">
      </label>
      <label for="firstname">Nombre:
        <input type="text" id="firstname" name="firstname">
      </label>
      <label for="city">Ciudad:
        <input type="text" id="city" name="city">
      </label>
      <label for="country">País:
                <input type="text" id="country" name="country">
      </label>
    </form>
    <input type="button" value="Filtrar" onclick="updateEmpleados();">
  </div>



  <script>
    function updateEmpleados() {
      var lastname = document.getElementById("lastname").value;
      var firstname = document.getElementById("firstname").value;
      var city = document.getElementById("city").value;
      var country = document.getElementById("country").value;

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) { // petición terminada
          if (xhr.status === 200) { // todo OK
            document.getElementById("tbody").innerHTML = xhr.responseText; // el PHP ya devuelve <tr><td>
          } else {
            alert("Error " + xhr.status + ": " + xhr.statusText);
          }
        }
      };
      // En GET los datos van en la URL
      xhr.open("GET", "submitGetJs.php?lastname=" + encodeURIComponent(lastname) +
        "&firstname=" + encodeURIComponent(firstname) +
        "&city=" + encodeURIComponent(city) +
        "&country=" + encodeURIComponent(country));
      xhr.send();
    }

  
    updateEmpleados();
  </script>
</body>

</html>