<?php
/*
 * class for work with DB
 *
 */

include_once('connection.php');

class db {

    /*
     * function init        -for connection to DB
     * function query       -for SELECT request, return result array['ok' => true/false, 'msg' => info at request, 'result' => request result]
     * function result      -for check request result, null request, empty request
     * function clearString -for 'clear' incoming variable, SQL injection
     * function login       -for login, if result ==1 set SESSION['work'] == work
     * function add_user    -for add new user
     * function edt_user    -for edit user, edit field: name, password
     * function get_user    -for get info by user
     */

    /**
     * @var connection
     */
    private $connect;

    //connection to DB
    public function init(){
		
		$this->connect = new connection();
		
		$conn = mysqli_connect($this->connect->getServer(), $this->connect->getLogin(), $this->connect->getPwd(), $this->connect->getDB());
		
		$conn->query("SET NAMES 'utf8'");
		
		return $conn;
		
	}

	//for select query, return array
	private function query($str){

	    return $this->result($this->init()->query($str));

    }

    //array with result DB, check null rows, empty request
	private function result($res){
		
		if($res){
			
			if($res->num_rows > 0){
				
				return [ 'ok' => true, 'info' => 'Select return result', 'result' => $res];
				
			}else{
				
				return [ 'ok' => false, 'info' => 'No rows', 'result' => null];
				
			}
			
		}else{
			
			return [ 'ok' => false, 'info' => 'Empty request', 'result' => null];
			
		}
		
	}

	//clear string at SQL injections
	public function clearString($str){
		
		return str_replace('>',' ', str_replace('<',' ', $this->init()->real_escape_string($str)));
		
	}

	//function on LogIn, select count row with logint/pass pair, if count == 1 action LOGIN
	public function login($array){

        return $this->query("SELECT COUNT(`id`) AS NUM, `id` FROM `users` WHERE `login` = '".$this->clearString($array['login'])."' AND `password` = '".md5($array['password'])."' AND `del` = '0';");

    }

    //function to add user
    public function add_user($array){

        //check created user
        $res = $this->query("SELECT COUNT(`id`) AS NUM FROM `users` WHERE `login` = '".$this->clearString($array['login'])."';");

        if($res['ok']){

            while($row = $res['result']->fetch_assoc()){

                if($row['NUM'] >= 1){

                    //login is busy
                    return array("result"=>-1, "msg"=>"Login is busy");

                }else{
                    //add login

                    //  `id` int(11) NOT NULL,
                    //  `email` varchar(255) NOT NULL,
                    //  `login` text NOT NULL,
                    //  `password` text NOT NULL,
                    //  `name` text NOT NULL,
                    //  `del` tinyint(1) NOT NULL DEFAULT '0'

                    $this->init()->query("INSERT INTO `users` (`email`, `login`, `password`, `name`) VALUES ('".$this->clearString($array['email'])."','".$this->clearString($array['login'])."','".md5($array['password'])."','".$this->clearString($array['name'])."');");

                    //all is ok, user add
                    return array("result"=>0, "msg"=>"User added");

                }

            }

        }else{

            //wrong on DB
            return array("result"=>-2, "msg"=>"DB Error");

        }

    }

    //edit user
    public function edt_user($array){

        $this->init()->query("UPDATE `users` SET `name` = '".$this->clearString($array['name'])."', `password` = '".md5($array['password'])."' WHERE `id` = '".$this->clearString($_SESSION['user_id'])."' AND `del` = '0';");
        return array("result"=>true, "msg"=>"User edit");

    }

    //get info at user by user_id
    public function get_user(){

        if(isset($_SESSION['user_id'])){

            return $this->query("SELECT * FROM `users` WHERE `del` = '0' AND `id` = '".$this->clearString($_SESSION['user_id'])."' LIMIT 1;");

        }else{

            return false;

        }

    }
		
}
?>