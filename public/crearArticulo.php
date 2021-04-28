<?php
  session_start();
  require '../vendor/autoload.php';
  use Clases\Articulos;

  if (isset($_POST['crear'])) {

    if (isset($_POST['nombre'])) {
      $nombre = $_POST['nombre'];
      if (strlen($nombre) == 0) {
        $_SESSION['mensaje']="Rellena los campos";
        header("Location: crearArticulo.php");
        die();
      }
    }

    if (isset($_POST['pvp'])) {
      $pvp = $_POST['pvp'];
      if (strlen($pvp) == 0) {
        $_SESSION['mensaje']="Rellena los campos";
        header("Location: crearArticulo.php");
        die();
      }
    }

    if (isset($_POST['stock'])) {
      $stock = $_POST['stock'];
      if (strlen($stock) == 0) {
        $_SESSION['mensaje']="Rellena los campos";
        header("Location: crearArticulo.php");
        die();
      }
    }

    $esteArticulo = new Articulos();

    $esteArticulo->setNombre($nombre);
    $esteArticulo->setPvp($pvp);
    $esteArticulo->setStock($stock);
    if (!$esteArticulo->existeArticulo($nombre)) {
      $esteArticulo->create();
      $esteArticulo = null;
      $_SESSION['mensaje']="Artículo creado";
      header("Location:index.php");
    } else {
      $_SESSION['mensaje']="El artículo existe!!";
      $esteArticulo=null;
      header("Location: crearArticulo.php");
      die();
    }
  } else {
?>
<!DOCTYPE html>
<html lang="es">
  <?php
    require 'resources/head.php';
    head('Crear artículo');
  ?>
<body>
  <?php
    require 'resources/navbar.php';
  ?>
  <div class="container mt-3 text-center">
    <h3 class="text-center mt-3">Crear artículo</h3>
  </div>
  <div class="container mt-3">
    <?php
      require 'resources/mensajes.php';
    ?>
  </div>
  <div class="container mt-3">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <label class="mt-2">Nombre</label>
      <input type="text" class="form-control" name="nombre">
      <label class="mt-2">PVP</label>
      <input type="number" class="form-control" name="pvp">
      <label class="mt-2">Stock</label>
      <input type="number" class="form-control" name="stock">
      <input type="submit" name="crear" class="btn btn-success mt-2 mr-2" value="Crear artículo">
      <input type="reset" value="Limpiar" class="btn btn-warning mt-2 mr-2">
    </form>
  </div>
</body>
</html>
<?php
  }
?>