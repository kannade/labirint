<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Тестовое задание Labirint</title>
</head>
<body>

<?php
/**
* Тестовое задание Лабиринт
*
* @author Николай <nickcode@mail.ru>
* @version 1.0
*/

/**
  * Базовый класс
  */
class Books
{
	
	/** @var string Название книги */
    private $name;
	
	/** @var string Имя автора книги */
    private $author_name;
	
	/** @var string Фамилия автора книги */
    private $author_second_name;
	
	/** @var string Переводчик книги */
    private $interpreter;
	
	/** @var string Категория книги */
    private $categories;
	
	/** @var integer Год издания книги */
    private $year;
	
	/** @var float Цена книги */
    private $price;
	
	/** @var integer Скидка на книгу */
    protected $discount = 0;
	
	/** @var string Номер магазина */
    private $shop = 123;
    
    public function __construct($name, $author_name, $author_second_name, $interpreter, $categories, $year, $price, $shop)
    {
        $this->name = $name;
        $this->author_name = $author_name;
        $this->author_second_name = $author_second_name;
        $this->interpreter = $interpreter;
        $this->categories = $categories;
        $this->year = $year;
        $this->price = $price;
    }
  
	/**
      * Вызывается при обращении к неопределенному свойств
      * @param string $property Название метода
	  * @throws Exception если указанное свойство не существует
      * @return void
      */  
    public function __get($property)
    {
        $method = "get{$property}";
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            throw new Exception('<b style="color:red;">Свойство не существует</b><br>');
        }
    }
 
	/**
      * Вызывается при обращении к неопределенному методу
      * @return string
      */ 
    public function __call($n, $ar)
    {
        echo "вы вызвали несуществующий метод ".$n;
    }
    
    public static function __callStatic($n, $ar)
    {
        echo "вы вызвали статический несуществующий метод ".$n;
    }
   
	/**
      * Вызывается, когда неопределенному свойству присваивается значение
      * @param string $property Название метода
	  * @param string $value Передоваемое в метод значение
      * @return void
      */   
    public function __set($property, $value)
    {
        $method = "set{$property}";
        if (method_exists($this, $method)) {
            return $this->$method($value);
        }
    }

	/**
      * Вызывается, когда функция isset() вызывается для неопределенного свойства
      * @param string $property Название метода
      * @return void
      */
    public function __isset($property)
    {
        $method = "get{$property}";
        return (method_exists($this, $method));
    }

    /**
      * Установка значения
      * @param string $prop Наименование свойства
      * @param string $newval Значение для установки  в {@link $newval}
      * @return void
      */
    public function setProperty($prop, $newval)
    {
        $this->$prop = $newval;
    }

	/**
      * Получение значения с {@link $prop}
      * @return string
      */
    public function getProperty($prop)
    {
        return $this->$prop;
    }

	/**
      * Установка имени и фамилии автора
      * @param string $name Имя Автора
      * @param string $sname Фамилия Автора
      * @return void
      */
    public function setName($name, $sname)
    {
        $this->author_name = $name;
        $this->author_second_name = $sname;
    }

	/**
      * Получение имени и фамилии автора
      * @return string
      */    
    public function getAutor()
    {
        return $this->author_name." ".$this->author_second_name;
    }
	
	/**
      * Установка цены товара
      * @param float $a Цена товара
      * @return void
      */    
    public function setPrice($a)
    {
        $this->price = $a;
    }
	
	/**
      * Получение цены
      * @return float
      */    
    public function getPrice()
    {
        return $this->price;
    }

	/**
      * Получение и формирование строки
      * @return string
      */     
    public function getLine()
    {
        $line = $this->getProperty("name")." (".$this->getAutor().") / ";
        return $line;
    }
	
	/**
      * Установка скидки
      * @param integer $procent Скидка в процентах
      * @return void
      */     
    public function setDiscount($procent)
    {
        $this->discount = $procent;
    }

	/**
      * Получение скидки
      * @return integer
      */     
    public function getDiscount()
    {
        return $this->discount;
    }

	/**
      * Получение номера магазина
      * @return integer
      */     
    public function getShop()
    {
        return $this->shop;
    }
	
	/**
      * Установка номера магазина
      * @param integer $shp Номер магазина
	  * @throws Exception если пытаемся изменить read only свойство
      * @return void
      */     
    public function setShop($shp)
    {
        throw new Exception('Только для чтения<br />');
    }
}

