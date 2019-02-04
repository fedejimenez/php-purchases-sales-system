<?php  
  
session_start();

class Connect{

  protected $dbh;

  protected function connection(){
    try {
      // $connect = $this->dbh = new PDO("mysql:local=localhost;dbname=dbphpsystem", "root", "root");
      //Get Heroku ClearDB connection information
      // $dbstr = getenv('CLEARDB_DATABASE_URL');
      // $dbstr = substr("$dbstr", 8);
      // $dbstrarruser = explode(":", $dbstr);
      // $dbstrarrhost = explode("@", $dbstrarruser[1]);
      // $dbstrarrrecon = explode("?", $dbstrarrhost[1]);
      // $dbstrarrport = explode("/", $dbstrarrrecon[0]);
      // $dbpassword = $dbstrarrhost[0];
      // $dbhost = $dbstrarrport[0];
      // $dbport = $dbstrarrport[0];
      // $dbuser = $dbstrarruser[0];
      // $dbname = $dbstrarrport[1];
      // unset($dbstrarrrecon);
      // unset($dbstrarrport);
      // unset($dbstrarruser);
      // unset($dbstrarrhost);
      // unset($dbstr);
      //Uncomment this for debug reasons
      // echo $dbname . " - name<br>";
      // echo $dbhost . " - host<br>";
      // echo $dbport . " - port<br>";
      // echo $dbuser . " - user<br>";
      // echo $dbpassword . " - passwd<br>";
      
      // $dbanfang = 'mysql:host=' . $dbhost . ';dbname=' . $dbname;
      // $connect = $this->dbh = new PDO($dbanfang, $dbuser, $dbpassword);

      
      $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
      $server = $url["host"];
      $username = $url["user"];
      $password = $url["pass"];
      $db = substr($url["path"], 1);

      $dbstart = 'mysql:host=' . $server . ';dbname=' . $db;
      $connect = $this->dbh = new PDO($dbstart, $username, $password);
      return $connect;
    
    } catch (Exception $e) {
      print "Error! " . $e->getMessage() . "<br/>";  
      die();
    }
  } // close function connection

  public static function transform_dates($string){
    $string = str_replace(
      array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'),
      array('JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', ' DECEMBER'),
     $string
    );        
    return $string;
  }

  public function set_names(){
    return $this->dbh->query("SET NAMES 'utf8'");
  }

  public function route(){
    return "https://purchases-sales-system.herokuapp.com/";
  }


}
?>