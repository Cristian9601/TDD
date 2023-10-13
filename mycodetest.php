<?php
// tests/MyCodeTest.php

use PHPUnit\Framework\TestCase;

class MyCodeTest extends TestCase
{
    private $conn;

    public function setUp(): void
    {
        // Configura la conexión a la base de datos en memoria para las pruebas
        $this->conn = new mysqli('localhost', 'root', 'Cristi@n!2021', 'cotecnova1');

        if ($this->conn->connect_error) {
            $this->fail('Error de conexión a la base de datos: ' . $this->conn->connect_error);
        }
    }

    public function testCreateClient()
    {
        // Simula una solicitud POST para crear un cliente
        $_POST['action'] = 'create';
        $_POST['nombre'] = 'John';
        $_POST['apellido'] = 'Doe';
        $_POST['direccion'] = '123 Main St';

        require './procesar_formulario.php'; // Reemplaza 'tu_archivo.php' con la ruta correcta a tu código

        // Realiza afirmaciones sobre la salida o la base de datos según corresponda
        $this->assertStringContainsString('Cliente creado con éxito.', ob_get_clean());
        // También puedes realizar afirmaciones sobre la base de datos aquí si es necesario
    }

    // Agrega otros métodos de prueba para 'update' y 'delete'

    public function testReadClients()
    {
        // Simula una solicitud GET para leer clientes
        $_GET['action'] = 'read';

        ob_start();
        require './procesar_formulario.php'; // Reemplaza 'tu_archivo.php' con la ruta correcta a tu código
        $output = ob_get_clean();

        // Realiza afirmaciones sobre la salida JSON o la base de datos según corresponda
        $this->assertJson($output);
        $data = json_decode($output, true);
        $this->assertNotEmpty($data);
    }

    public function tearDown(): void
    {
        // Cierra la conexión a la base de datos al final de cada prueba
        $this->conn->close();
    }
}

