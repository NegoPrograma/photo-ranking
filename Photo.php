<?php

class Photo{
    
    
    /**
     * @var Photo $lesserPhoto Contém um ponteiro para uma foto pior que essa.
     * @var bool $isCompared Diz se a foto atual já foi comparada com alguma outra.
     * @var string $photoName Contém o nome do arquivo da foto.
     * @var Photo $upperPhoto Contém o ponteiro para a foto diretamente superior que esta.
     */
    public $upperPhoto = null, $lesserPhoto = null, $isCompared, $photoName,$photoPath, $points;
    public $wonAgainst = array();
    
} 

?>