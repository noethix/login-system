<?php

//Declare employees
class employe {
    public $nom;
    public $prenom;
    public $dateEmb;
    public $poste;
    public $salaire;
    public $service;
    public $agence=array();
    public $enfant=array();
    public $hols;
    public $yearsEmpl;
    public $bonus;
    
//Initiate employees   
public function __construct($nom, $prenom, $dateEmb, $poste, $salaire, $service, $agence, $enfant) {
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->dateEmb = $dateEmb;
    $this->poste = $poste;
    $this->salaire = $salaire;
    $this->service = $service;
    $this->agence = $agence;
    $this->enfant = $enfant;
    $this->hols=$this->check();
    $this->yearsEmpl=$this->emploi();
    $this->bonus=$this->prime();
}

//Calculates how long a person has been employed
public function emploi() {
    $dateEmb = str_replace("/", "-", $this->dateEmb);
    $today = date("d-m-Y");
    $cal =  strtotime($today) - strtotime($dateEmb);
    $duree = intval($cal/(60*60*24*365.25));
    return $duree;
}

//Calculates the yearly bonus based on salary and years worked
public function prime() {
    $primeA= (5*$this->salaire)/100;
    $primeB= ((2*$this->salaire)/100)*$this->emploi();
    $primeT= $primeA + $primeB;
    return $primeT;
}

//To let you know you've got bonus on the day specified 
public function bonusDay() {
    $current_date = date("d-m");
    if ($current_date == "30-11") {
        print "Bingo, you've got bonus!";
        print "<br>";
    }
}

//To let you know you are entitled a holdiday check or not
public function check() {
    if ($this->emploi() > 1) {
        return "Holiday check!";
    }
    else {
        return "No Check";
    } 
}

//lets you know if you're entitled a xmas bonus
public function xmas() {
    $nbChild =count ($this->enfant);
    if ($nbChild !== 0) {
        return "Xmas check for ya!";
    } else {
        return "you haven't been producing offsprings, no Xmas check for ya! Sorry.";
    }
} 

//Sorting function
static function cmp_service($a,$b) {
    $a1 = strtolower($a->service);
    $b1 = strtolower($b->service);
    $c1 = strtolower($a->nom);
    $d1 = strtolower($b->nom);
    $e1 = strtolower($a->prenom);
    $f1 = strtolower($a->prenom);
    if ($a1 == $b1) {

        if ($c1 == $d1) {

            if ($e1 == $f1) {
                    return 0;
            }
            return ($e1 > $f1) ? +1 : -1; 
        } 
        return ($c1 > $d1) ? +1 : -1; 

        } 
        return ($a1 > $b1) ? +1 : -1;  
    }
}



//Directors inheriting employees variables
class directeur extends employe {
    //Calculates the yearly bonus based on salary and years worked
    public function prime() {
        $primeA= (7*$this->salaire)/100;
        $primeB= ((3*$this->salaire)/100)*$this->emploi();
        $primeT= $primeA + $primeB;
        return $primeT;
    }
}


class agence {
    public $nomAgence;
    public $address;
    public $codePostal;
    public $ville;
    public $resto;
    
    public function __construct($nomAgence, $address, $codePostal, $ville, $resto) {
        $this->nomAgence=$nomAgence;
        $this->address=$address;
        $this->codePostal=$codePostal;
        $this->ville=$ville;
        $this->resto=$resto;
    }
    
    public function toString() {
        return "Agence : ".$this->nomAgence." . Address : ".$this->address;
    }
}


class enfant {
    public $prenomEnf;
    public $dob;
    public $age;
    public $xmasB;
    
    public function __construct($prenomEnf, $dob) {
        $this->prenomEnf=$prenomEnf;
        $this->dob=$dob;
        $this->age=$this->age();
        $this->xmasB=$this->xmasBonus();
        }
    
   /* public function age() {
        $dob = str_replace("/", "-", $this->dob);
        $today = date("d-m-Y");
        $cal =  strtotime($today) - strtotime($dob);
        $age= intval($cal/(60*60*24*365.25));
        return $age;
    }*/

    public function age(){
        $today = new DateTime();
          $dob = str_replace("/","-",$this->dob);
          $age = new DateTime($dob);
    
          return $age->diff($today)->format("%Y");
      }

    public function toString2() {
        return $this->prenomEnf."  ". $this->age." years old ";
    }

//Lets you know how much extra xmas checks you'll get per child 
    public function xmasBonus() {
           if ($this->age <=10) {
        return "20$";
    } elseif ($this->age >10 && $this->age <=15) {
        return "30$";
    }elseif ($this->age >=16 && $this->age <=18) {
        return "50$";
    } 
    }
}

