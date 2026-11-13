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

      var params = "lastname=" + encodeURIComponent(lastname) +
        "&firstname=" + encodeURIComponent(firstname) +
        "&city=" + encodeURIComponent(city) +
        "&country=" + encodeURIComponent(country);

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "submitPostJs.php", true);
      // Obligatorio en POST: avisar del formato de los datos
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          document.getElementById("tbody").innerHTML = xhr.responseText;
        }
      };
      xhr.send(params); // en POST los datos van aquí, no en la URL
    }

  
    updateEmpleados();
  </script>
</body>

</html>