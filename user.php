<?php 
include_once 'user.php';
    include_once 'dbconnect.php';   
class User {  
      //properties      
               
         
         protected $firstName ;
           protected $lastName ;  
           protected $clientEmail;  
           protected $City     ;
           protected $profPic   ;  
           protected $password   ; 
                 //class constructor  
         function __construct($clientEmail, $password){   
            $this->clientEmail =$clientEmail;   
            $this->password = $password;     
                                 }      
                                   //full name setter 
         public function setFirstName ($fname){ 
           	$this->firstName = $fname;  
          	      }       
          public function setLastName ($lname){ 
           	$this->lastName = $lname;  
          	      }  
          	      public function setClientEmail ($cemail){ 
           	$this->clientEmail = $cemail;  
          	      }  
          	      public function setCity ($city){ 
           	$this->City = $city;  
          	      }  
          	      public function setProfPic ($profpic){ 
           	$this->profPic = $profpic;  
          	      }  
          	      public function setPassword ($pass){ 
           	$this->password = $pass;  
          	      }      	          
            public function getClientEmail (){  
               return $this->clientEmail;
        	      } 
        	 public function getPassword (){  
               return $this->password;
        	      }      
  /**    
      * Create a new user       
       * @param Object PDO Database connection handle        * 
  @return String success or failure message        */       
         public function register ($pdo){    
            $passwordHash = password_hash($this->password,PASSWORD_DEFAULT);  
            try {            
                    $stmt = $pdo->prepare ('INSERT INTO user (firstName,lastName,email,city,profilePicture,userPassword) VALUES(?,?,?,?,?,?)');      
                    $stmt->execute([$this->firstName,$this->lastName,$this->clientEmail,$this->City,$this->profPic,$passwordHash]); 
                 
                    $url = "signin.html";
                           header("Location: $url");  
                } catch (PDOException $e) { 
                	return $e->getMessage(); 
                                       	           }                  
                                       	             }    
 /**        * Check if a user entered a correct username and password  
   * @param Object PDO Database connection handle        
   * @return String success or failure message        */       
         public function login ($pdo){         
            try { 
                                       	                          
                    $stmt = $pdo->prepare("SELECT userPassword FROM user WHERE email=?");    
                    $stmt->execute([$this->clientEmail]);   
                    $row = $stmt->fetch();   
                                    
                    if (password_verify($this->password,$row['userPassword'])){
                      	   $url = "homepage.html";
                           header("Location: $url");  
          	          } 
          	          else{           
          	        echo "<script language='javascript'>
                    alert('⚠Wrong Password. Try Again');
                    window.location.href = 'signin.html'; 
                    </script>";  
            }
          	    } catch (PDOException $e) { 
          	        return $e->getMessage();    
              	     }   
          }  
}
?>
