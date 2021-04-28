<?php
namespace Clases;
use Clases\Conexion;
use PDO;
class Articulos extends Conexion {
  private $id;
  private $nombre;
  private $pvp;
  private $stock;
  public function __construct() {
    parent::__construct();
  }
  //-------------CRUD--------------
  public function create(){
    //Insertamos datos en artículos con parámetros+
    $i="insert into articulos(nombre, pvp, stock) values(:n, :p, :s)";
    $stmt=parent::$conexion->prepare($i);
    try {
        $stmt->execute([
          //Paso los parámetros
          ':n'=>$this->nombre,
          ':p'=>$this->pvp,
          ':s'=>$this->stock,
        ]);
    } catch (PDOException $ex) {
        die("Error al insertar un articulo: ".$ex->getMessage());
    }
  }
  //Leer
  public function read() {
    $c="select * from articulos where id=:i";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute([
          ':i'=>$this->id
        ]);
    } catch (PDOException $ex) {
        die("Error al devolver un articulo:".$ex->getMessage());
    }
    $fila=$stmt->fetch(PDO::FETCH_OBJ);
    // Hago que devuelva la fila
    return $fila;
  }
  //Actualizar
  public function update() {
    //Seteo nombre y resto de columnas
    $u="update articulos set nombre=:n, pvp=:p, stock=:s where id=:i";
    $stmt=parent::$conexion->prepare($u);
    try {
        $stmt->execute([
          ':i'=>$this->id,
          ':n'=>$this->nombre,
          ':p'=>$this->pvp,
          ':s'=>$this->stock,
        ]);
    } catch (PDOException $ex) {
        die("Error al editar articulo:".$ex->getMessage());
    }
  }
  // Borrar
  public function delete() {
    $c="delete from articulos where id=:i";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute([
          ':i'=>$this->id
        ]);
    } catch (PDOException $ex) {
        die("Error al borrar un articulo:".$ex->getMessage());
    }
  }
  // El que usaré para que se vea todo al abrir desde el índice
  public function devolverTodos() {
    $c = "select * from articulos";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute();
    } catch (PDOException $ex) {
        die("Error al devolver todos los articulos".$ex->getMessage());
    }
    return $stmt;
  }

  public function borrarTodo() {
    $c="delete from articulos";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute();
    } catch (PDOException $ex) {
        die("Error al borrar todos los articulos:".$ex->getMessage());
    }
  }

  // Método para ver si un articulo existe
  public function existeArticulo($nombre) {
    $c="select * from articulos where nombre=:n";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute([
            ':n'=>$nombre
        ]);
    } catch (PDOException $ex) {
        die("Error al comprobar existencia articulo:".$ex->getMessage());
    }
    $fila=$stmt->fetch(PDO::FETCH_OBJ);
    return ($fila==null) ? false : true;
  }
  // Getters y setters hechos a raíz de la extensión de VS Code
  /**
   * Get the value of id
   */ 
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */ 
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of nombre
   */ 
  public function getNombre()
  {
    return $this->nombre;
  }

  /**
   * Set the value of nombre
   *
   * @return  self
   */ 
  public function setNombre($nombre)
  {
    $this->nombre = $nombre;

    return $this;
  }
  
   /**
   * Get the value of pvp
   */ 
  public function getPvp()
  {
    return $this->pvp;
  }

  /**
   * Set the value of pvp
   *
   * @return  self
   */ 
  public function setPvp($pvp)
  {
    $this->pvp = $pvp;

    return $this;
  }

   /**
   * Get the value of stock
   */ 
  public function getStock()
  {
    return $this->stock;
  }

  /**
   * Set the value of stock
   *
   * @return  self
   */ 
  public function setStock($stock)
  {
    $this->stock = $stock;

    return $this;
  }
}