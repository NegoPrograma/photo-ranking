<?php
class PhotoList {

    public $photoList=array();
    public $photo1,$photo2;

    /**
     *@method 
     * Comparação e sorting das fotos:
     * 
     * antes de fazer a comparação, é necessário ver se da pra chegar de um para o outro, pq se isso acontecer
     * é pq eles já foram comparados.
     * 
     * 
     * Se ambas as fotos tem isCompared como falso, é simples
     * a perdedora se torna lesser da vencedora e ambas ganham iscompared = true.
     * 
     * Se uma das duas for comparada e a outra estiver sozinha:
     * Se a sozinha ganhar, fácil, a perdedora se torna lesser dela.
     * 
     * Se a com conjunto ganhar:
     *  Comparamos a sozinha vs (len(vencedora)-1)/2
     *  Se a sozinha ganhar nesse caso, ela toma o lugar da len e joga a len pra baixo.
     * 
     *  Se ela perder, ela é jogada para a última posição.
     * 
     * Se ambas as fotos estiverem como compared = true:
     * 
     * A foto perdedora será comparada com a metade da vencedora, análogo ao compared x nao compared.
     */
    public function choosePhotos(){
        $this->photo1 = rand(0,count($this->photoList)-1);
        $this->photo2 = rand(0,count($this->photoList)-1);
        if($this->photo1 == $this->photo2)
            $this->choosePhotos();
    }
}
?>