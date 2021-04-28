<?php
  session_start();
  if(!isset($_GET['id'])) {
    header("Location: index.php");
    die();
  }
  require '../vendor/autoload.php';
  use Clases\Articulos;
  $article=new Articulos();
  $article->setId($_GET['id']);
  $article->delete();
  $article=null;
  $_SESSION['mensaje'] = "Artículo borrado correctamente";
  header("Location:index.php");
