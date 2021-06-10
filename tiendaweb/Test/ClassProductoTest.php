<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 */

require 'vendor/autoload.php';
require 'ClassCliente.php';

class ClienteTest extends \PHPUnit\Framework\TestCase{
    
    
    public function testDarAlta(){

        $servername = "localhost";
        $username = "php";
        $password = "1234";
        $dbname = "pruebas";

        // Establecer conexión con la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
          die("Error de conexión: " . $conn->connect_error);
        }


        
        //Primera tanda
        //Primero calculo cuantas lineas hay en la tabla
        $sqlPrueba = "select * from Productos;";
        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $productosAntes = $resultado->num_rows;
          


        $productoNuevo = new Producto("prueba","prueba","prueba","prueba");

        $productoNuevo->darAlta($conn);

        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $productosDespues = $resultado->num_rows;

        

        $this->assertEquals($productosAntes+1,$productosDespues,"El producto se ha insertado correctamente");

        //Segunda tanda
        $sqlPrueba = "select * from Productos where cod like 'prueba';";
        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $numeroFilas = $resultado->num_rows;

        $this->assertEquals(1,$numeroFilas,"El producto se ha insertado correctamente, 2a prueba, y no se repiten filas");

        //Eliminamos los datos de prueba
        $sqlReset = "delete from Productos where cod like 'prueba';";
        $resultado = $conn->query($sqlPrueba);

        $conn->close();

        
    }
    
    
  
}
