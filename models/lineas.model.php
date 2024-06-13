<?php
require_once "./models/conection.php";
class LineasModel
{
    public static function index()
    {
        try {
            /** Realizar la consulta a la base de datos */
            $datos = Conexion::connect()->prepare("SELECT * FROM lineas");

            /**Ejecutar la consulta */
            $datos->execute();

            /** Devuelve los datos consultados */
            return $datos->fetchAll();

            /**Cerrar conexion a la bd */


        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }
    public static function create($data)
    {
        //-- Validar que no exista un registro con el mismo codifo

        $exist = Conexion::connect()->prepare("SELECT  Nombre_linea from lineas where Nombre_linea = :code");

        // 2- Asignar parametros
        $exist->bindParam(":code", $data["Nombre_linea"], PDO::PARAM_STR);

        //3 ejecutar la consulta
        //$exist->execute()->fetchAll();

        /**Ejecutar la consulta */
        if ($exist->execute()) {
            $exist->fetchAll();

            if ($exist->rowCount() > 0) {
                // hay registros ya existe
                /** Enviar mensaje de creación correcta */
                return "La linea que esta creando ya existe";
            } else {
                // 1 - Crear la consulta para inserción en la tabla
                $create = Conexion::connect()->prepare("INSERT INTO lineas (Nombre_linea, estado)
                VALUES( :Nombre_linea, :estado)");


                /**Asignar parametros*/


                $create->bindParam(":Nombre_linea", $data["Nombre_linea"], PDO::PARAM_STR);
                $create->bindParam(":estado", $data["estado"], PDO::PARAM_STR);

                /**Ejecutar la consulta */
                if ($create->execute()) {
                    return "Ok";
                } else {
                    return "Error Modelo";
                }
                /**Cerrar conexion a la bd */
            }
        }
    }
}