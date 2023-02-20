<?php
class validCard
{
    public $userCard;
    public $cardLength;
    public $oddCardValues=[];
    public $totalSum = 0;
    //Инициализация значений с формы.
    function initialization(){
        $this->userCard = $_POST["cardNumber"];
        $this->cardLength = strlen($this->userCard);
    }
    //Функиця определения типа карты
    function regularVar(){
        $twoInitialValues = mb_strimwidth(strval($this->userCard),0,2);
        $firstDigit = mb_strimwidth(strval($this->userCard),0,1);
        $isWorld = preg_match('/2/',$firstDigit);
        $isUek = preg_match('/7/',$firstDigit);
        $isMaestro = preg_match('/50|56|57|58/',$twoInitialValues);
        $isMasterCard = preg_match('/5[1-5]|62|67/',$twoInitialValues);
        $isVisa = preg_match('/4[0-9]|14/',$twoInitialValues);
        return $isWorld?"МИР":
            ($isUek?"УЭК":
            ($isMasterCard?"MasterCard":
            ($isMaestro?"Maestro":
            ($isVisa?"VISA":
            0))));
    }
    //Основная функция.
    public function validate()
    {
        //Инициализация значений с формы.
        $this->initialization();
        //Проверка на размер карты
        if($this->cardLength!=16){
            echo "Невалидная карта!!";
        }else{
            //Добавление в массив чисел с нечетным порядковым номером и умножаем их на 2.
            for ($counter = 0; $this->cardLength > $counter; $counter++) {
                if (($counter + 1) % 2 != 0) {
                    array_push($this->oddCardValues, ($this->userCard[$counter] * 2));
                } else {
                    $this->totalSum += $this->userCard[$counter];
                }
            }
            //Складываем все нечетные числа, если число двухзначное, то считаем сумму чисел этого числа.
            for($counter=0; count($this->oddCardValues)>$counter; $counter++){
                if(strlen($this->oddCardValues[$counter])>1){
                    for ($itemSight=0; strlen($this->oddCardValues[$counter])>$itemSight; $itemSight++){
                        $this->totalSum += strval($this->oddCardValues[$counter])[$itemSight];
                    }
                }else{
                    $this->totalSum += $this->oddCardValues[$counter];
                }
            }
            //Финальная проверка по алгоритму Луна(деление на 10).
            if ($this->totalSum % 10 != 0) {
                echo '<p>Невалидная карта!!</p>';
            } else {
                //Если карта валидная, то определяем ее тип с помощью функции regularVar.
                $cardName = $this->regularVar();
                //Если карта не была определена, то пишем об этом.
                if($cardName==0){
                    echo '<p>Валидная, однако тип карты не был определен!!</p>';
                }else
                    //Если все хорошо, то выводим, что карта волидная и тип карты через точку.
                    echo "<p>Валидная карта. $cardName</p>";
            }
        }
    }
}
//Создаем объект и применяем функцию validate.
$cardObject = new validCard();
$cardObject->validate();
exit();
