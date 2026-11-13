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



  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    function makeTable(data) {
      var body = "";
      $.each(data, function() {
        var row = "";
        $.each(this, function(k, v) {
          row += "<td>" + (v ?? "") + "</td>";
        });
        body += "<tr>" + row + "</tr>";
      });
      return body;
    }

    function updateEmpleados() {
      $.ajax({
        type: "POST",
        url: "submitPostJquery.php",
        dataType: "json",
        cache: false,
        data: $("#formulario").serialize(), // en POST viajan dentro de la petición, no en la URL
        success: function(records) {
          $("#tbody").html(makeTable(records));
        }
      });
    }

    
    updateEmpleados();
  </script>
</body>

</html>