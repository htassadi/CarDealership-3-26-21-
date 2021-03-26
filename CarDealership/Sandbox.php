<?php

class Character {

    //Properties
    public $name;
    public $phrase1;
    public $phrase2;
    public $level;

    function __construct($charName, $charPhrase1, $charPhrase2){
        $this->name = $charName;
        $this->phrase1 = $charPhrase1;
        $this->phrase2 = $charPhrase2 ;
        $this->level = 0;
    }

    // Methods
    function speak($phraseNum) {
        if($phraseNum == 1){
            echo $this->phrase1."<br>";
        } else if ($phraseNum = 2){
            echo $this->phrase2."<br>";
        } else {
            echo "Invalid Phrase Number!"."<br>";
        }
    }

    function setLevel($newLevel) {
        $this->level += $newLevel;
    }
}

$character1 = new Character("Kung Fu Panda", "Skadoosh!", "You have been blinded by pure awesomeness!");
$character2 = new Character("Spiderman", "My Spider-Sense is tingling", "Your friendly neighbourhood spiderman");

//echo charater catch phrase 1
$character1->speak(1);

//Change level
$character2->setlevel(1);
echo "Your character ".$character2->name." has leveled up to level number ".$character2->level."<br>";

//echo charater catch phrase 2
$character2->speak(2);
?>



<?php

class Backpack {
    public $color;
    public $size;
    public $items;
    public $open;

    function __construct($inputSize, $inputColor){
        $this->color = $inputColor;
        $this->size = $inputSize;
        $this->items = [];
        $this->open = false;
    }

    //Methods
    function openBag(){
        $this->open = true;
        echo "Your backpack is open! <br>";
    }

    function closeBag(){
        $this->open = false;
        echo "Your backpack is closed! <br>";

    }

    function putin($item){
        if ($this->open == true){
            //add item
            array_push($this->items, "$item");
            echo "The item ".$item." has been added to the backpack <br>";
            
        } else{
            echo "Your backpack is closed! You CANNOT take out an item. <br>";
        }
    }

    function takeout($item){
        if ($this->open == true){
            //remove item
            for($i = count($this->items) - 1 ; $i >= 0; $i--){
                if($this->items[$i] == $item){
                    array_splice($this->items, $i, 1);
                };
            }
            
            echo "The item ".$item." has been removed from the backpack <br>";        

        } else{
            echo "Your backpack is closed! You CANNOT put in an item. <br>";
        }
    }
};

//Task 2
$backpack1 = new Backpack("small", "blue");
$backpack2 = new Backpack("medium", "red");
$backpack3 = new Backpack("large", "green");

//Task 3
$backpack1->openBag();
$backpack1->putin("Lunch");
$backpack1->putin("Jacket");
$backpack1->closeBag();

$backpack1->openBag();
$backpack1->takeout("Jacket");
$backpack1->closeBag();


?>








<?php
class CartItem {
    //Properties
    public $id;
    public $price;
    public $picture;
    public $name;
    public $quantity;

    function __construct($conn){
        $this->id = $_SESSION['cartItemsIds'][0];
        $this->price = mysqli_query($conn,"SELECT price FROM car_lineup WHERE id = $_SESSION[cartItemsIds][0]");      
        $this->picture = mysqli_query($conn,"SELECT exterior FROM car_lineup WHERE id = $_SESSION[cartItemsIds][0]");
        $this->name = mysqli_query($conn,"SELECT brand, model, year FROM car_lineup WHERE id = $_SESSION[cartItemsIds][0]");
        $this->name = 0;
    }

    function createDisplayForCart(){
        ?>
            <div class="row rounded-lg shadow m-3">
                <!-- div 1 for general information information --> 
                <div class="col-sm-8 rounded-lg p-5" style = "background-color:#014421">
                    <h2>Car: </h2>
                    <span><?php echo $picture ?></span>
                </div>

                <!-- Div 2 Small -->
                <div class="bg-secondary col-sm-4 rounded-lg" >
                    <h3>Price: </h3>
                    <button>Remove</button>
                    
                    <form>
                        <div class="form-group col-md-4">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control">
                            <option selected><?php echo $quantity ?> </option>
                            <option>2</option>
                            <option>For Quantities Higher than 2, we encorage contacting the dealership for proscessing</option>
                        </select>
                        </div>
                    </form>
                    
                </div>
             </div> 
        <?php
    }
}

$item1 = new CartItem($conn);
var_dump($item1);

?>