//Entering the information fot the Agencies
$agence1 = new agence("Librairie de Paris", "20 rue du Foubourg du temple", 75001, "Paris",true);
$agence2 = new agence("Mediatheque", "3 avenue de la Republique", 91230, "Montgeron",false);
$agence3 = new agence("Homerton Library", "458 Homerton high street", "E9 0BN", "London",false);
$agence4 = new agence("LA Public Library", "5423 Melrose Avenue",  90006, "Los Angeles",true);
$agence5 = new agence("Librairie solidaire", "3 rue du petit pois", 13200 , "Arles",true);

//Array to hold all the info of the agencies
$agences[]=$agence1;
$agences[]=$agence2;
$agences[]=$agence3;
$agences[]=$agence4;
$agences[]=$agence5;


$enfant1 = new enfant("Bubble", "11/12/2005");
$enfant2 = new enfant("Gum", "25/02/2017");
$enfant3 = new enfant("Lilly", "16/05/2002");
$enfant4 = new enfant("Grishka", "17/09/2010");
$enfant5 = new enfant("Igor", "05/01/2013");

$enfant[]= $enfant1;
$enfant[]= $enfant2;
$enfant[]= $enfant3;
$enfant[]= $enfant4;
$enfant[]= $enfant5;


//iniating the array $enfants at the same time a s the $employees, and adding the array enfants straight into the array of each employee

$employe1 = new employe("Slapya", "Ama", "20/04/2018", "Head Librarian", 54000, "Library", $agence1, []);
$employe2 = new employe("Nerve", "Lotta", "05/12/2002", "Indexer", 15000, "Library Office", $agence2, [$enfant2,$enfant3]);
$employe3 = new employe("Gooh", "Brancha", "18/02/2015", "Librarian", 26000, "Library", $agence3, []);
$employe4 = new employe("Boxx", "Litta", "01/01/2011", "General Librarian", 19000, "Library", $agence4, [$enfant4]);
$employe5 = new employe("Comfamee", "Donut", "06/05/2007", "Oder manager", 35000, "Library Office", $agence5, [$enfant5]);
$directeur1 = new directeur("Needles", "Sharon", "20/04/2018", "Big Boss", 54000, "Library", $agence1, [$enfant1]);
$directeur2 = new directeur("Luzon", "Manilla", "05/12/2002", "Head Boss", 15000, "Library Office", $agence2, []);
$directeur3 = new directeur("Royale", "Latrice", "18/02/2015", "Boss in charge", 26000, "Library", $agence3, [$enfant5]);


//to hold the info for the employees and directors
$employees=array();
$employees[]=$employe1;
$employees[]=$employe2;
$employees[]=$employe3;
$employees[]=$employe4;
$employees[]=$employe5;
$employees[]=$directeur1;
$employees[]=$directeur2;
$employees[]=$directeur3;

$totEmpl = count($employees);



/*
//Calculates how much the complany spends on the salaries and all the bonuses
$masse=0;
foreach ($employees as $employe) {
    $masse += $employe->salaire + $employe->prime();
}

//How many employees are in the company



usort($employees, array("employe", "cmp_service"));
foreach ($employees as $item) {
    echo  $item->nom . ", " . $item->prenom. ", " .$item->service ."<br>";
}
print "<br>";

foreach($employees as $employe) {
    print $employe->prenom." ".$employe->nom;
    print "<br>";
    print "You started on: ".$employe->dateEmb;
    print "<br>";
    print "position : ".$employe->poste;
    print "<br>";
    print "Salary : ".$employe->salaire. "$";
    print "<br>";
    print "Bonus: ". $employe->prime(). "$";
    print "<br>";
    print $employe->agence->toString();
    print "<br>";
    //print $employe1->bonusDay();
   // print "<br>";
    print $employe->check();
    print "<br>";
    print "You've been here ".$employe->emploi(). " year(s)";
    print "<br>";
    print count($employe->enfant)." child(ren)";
    print "<br>";
        foreach($employe->enfant as $enf) {
            print $enf->toString2();
            print "Xmas bonus : ".$enf->xmasBonus();
            print "<br>";
        }
    print $employe->xmas();
    print "<br>";
    print "<br>";
}

print "total employees: ".$totEmpl;
print "<br>";
print "<br>";
print "total masse salariale: ". $masse;
print "<br>";
print "<br>";
*/

//print json_encode($employees);
?>