<?php

class Imagen {
    public function get($param) {
        // Construye la ruta completa de la imagen
        $rutaImagen = __DIR__ . '/photos/' . $param;
    
        // Verifica si el archivo existe
        if (file_exists($rutaImagen)) {
            // Obtiene la información de la ruta del archivo, incluida la extensión
            $info = pathinfo($rutaImagen);
    
            // Establece las cabeceras para indicar que se trata de una imagen
            header('Content-Type: image/' . $info['extension']);
    
            // Lee el contenido del archivo y envíalo como respuesta
            readfile($rutaImagen);
        } else {
            // Imagen no encontrada
            $json = [
                'status' => 404,
                'result' => 'Imagen no encontrada'
            ];
            echo json_encode($json, http_response_code($json["status"]));
        }
    }
    
}