/**
  * Дочерний класс для работы с аудио книгами
  */
class AudioBooks extends Books
{
	/** @var integer Длина аудио книги в минутах */
    private $time_length;
    
    public function __construct($name, $author_name, $author_second_name, $interpreter, $categories, $year, $price, $shop, $time_length)
    {
        parent::__construct($name, $author_name, $author_second_name, $interpreter, $categories, $year, $price, $shop);
        $this->time_length = $time_length;
    }
  
  	/**
      * Получение длины книги
      * @return integer
      */
    public function getTimeline()
    {
        return $this->time_length;
    }
    
	/**
      * Получение и формирование строки
      * @return string
      */
    public function getLine()
    {
        $line = parent::getLine().$this->getTimeline()." минут";
        return $line;
    }
}

/**
  * Дочерний класс для работы с бумажными книгами
  */
class PaperBooks extends Books
{
	/** @var integer Размер бумажной книги в количестве страниц */
    private $pages;
     
    public function __construct($name, $author_name, $author_second_name, $interpreter, $categories, $year, $price, $shop, $pages)
    {
        parent::__construct($name, $author_name, $author_second_name, $interpreter, $categories, $year, $price, $shop);
        $this->pages = $pages;
    }
  
    /**
      * Получение размера книги
      * @return integer
      */
    public function getPages()
    {
        return $this->pages;
    }
    
    /**
      * Получение и формирование строки
      * @return string
      */
    public function getLine()
    {
        $line = parent::getLine().$this->getPages()." страниц";
        return $line;
    }
}

/**
  * Класс для вывода информацию о любом количестве объектов типа Books одновременно
  */
class BookWriter
{
    private $knigi = array();
    
    public function addBook(Books $addb)
    {
        $this->knigi[] = $addb;
    }
    
    public function writeBook()
    {
        $string = "";
        foreach ($this->knigi as $abc) {
            $string .= $abc->getLine()." / Цена - ".$abc->getPrice()." рублей";
            $string .=" / Магазин №".$abc->getShop()." <br />";
        }
        echo $string;
    }
}

$kniga1 = new PaperBooks("Маленький принц", "Антуан де", "Сент-Экзюпери", "Нора Галь", "Дети", 2009, 365, 777, 104);
$kniga2 = new PaperBooks("Король Воров", "Корнелия", "Функе", "Михаил Рудницкий", "Дети", 2006, 367, 777, 480);
$kniga3 = new AudioBooks("Гарри Поттер и Философский камень", "Джоан", "Роулинг", "Марии Спивак", "Фантастика", 2006, 50, 777, 676);

echo"<h3>Пробуем изменить номер магазина:</h3><br />";
try {
    $kniga1->Shop=999;
    $kniga2->Shop=999;
    $kniga3->Shop=999;
} catch (Exception $e) {
    echo "Ошибка: {$e->getMessage()}";
}

echo"<br /><hr /><br /><h3>Пример __get:</h3><br />";
try {
    echo $kniga1->Line."<br />";
    echo $kniga2->Line."<br />";
    echo $kniga3->Line."<br />";
} catch (Exception $e) {
    echo "Ошибка: {$e->getMessage()}";
}

echo"<br /><hr /><br /><h3>Вывод (номер магазина private):</h3><br />";
$write = new BookWriter();
$write->addBook($kniga1);
$write->addBook($kniga2);
$write->addBook($kniga3);
$write->writeBook();

echo"<br /><hr /><br /><h3>Пример __set, __get, __isset:</h3><br />";
try {
    $kniga1->Price=100;
    $kniga2->Price=200;
    $kniga3->Price=300;
    if (isset($kniga1->Price) && isset($kniga2->Price) && isset($kniga3->Price)) {
        echo $kniga1->Price."<br />";
        echo $kniga2->Price."<br />";
        echo $kniga3->Price."<br />";
    }
} catch (Exception $e) {
    echo "Ошибка: {$e->getMessage()}";
}

echo"<br /><hr /><br /><h3>Попытка получить значение несуществующего свойства:</h3><br />";
try {
    echo $kniga3->Price22."<br />";
} catch (Exception $e) {
    echo "Ошибка: {$e->getMessage()}";
}

?>
</body>
</html>