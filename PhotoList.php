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
        if($this->photo1 == $this->photo2 || $this->isRelated($this->photoList[$this->photo1],$this->photoList[$this->photo2]))
            $this->choosePhotos();
    }

    public function assign($winnerName,$loserName){
        $winner;
        $loser;
        foreach($this->photoList as $photo){
            if($photo->photoName == $winnerName){
                $winner = $photo;
            }
            else if($photo->photoName == $loserName){
                $loser = $photo;
            }
        }
        $winner->wonAgainst[] = $loser->photoName;


        if($winner->lesserPhoto == null && $loser->lesserPhoto == null){
            $winner->lesserPhoto = $loser;
            $loser->upperPhoto = $winner;
        }
        else if($winner->lesserPhoto != null){
            $index = 0;
            $aux = $winner->lesserPhoto;
            while($aux){
                $aux = $aux->lesserPhoto;
                $index++;
            }

            $aux = $winner->lesserPhoto;
            for($i = 0; $i != $index/2;$i++){
                $aux = $aux->lesserPhoto;
            }
            if(!in_array($loser->photoName,$aux->wonAgainst)){
                $this->compare($aux,$loser);
            }
            else{
                
            }
            
        }
        else if($loser->upperPhoto){
                $index = 0;
                $aux = $loser->upperPhoto;
                $bestOfLoserList;
                while($aux){
                    $aux = $aux->upperPhoto;
                    $bestOfLoserList = $aux;
                    $index++;
                }
                $aux = $bestOfLoserList;
                for($i = 0; $i != $index/2;$i++){
                    $aux = $aux->lesserPhoto;
                }
                if(!in_array($winner->photoName,$aux->wonAgainst)){
                    $this->compare($aux,$loser);
                }else{
                    if($winner->lesserPhoto == NULL){
                        $backup = $aux->lesserPhoto;
                        $aux->lesserPhoto = $winner;
                        $winner->upperPhoto = $aux;
                        $aux->lesserPhoto = $backup;
                    }
                    else{
                        $backup = $aux->lesserPhoto;
                    }
                }
        }

        $winner->points++;
    }

    private function compare($photo1, $photo2){
        $_SESSION['photo1'] = $photo1;
        $_SESSION['photo2'] = $photo2;
    }


    private function isRelated($photo1,$photo2){
        $lesser = $photo1->lesserPhoto;
        $upper = $photo1->upperPhoto;
        while($lesser != null || $upper != null){
            if($lesser->photoName == $photo2->photoName || $upper->photoName == $photo2->photoName)
                return true;
            else{
                if($lesser != null){
                    $lesser = $lesser->lesserPhoto;
                }
                if($upper != null){
                    $upper = $upper->upperPhoto;
                }
            }                
        }
        return false;
    }
}
?>