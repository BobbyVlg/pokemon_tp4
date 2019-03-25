<?php

class Pokemon{

    private $id;
    private $nom;
    private $type1;
    private $type2;
    private $evolution;

    /**
     * Pokemon constructor.
     * @param $id
     * @param $nom
     * @param $type
     * @param $evolution
     */
    public function __construct($id, $nom, $type1, $type2, $evolution)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->type1 = $type1;
        $this->type2 = $type2;
        $this->evolution = $evolution;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function isEvolution()
    {
        return $this->evolution;
    }

    /**
     * @param mixed $evolution
     */
    public function setEvolution($evolution)
    {
        $this->evolution = $evolution;
    }

    /**
     * @return mixed
     */
    public function getType1()
    {
        return $this->type1;
    }

    /**
     * @param mixed $type1
     */
    public function setType1($type1)
    {
        $this->type1 = $type1;
    }

    /**
     * @return mixed
     */
    public function getType2()
    {
        return $this->type2;
    }

    /**
     * @param mixed $type2
     */
    public function setType2($type2)
    {
        $this->type2 = $type2;
    }


}