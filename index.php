<?php 
   include_once 'user.php';
    include_once 'dbconnect.php';
     $con = new DBConnector();
     $pdo = $con->connectToDB();
     $event = $_POST['event']; 
     if($event == "register"){ 
            //register     
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
        else {   
             //login 
                     $clientEmail = $_POST['cemail'];
                     $password = $_POST['psd'];  
                     $user = new User($clientEmail, $password); 
                     $user->getClientEmail($clientEmail); 
                     $user->getPassword($password);
                                         echo $user->login($pdo);    
 } 
 ?>