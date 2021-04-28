<?php
  session_start();
  require '../vendor/autoload.php';
  use Clases\Articulos;
  //Lo primero que necesito es obtener el ID del artículo
  $id = $_GET['id'];
  //Quiero que los campos me los rellene con los valores que tiene el artículo
  $esteArticulo = new Articulos();
  $esteArticulo->setId($id);
  $dbArticulo = $esteArticulo->read();

  if (isset($_POST['editar'])) {
    
    if(isset($_POST['nombre'])) {
      $nombre = $_POST['nombre'];
      if(strlen($nombre)==0) {
        $_SESSION['mensaje']="Rellena los campos";
        header("Location:{$_SERVER['PHP_SELF']}?id=$id");
        die();
      }
    }

    if(isset($_POST['pvp'])) {
      $pvp = $_POST['pvp'];
      if(strlen($pvp)==0) {
        $_SESSION['mensaje']="Rellena los campos";
        header("Location:{$_SERVER['PHP_SELF']}?id=$id");
        die();
      }
    }

    if(isset($_POST['stock'])) {
      $stock = $_POST['stock'];
      if(strlen($stock)==0) {
        $_SESSION['mensaje']="Rellena los campos";
        header("Location:{$_SERVER['PHP_SELF']}?id=$id");
        die();
      }
    }

    $esteArticulo = new Articulos();
    $esteArticulo->setId($id);
    $esteArticulo->setNombre($nombre);
    $esteArticulo->setPvp($pvp);
    $esteArticulo->setStock($stock);

    $esteArticulo->update();
    $esteArticulo = null;

    $_SESSION['mensaje']="Artículo actualizado";
    header("Location:index.php");
  } else {
?>
<!DOCTYPE html>
<html lang="es">
  <?php
    require 'resources/head.php';
    head('Editar Artículo');
  ?>
<body>
  <?php
    require 'resources/navbar.php';
  ?>
  <div class="container mt-3">
    <?php
      require 'resources/mensajes.php';
    ?>
    <h3 class="text-center">Editar artículo</h3>
  </div>
  <div class="container w-50 mt-3">
    <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=$id"; ?>" method="POST">
      <label class="mt-2">Nombre</label>
      <!-- Atención a la forma de obtener la ID en value -->
      <input type="text" class="form-control" value="<?php echo $dbArticulo->nombre ?>" name="nombre">
      <label class="mt-2">PVP</label>
      <input type="number" class="form-control" value="<?php echo $dbArticulo->pvp ?>" name="pvp">
      <label class="mt-2">Stock</label>
      <input type="number" class="form-control" value="<?php echo $dbArticulo->stock ?>" name="stock">
      <input type="submit" name="editar" class="btn btn-success mt-2 mr-2" value="Editar Artículo">
      <input type="reset" value="Limpiar" class="btn btn-warning mt-2 mr-2">
    </form>
  </div>
</body>
</html>
<?php
  }
?>