<?php 
include_once 'user.php';
    include_once 'dbconnect.php';   
class User implements Account {  
      //properties      
               
         
         protected $firstName ;
           protected $lastName ;  
           protected $clientEmail;  
           protected $City     ;
           protected $profPic   ;  
           protected $password   ; 
           protected $newpassword;
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
          	      public function setNewPassword ($newpass){ 
           	$this->newpassword = $newpass;  
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
          public function changePassword($pdo){
				    $newpasswordHash = password_hash($this->newpassword,PASSWORD_DEFAULT);
				    $passwordHash = password_hash($this->password,PASSWORD_DEFAULT); 
				    if (password_verify($this->password,$row['userPassword'])){
				          try{ 

				            $stmt = $pdo->prepare("UPDATE user SET userPassword WHERE email=?"); 
				            $stmt->execute([$newpasswordHash]);   
                            $row = $stmt->fetch();
				           
				            $url = "homepage.html";
                             header("Location: $url");
				        } catch (PDOException $e) {
				            echo $e->getMessage();
				        }
				    }else{
				        echo "fail";
				    }       
				    
				}
          public function logout ($pdo){         
              
          session_unset();
           session_destroy();
           $url = "signin.html";
            header("Location: $url")
}
?>
