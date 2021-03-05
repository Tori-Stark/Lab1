<?php 
   include_once 'user.php';
    include_once 'dbconnect.php';
     $con = new DBConnector();
     $pdo = $con->connectToDB();
     $event = $_POST['event']; 

     $errors = array();      
     $data = array();      


     if($event == "register"){ 
           



            $firstName = $_POST['fname'];
            $lastName = $_POST['lname'];  
            $clientEmail = $_POST['cemail'];  
            $City = $_POST['city'];      
            $profPic = $_POST['profpic'];     
            $password = $_POST['psd'];     
            $user = new User($clientEmail, $password);   
            $user->setFirstName($firstName);  
            $user->setLastName($lastName); 
            $user->setClientEmail($clientEmail); 
            $user->setCity($City); 
            $user->setProfPic($profPic); 
            $user->setPassword($password);

            echo $user->register($pdo); 
            
            
            
        }
         else if($event == "changepassword"){ 
           
            $password = $_POST['psd'];  
            $newpassword = $_POST['psd1'];    
               
            
            $user->setNewPassword($newpassword);

            echo $user->register($pdo); 
            
            
            
        }
        else if ($event=='login'){   
             //login 
                     

                     $clientEmail = $_POST['cemail'];
                     $password = $_POST['psd'];  
                     $user = new User($clientEmail, $password); 
                     $user->getClientEmail($clientEmail); 
                     $user->getPassword($password);
                      echo $user->login($pdo);

                       
                                          
                                         
 } 
 ?>
