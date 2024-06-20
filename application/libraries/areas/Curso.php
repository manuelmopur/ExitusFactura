<?php

/**
 * Class para representar los cursos
 * en el aula virtual
 */
class Curso
{
    /**
     * @var int
     * @access private
     * Identificador del curso
     */
    private $id;

    /**
     * @var string
     * @access private
     * Nombre del curso
     */
    private $nombre;

    /**
     * @var string
     * @access private
     * Nombre corto identificador del curso
     */
    private $nombreCorto;

    /**
     * @var int
     * @access private
     * Identificador de la categoria del curso
     */
    private $idCategoria;

    public function __construct($id = 0, $nombre){
        $this->id = $id;
        $this->nombre = $nombre;
    }

    /**
     * @return int
     */
    public function getIdCategoria(){
        return $this->idCategoria;
    }

    /**
     * @param int $idCategoria
     */
    public function setIdCategoria($idCategoria){
        $this->idCategoria = $idCategoria;
    }

    /**
     * @return string
     */
    public function getNombreCorto(){
        return $this->nombreCorto;
    }

    /**
     * @param string $nombreCorto
     */
    public function setNombreCorto($nombreCorto){
        $this->nombreCorto = $nombreCorto;
    }

    /**
     * @return string
     */
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    /**
     * @return int
     */
    public function getId(){
        return $this->id;
    }    

    /**
     * @param int $id
     */
    public function setId($id){
        $this->id = $id;
    }
}
