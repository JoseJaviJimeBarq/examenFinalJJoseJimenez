<?php

class Producto {
    //Estado
    private $cod; 
    private $descripcion;
    private $precio;
    private $stock;

    //Comportamiento

    function __construct($codigo,$descr,$prec,$st) {
        $this->cod = $codigo;
        $this->descripcion = $descr;
        $this->precio = $prec;
        $this->stock = $st;
    }

    //darse de alta
    function darAlta($conn) {
        // Consulta para realizar inserción a la base de datos

        $sql = "INSERT INTO Productos (cod,descripcion,precio,stock) VALUES ('".$this->cod."','".$this->descripcion."','".$this->precio."','".$this->stock."');";

        if ($conn->query($sql) === TRUE) {
            echo "New record producto created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


    }

    
    //Buscar un/unos cliente/s dentro de la BBDD y mostrarlo por pantalla
    function buscar($busqueda,$tipoBusqueda,$conn) {

        // Consulta para realizar la búsqueda en la base de datos
        $sql = "SELECT * FROM Productos WHERE ";
        switch ($tipoBusqueda){
        case "ocod":
          $sql = $sql."cod = $busqueda;";
        break;
        case "odes":
          $sql = $sql."descripcion like '%$busqueda%';";
        break;
        case "opre":
          $sql = $sql."precio < $busqueda;";
        break;
        case "ostock":
          $sql = $sql."stock >= $busqueda;";
        break;
        default:
          echo "Se ha producido un error durante la b&uacute;squeda.";
      }

      $resultado = $conn->query($sql);

      // Consulta para realizar la busqueda en la base de datos
      if ($resultado->num_rows > 0) {
        // Salida de datos por cada fila
        while($row = $resultado->fetch_assoc()) {
          echo "- C&oacute;digo: ".$row["cod"].", Descripci&oacute;n: ".$row["descripcion"].", Precio: ".$row["precio"].", stock: ".$row["stock"]."<br>";
        }
      }else{
        echo "No se han encontrado resultados.";
      }
    }


   }

?>
