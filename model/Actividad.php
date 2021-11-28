<?php
class Actividad {
    private $titulo;
    private $tipoDeActividad;
    private $fecha;
    private $ciudad;
    private $precio;

    public function __construct($titulo, $tipoDeActividad, $fecha, $ciudad, $precio )
    {
        $this->titulo = $titulo;
        $this->tipoDeActividad = $tipoDeActividad;
        $this->fecha = $fecha;
        $this->ciudad = $ciudad;
        $this->precio = $precio;
    }


    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of tipoDeActividad
     */ 
    public function getTipoDeActividad()
    {
        return $this->tipoDeActividad;
    }

    /**
     * Set the value of tipoDeActividad
     *
     * @return  self
     */ 
    public function setTipoDeActividad($tipoDeActividad)
    {
        $this->tipoDeActividad = $tipoDeActividad;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of ciudad
     */ 
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set the value of ciudad
     *
     * @return  self
     */ 
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }
}


