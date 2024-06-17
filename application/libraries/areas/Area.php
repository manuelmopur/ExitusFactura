<?php

/**
 * Clase para representar las areas 
 * en el aula virtual
 */
class Area
{
    private $nombre;
    private $id;
    private $cursos;

    /**
     * Requerido para la instanciacion el 
     * id y el nombre de la categoria
     */
    public function __construct($id = 0, $nombre = ''){
        $this->nombre = $nombre;
        $this->id = $id;
        $this->cursos = [];
    }
}
