<?php
  session_start();
  require '../vendor/autoload.php';
  use Clases\Articulos;
  $articulos = new Articulos();
  $misarticulos = $articulos->devolverTodos();
  $articulos=null;
?>
<!DOCTYPE html>
<html lang="es">
<?php
  require 'resources/head.php';
  head('Principal');
?>
<body>
  <?php
      require 'resources/navbar.php';
  ?>
  <div class="container mt-3 text-center">
    <a href='crearArticulo.php' class='btn btn-primary my-3'>Nuevo artículo</a>
    <h3 class="text-center mt-3">Listado de artículos</h3>
  </div>
  <div class="container mt-3">
    <?php
        require 'resources/mensajes.php';
    ?>
    <table class="table table-secondary w-75 mx-auto table-striped text-center">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Precio</th>
          <th scope="col">Stock</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($fila=$misarticulos->fetch(PDO::FETCH_OBJ)) {
            echo "<tr>";
            echo "<th scope='row'>{$fila->id}</th>";
            echo "<td>{$fila->nombre}</td>";
            echo "<td>{$fila->pvp}</td>";
            echo "<td>{$fila->stock}</td>";
            echo "<td>";
            echo "<a href='editarArticulo.php?id={$fila->id}' class='btn btn-warning'>Editar</a>&nbsp;\n";
            echo "<a href='borrarArticulo.php?id={$fila->id}' class='btn btn-danger'>Eliminar</a>&nbsp;\n";
            echo "</td>\n";
            echo "</tr>\n";
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>