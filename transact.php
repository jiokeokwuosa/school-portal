<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    define("DBHOST", $_SERVER['HTTP_HOST']);
    
    if (DBHOST === "localhost") {
    define("DBUSER", "christ4life");
    define("DBPASSWORD", "");
    define("DBNAME", "school1");
    } else {
        define("DBUSER", "godslov1_christ4life");
        define("DBPASSWORD", "christ4life123/");
        define("DBNAME", "godslov1_school1");
    }

                    
    session_start();
    require_once'functions.php';
    
    if(isset($_REQUEST['action'])){
       
       $action=$_REQUEST['action'];
       
        switch($action){
            
        
            case'Register':
                
                $validate=new Validator($_POST);
                $validate->validate_signup();
                
                  if($validate->getIsValid()){
                  
                   $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                   $db->connect();
                   $db->select('user_info_table',array('reg_number'=>$_POST['reg_number']));
                        if($db->numRow()>0){
                          $_SESSION['d']=true; 
                          header("location:signup.php#success");  
                        }else{                   
                            $save=$db->insert('user_info_table',$_POST);                   
                            if($save){
                                $_SESSION['a']=true;
                            } else{
                                $_SESSION['b']=true;
                                }                             
                            header("location:signup.php#success"); 
                         }         
                 }else{
                     $error=$validate->getError();
                     foreach($error as $a=>$b){
                           $my_error.=$b;
                           $my_error.="<br>";                   
                       } 
                       $_SESSION['c']=$my_error;   
                     header("location:signup.php#success");
                   } 
             
            break;
            
            
            case'Login':
            
                $validate=new Validator($_POST);
                $validate->validate_login();
                
                if($validate->getIsValid()){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $db->select('user_info_table',array('reg_number'=>$_POST['reg_number'],'password1'=>$_POST['password'],'access_level'=>$_POST['access_level'],'status'=>'true','account_status'=>'true'));
                        if($db->numRow()==1){
                          $_SESSION['login']=true;
                          $_SESSION['reg_number']=$_POST['reg_number'];
                          $_SESSION['access_level']=$_POST['access_level']; 
                          if(isset($_SESSION['page'])){
                            $page='index1.php';
                            unset($_SESSION['page']);
                          }else{
                            $page='index.php';
                            }
                          header('location:'.$page);    
                        }elseif($db->numRow()!=1){
                            $db->select('user_info_table',array('reg_number'=>$_POST['reg_number'],'password1'=>$_POST['password'],'access_level'=>$_POST['access_level'],'status'=>'false'));
                                if($db->numRow()==1){
                                   $_SESSION['a']=true;
                                   header("location:login.php#failure");  
                                }else{
                                    $_SESSION['b']=true;
                                    header("location:login.php#failure");  
                                  }
                           }
                }else{
                    $error=$validate->getError();
                     foreach($error as $a=>$b){
                           $my_error.=$b;
                           $my_error.="<br>";                   
                       } 
                       $_SESSION['c']=$my_error;   
                     header("location:login.php#failure");
                  }
            
            
            break;
            
            
            case'Send Message':
            
                $validate=new Validator($_POST);
                $validate->validate_contactus();
                
                if($validate->getIsValid()){
                       $full_name=$_POST['full_name'];
                       $reg_number=$_POST['reg_number'];
                        if(empty($reg_number)){
                            $reg_number='Not Specified';
                        }
                       $subject=$_POST['subject'];
                       $phone_number=$_POST['phone_number'];
                       $message=$_POST['message'];
                       
                       $final_message='Name: '.$full_name."<br>".'Phone Number: '.$phone_number."<br>".'Reg. Number: '.$reg_number."<br>";
                       $final_message.="<br>".$message;
                       
                        
                        //Load Composer's autoloader
                        require 'vendor/autoload.php';
                        
                        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                       
                            //Server settings
                            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'okwuosachijioke@gmail.com';                 // SMTP username
                            $mail->Password = 'jiokeokwuosa';                           // SMTP password
                            $mail->SMTPSecure = 'ssl'; 
                            $mail->SMTPOptions=array(
                            'ssl'=>array(
                            'verify_peer'=>false,
                            'verify_peer_name'=>false,
                            'allow_self_signed'=>'true'
                            )
                            );                           // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 465;                                    // TCP port to connect to
                        
                            //Recipients
                            $mail->setFrom('okwuosachijioke@gmail.com', 'GodsLove College');
                            $mail->addAddress('okwuosachijioke@gmail.com', 'Joe User');     // Add a recipient
                            //$mail->addAddress('ellen@example.com');               // Name is optional
                            //$mail->addReplyTo('info@example.com', 'Information');
                            //$mail->addCC('cc@example.com');
                            //$mail->addBCC('bcc@example.com');
                        
                            //Attachments
                            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                        
                            //Content
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = $subject;
                            $mail->Body    = $final_message;
                            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        
                            if($mail->send()){
                                $_SESSION['b']=true;
                                 header("location:contactus.php#failure");
                            }else{
                                 $_SESSION['c']=true;
                                 header("location:contactus.php#failure");
                            }
                            
                       
                       
                       
                       
                       
                       
                       
                   
                    
                }else{
                    $error=$validate->getError();
                     foreach($error as $a=>$b){
                           $my_error.=$b;
                           $my_error.="<br>";                   
                       } 
                       $_SESSION['a']=$my_error;   
                     header("location:contactus.php#failure");
                  }  
            
                       
            break;
            
            
            case 'logout':
                        
                session_destroy();
                header('location:index.php');
                
            break;
            
            
            case 'Add Session':
                        
                $validate=new Validator($_POST);
                $validate->validate_session();
                
                  if($validate->getIsValid()){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $db->select('session',array('session'=>$_POST['session']));
                    $result=$db->numRow();
                        if($result>0){
                            $_SESSION['b']=true;
                            header("location:session.php");                            
                        }else{
                            $save=$db->insert('session',$_POST);
                                if($save){
                                    $_SESSION['a']=true;
                                    header("location:session.php");
                                }else{
                                    $_SESSION['d']=true;
                                    header("location:session.php");
                                  }
                           }
                    
                    
                  }else{
                    $error=$validate->getError();
                     foreach($error as $a=>$b){
                           $my_error.=$b;
                           $my_error.="<br>";                   
                       } 
                       $_SESSION['c']=$my_error;   
                     header("location:session.php");
                   }
            
                
            break;
                
            
            case 'deleteSession':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']==4){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->delete('session',array('session_id'=>$key));
                       
                        if($result){
                            $_SESSION['e']=true;                                                     
                        }else{
                            $_SESSION['f']=true;                        
                          }
                        
                    header("location:session.php");
               }
               
            break;
            
            case 'editSession':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']==4){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->select('session',array('session_id'=>$key));
                    $numrow=$db->numRow();
                    
                    if($numrow>0){
                      $row=mysqli_fetch_assoc($result);
                      extract($row);  
                      $_SESSION['id']=$session_id;
                      $_SESSION['session']=$session;                                 
                      header('location:session.php');
                    }
               }
               
            break;    
            
            case 'Modify Session':
                        
                  $validate=new Validator($_POST);
                    $validate->validate_session();
                    
                      if($validate->getIsValid()){
                        $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                        $db->connect();
                        $db->select('session',array('session'=>$_POST['session']));
                        $result=$db->numRow();
                            if($result>0){
                                $_SESSION['b']=true;
                                header("location:session.php");                            
                            }else{
                                $save=$db->update('session',$_POST,array('session_id'=>$_POST['session_id']));
                                    if($save){
                                        $_SESSION['y']=true;
                                        header("location:session.php");
                                        unset($_SESSION['session']);
                                        unset($_SESSION['id']);
                                    }else{
                                        $_SESSION['z']=true;
                                        header("location:session.php");
                                      }
                               }
                        
                        
                      }else{
                            $error=$validate->getError();
                             foreach($error as $a=>$b){
                                   $my_error.=$b;
                                   $my_error.="<br>";                   
                               } 
                               $_SESSION['c']=$my_error;   
                             header("location:session.php");
                        }
                   
            break; 
            
            
            case 'Add Class':
                        
                $validate=new Validator($_POST);
                $validate->validate_class();
                
                  if($validate->getIsValid()){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $db->select('classes',array('name'=>$_POST['name'],'teacher'=>$_POST['teacher'],'population'=>$_POST['population']));
                    $result=$db->numRow();
                        if($result>0){
                            $_SESSION['b']=true;
                            header("location:class.php");                            
                        }else{
                            $save=$db->insert('classes',$_POST);
                                if($save){
                                    $_SESSION['a']=true;
                                    header("location:class.php");
                                }else{
                                    $_SESSION['d']=true;
                                    header("location:class.php");
                                  }
                           }
                    
                    
                  }else{
                    $error=$validate->getError();
                     foreach($error as $a=>$b){
                           $my_error.=$b;
                           $my_error.="<br>";                   
                       } 
                       $_SESSION['c']=$my_error;   
                     header("location:class.php");
                   }
            
                
            break;
            
            
            case 'deleteClass':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']>2){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->delete('classes',array('class_id'=>$key));
                                           
                        if($result){
                            $_SESSION['e']=true;                                                     
                        }else{
                            $_SESSION['f']=true;                        
                          }
                        
                    header("location:class.php");
               }
               
            break;
            
            
            case 'editClass':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']>2){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->select('classes',array('class_id'=>$key));
                    $numrow=$db->numRow();
                    
                    if($numrow>0){
                      $row=mysqli_fetch_assoc($result);
                      extract($row);
                      $_SESSION['class_id']=$class_id;  
                      $_SESSION['name']=$name;
                      $_SESSION['teacher']=$teacher;
                      $_SESSION['population']=$population;
                      header('location:class.php');
                    }
               }
               
            break; 
            
            
            case 'Modify Class':
                        
                  $validate=new Validator($_POST);
                  $validate->validate_class();
                    
                      if($validate->getIsValid()){
                        $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                        $db->connect();
                        $db->select('classes',array('name'=>$_POST['name'],'teacher'=>$_POST['teacher'],'population'=>$_POST['population']));
                        $result=$db->numRow();
                            if($result>0){
                                $_SESSION['b']=true;
                                header("location:class.php");                            
                            }else{
                                $save=$db->update('classes',$_POST,array('class_id'=>$_POST['class_id']));
                                    if($save){
                                        $_SESSION['y']=true;
                                        header("location:class.php");
                                        unset($_SESSION['class_id']);
                                        unset($_SESSION['name']);
                                        unset($_SESSION['teacher']);
                                        unset($_SESSION['population']);
                                    }else{
                                        $_SESSION['z']=true;
                                        header("location:class.php");
                                      }
                               }
                        
                        
                      }else{
                            $error=$validate->getError();
                             foreach($error as $a=>$b){
                                   $my_error.=$b;
                                   $my_error.="<br>";                   
                               } 
                               $_SESSION['c']=$my_error;   
                             header("location:class.php");
                        }
                   
            break;  
            
            
            case'Save Image':
            
                if(isset($_FILES['titleImage']['name']) and !empty($_FILES['titleImage']['name'])){
                    $validate= new Validator($_FILES);
                    $validate->validate_image();
                    $dir='D:\xampp\htdocs\school portal\image\\';
                    //$dir=base_path().'/image/';
                    
                    if($validate->getIsValid()){
                        $upload=new Upload($_FILES,$dir);
                        $upload->createImage();
                        $result=$upload->save($_SESSION['reg_number']);
                        
                            if($result){
                                $_SESSION['b']=true;
                            }else{
                                $_SESSION['c']=true;
                               }
                        header("location:uploadpix.php");  
                    }else{
                        $error=$validate->getError();
                         foreach($error as $a=>$b){
                               $my_error.=$b;
                               $my_error.="<br>";                   
                         } 
                         $_SESSION['d']=$my_error;   
                         header("location:uploadpix.php");
                     }
                    
                    
                }else{
                     $_SESSION['a']=true;
                     header("location:uploadpix.php");
                  }             
                            
                          
            break;
            
            
            case'Change Password':
            
                $validate=new Validator($_POST);
                $validate->validate_password();
                    
                      if($validate->getIsValid()){
                        $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                        $db->connect();
                        $db->select('user_info_table',array('password1'=>$_POST['old_password'],'reg_number'=>$_SESSION['reg_number']));
                        $numrow=$db->numRow();
                        if($numrow==1){
                          $status=$db->update('user_info_table',array('password1'=>$_POST['new_password']),array('reg_number'=>$_SESSION['reg_number']));
                          if($status){
                            $_SESSION['b']=true;
                          }else{
                            $_SESSION['c']=true;
                           }
                          
                        }else{
                           $_SESSION['a']=true;
                            
                        }
                      
                        header("location:changepassword.php"); 
                      }else{
                        $error=$validate->getError();
                         foreach($error as $a=>$b){
                               $my_error.=$b;
                               $my_error.="<br>";                   
                         } 
                         $_SESSION['d']=$my_error;   
                         header("location:changepassword.php");
                       }
                    
                      
            
            break;
            
            
            case'Modify':
            
                $validate=new Validator($_POST);
                $validate->validate_modify();
                
                  if($validate->getIsValid()){
                  
                   $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                   $db->connect();
                   $save=$db->update('user_info_table',$_POST,array('reg_number'=>$_POST['reg_number']));                   
                        if($save){
                            $_SESSION['e']=true;
                        } else{
                            $_SESSION['b']=true;
                            }                             
                    header("location:signup.php?key=".$_POST['reg_number']); 
                               
                 }else{
                     $error=$validate->getError();
                     foreach($error as $a=>$b){
                           $my_error.=$b;
                           $my_error.="<br>";                   
                       } 
                       $_SESSION['c']=$my_error;   
                   header("location:signup.php?key=".$_POST['reg_number']);
                   } 
                       
            
            break;
            
            
            case'Add Message':
            
                $validate=new Validator($_POST);
                    $validate->validate_notify();
                    
                      if($validate->getIsValid()){
                        $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                        $db->connect();
                        $db->select('notification',array('message'=>$_POST['message'],'sender'=>$_SESSION['reg_number']));
                        $result=$db->numRow();
                            if($result>0){
                                $_SESSION['b']=true;
                                header("location:notify.php");                            
                            }else{
                                $save=$db->insert('notification',$_POST);
                                    if($save){
                                        $_SESSION['a']=true;
                                        header("location:notify.php");
                                    }else{
                                        $_SESSION['d']=true;
                                        header("location:notify.php");
                                      }
                               }
                        
                        
                      }else{
                        $error=$validate->getError();
                         foreach($error as $a=>$b){
                               $my_error.=$b;
                               $my_error.="<br>";                   
                           } 
                           $_SESSION['c']=$my_error;   
                         header("location:notify.php");
                       }
                
                
            
            break;
            
            
            case 'deleteNotify':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']>1){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->delete('notification',array('notify_id'=>$key));
                                           
                        if($result){
                            $_SESSION['e']=true;                                                     
                        }else{
                            $_SESSION['f']=true;                        
                          }
                        
                    header("location:notify.php");
               }
               
            break;
            
            
            case 'editNotify':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']>1){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->select('notification',array('notify_id'=>$key));
                    $numrow=$db->numRow();
                    
                    if($numrow>0){
                      $row=mysqli_fetch_assoc($result);
                      extract($row);
                      $_SESSION['notify_id']=$notify_id;  
                      $_SESSION['message']=$message;
                      header('location:notify.php');
                    }
               }
               
            break; 
            
            
            case 'Modify Message':
                        
                  $validate=new Validator($_POST);
                  $validate->validate_notify();
                    
                      if($validate->getIsValid()){
                        $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                        $db->connect();
                        $db->select('notification',array('message'=>$_POST['message'],'sender'=>$_POST['sender']));
                        $result=$db->numRow();
                            if($result>0){
                                $_SESSION['b']=true;
                                header("location:notify.php");                            
                            }else{
                                $save=$db->update('notification',$_POST,array('notify_id'=>$_POST['notify_id']));
                                    if($save){
                                        $_SESSION['y']=true;                                        
                                        unset($_SESSION['notify_id']);
                                        unset($_SESSION['message']);
                                        unset($_SESSION['sender']);
                                        header("location:notify.php");
                                    }else{
                                        $_SESSION['z']=true;
                                        header("location:notify.php");
                                      }
                               }
                        
                        
                      }else{
                            $error=$validate->getError();
                             foreach($error as $a=>$b){
                                   $my_error.=$b;
                                   $my_error.="<br>";                   
                               } 
                               $_SESSION['c']=$my_error;   
                             header("location:notify.php");
                        }
                   
            break;  
            
            
            case'Submit File':
            
                 if(isset($_FILES['file']['name']) and !empty($_FILES['file']['name'])){
                    
                    $validate= new Validator($_POST);
                    $validate->validate_library();
                    $dir='D:\xampp\htdocs\school portal\books\\';
                  
                    if($validate->getIsValid()){
                        $validate= new Validator($_FILES);
                        $validate->validate_file();
                            if($validate->getIsValid()){
                                 $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                                 $db->connect();
                                 $result=$db->insert('library',$_POST);                                                                
                                    if($result){
                                       $name=$db->insert_id();
                                       $db->update('library',array('extension'=>$validate->fileExtension()),array('book_id'=>$name));                                        
                                       $upload= new Upload($_FILES,$dir); 
                                       $result=$upload->saveFile($name,$validate->fileExtension());
                                        if($result){
                                           $_SESSION['b']=true;  
                                        }
                                       
                                    }else{
                                        $_SESSION['c']=true;
                                       }
                                header("location:elibrary.php"); 
                                
                            } else{
                                    $my_error='';
                                    $error=$validate->getError();
                                     foreach($error as $a=>$b){
                                           $my_error.=$b;
                                           $my_error.="<br>";                   
                                     } 
                                     $_SESSION['d']=$my_error;   
                                     header("location:elibrary.php");
                                }
                    
                            
                            
                    }else{
                        $error=$validate->getError();
                         foreach($error as $a=>$b){
                               $my_error.=$b;
                               $my_error.="<br>";                   
                         } 
                         $_SESSION['d']=$my_error;   
                         header("location:elibrary.php");
                     }
                    
                    
                }else{
                     $_SESSION['a']=true;
                     header("location:elibrary.php");
                  }            
                
            
            break;
            
            
            case 'deleteBook':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               $ext=isset($_GET['ext'])? $_GET['ext']:'';
               $dir='D:\xampp\htdocs\school portal\books\\';
               $path=$dir.$key.$ext;
               
               
               if(is_numeric($key) and $_SESSION['access_level']>1){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->delete('library',array('book_id'=>$key));                   
                    unlink($path);
                                           
                        if($result){
                            $_SESSION['e']=true;                                                     
                        }else{
                            $_SESSION['f']=true;                        
                          }
                        
                    header("location:elibrary.php");
               }
               
            break;
            
            
            case 'editBook':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']>1){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->select('library',array('book_id'=>$key));
                    $numrow=$db->numRow();
                    
                    if($numrow>0){
                      $row=mysqli_fetch_assoc($result);
                      extract($row);
                      $_SESSION['book_id']=$book_id;  
                      $_SESSION['title']=$title;
                      $_SESSION['description']=$description;
                      $_SESSION['subject']=$subject;
                      header('location:elibrary.php');
                    }
               }
               
            break;
            
            
            case 'Modify File':
            
                  if(isset($_FILES['file']['name']) and !empty($_FILES['file']['name'])){
                    
                    $validate= new Validator($_POST);
                    $validate->validate_library();
                    $dir='D:\xampp\htdocs\school portal\books\\';
                  
                    if($validate->getIsValid()){
                        $validate= new Validator($_FILES);
                        $validate->validate_file();
                            if($validate->getIsValid()){
                                 $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                                 $db->connect();
                                 $result=$db->update('library',$_POST,array('book_id'=>$_POST['book_id']));                                                                
                                    if($result){
                                       $name=$_POST['book_id'];
                                       $db->update('library',array('extension'=>$validate->fileExtension()),array('book_id'=>$name));                                        
                                       $upload= new Upload($_FILES,$dir); 
                                       $result=$upload->saveFile($name,$validate->fileExtension());
                                        if($result){
                                          $_SESSION['b']=true;
                                          
                                          unset($_SESSION['book_id']);
                                          unset($_SESSION['title']);
                                          unset($_SESSION['description']);
                                          unset($_SESSION['subject']);                              
                                                             
                                        }
                                       
                                    }else{
                                        $_SESSION['c']=true;
                                       }
                                header("location:elibrary.php"); 
                                
                            } else{
                                    $my_error='';
                                    $error=$validate->getError();
                                     foreach($error as $a=>$b){
                                           $my_error.=$b;
                                           $my_error.="<br>";                   
                                     } 
                                     $_SESSION['d']=$my_error;   
                                    
                                }
                    
                             header("location:elibrary.php");
                            
                    }else{
                        $error=$validate->getError();
                         foreach($error as $a=>$b){
                               $my_error.=$b;
                               $my_error.="<br>";                   
                         } 
                         $_SESSION['d']=$my_error;   
                         header("location:elibrary.php");
                     }
                    
                    
                }else{
                     $_SESSION['a']=true;
                     header("location:elibrary.php");
                  }            
                
                        
                  
            break;  
            
            
            case 'Proceed':
                
                $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                $db->connect();
                $db->select('exam_subject_list', $_POST);
                 if($db->numRow()>0){
                    $_SESSION['a']=true;
                    header('location:text.php');
                 }else{                    
                   $result=$db->insert('exam_subject_list',array('class_id'=>$_POST['class_id'],'name'=>$_POST['name'],'creator_id'=>$_SESSION['reg_number']));
                        if($result){
                            
                            $_SESSION['subject']=$_POST['name'];
                            $_SESSION['subject_id']=$db->insert_id();
                           header('location:text2.php'); 
                        }else{
                             echo('not ok');   
                          }
                
                    
                    
                   }
                
               
            
            break; 
                
            
            case 'Set Question':
          
                if(strlen($_POST['questions'])>3){
                   $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                   $db->connect();
                   $result=$db->insert('exam_question',$_POST);
                    if($result){
                       $_SESSION['question_no']=$_SESSION['question_no']+1;
                            if($_SESSION['question_no']>10){
                                $_SESSION['status']=true;
                                $_SESSION['c']=true;
                                unset($_SESSION['question_no']);
                            }
                       header('location:text2.php');
                    }else{
                       $_SESSION['b']=true; 
                       }
                
                
                }else{
                      $_SESSION['a']=true;
                      header('location:text2.php');  
                  }
                  
             break;
             
             
             case 'deleteSubject':
                
                $class_id=isset($_GET['class_id'])? $_GET['class_id']:'';
                $subject_id=isset($_GET['subject_id'])? $_GET['subject_id']:'';
                
                if(!empty($class_id) and !empty($subject_id)){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->delete('exam_subject_list',array('class_id'=>$class_id,'subject_id'=>$subject_id)); 
                    $result=$db->delete('exam_question',array('subject_id'=>$subject_id));
                    
                    if($result){
                        $_SESSION['a']=true;
                    }else{
                        $_SESSION['b']=true;
                      }
                    header('location:myquiz.php');
                }else{
                    header('location:login.php');
                  }
             
             
             
             break;
             
             
             case 'Drop View':
                    
                    
                    if(strlen($_POST['article_text'])>24){
                        
                        $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                        $db->connect();
                        $result=$db->insert('articles',array('reg_number'=>$_SESSION['reg_number'],'article_text'=>$_POST['article_text']));
                        
                        if($result){
                            $_SESSION['b']=true;
                        }else{
                            $_SESSION['c']=true;
                          }
                                           
                        header('location:forum.php');
                    }else{
                        
                        $_SESSION['a']=true;
                        header('location:forum.php'); 
                      }
                                       
             
             break;
             
             
             case 'Drop Comment':
                   
                   if(strlen($_POST['comment_text'])>16){
                            
                            $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                            $db->connect();
                            $result=$db->insert('comments',array('reg_number'=>$_SESSION['reg_number'],'comment_text'=>$_POST['comment_text'],'article_id'=>$_SESSION['article_id']));
                            
                            if($result){
                                $_SESSION['b']=true;
                            }else{
                                $_SESSION['c']=true;
                              }
                                               
                            header('location:viewnews.php#status');
                   }else{
                            
                            $_SESSION['a']=true;
                            header('location:viewnews.php#status'); 
                      }
                 
             break;
             
             
           case 'approve':
           
                $key=isset($_GET['key'])? $_GET['key']:'';
               
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->update('user_info_table', array('status'=>'true'),array('reg_number'=>$key));
                    
                    if($result){
                      $_SESSION['a']=true;  
                    }else{
                      $_SESSION['b']=true;   
                    }
                    header('location:approve.php');  
                
           break; 
           
           case 'deleteAccount':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']==4){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->delete('user_info_table',array('reg_number'=>$key));
                                           
                        if($result){
                            $_SESSION['e']=true;                                                     
                        }else{
                            $_SESSION['f']=true;                        
                          }
                        
                    header("location:approve.php");
               }
               
            break; 
             
          
           case 'Add Subject':
           
                $validate=new Validator($_POST);
                $validate->validate_subject();
                
                  if($validate->getIsValid()){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $db->select('subjects',array('name'=>$_POST['name'],'class_id'=>$_POST['class_id']));
                    $result=$db->numRow();
                        if($result>0){
                            $_SESSION['b']=true;
                            header("location:subject.php");                            
                        }else{
                            $save=$db->insert('subjects',$_POST);
                                if($save){
                                    $_SESSION['a']=true;
                                    header("location:subject.php");
                                }else{
                                    $_SESSION['d']=true;
                                    header("location:subject.php");
                                  }
                           }
                    
                    
                  }else{
                    $error=$validate->getError();
                     foreach($error as $a=>$b){
                           $my_error.=$b;
                           $my_error.="<br>";                   
                       } 
                       $_SESSION['c']=$my_error;   
                     header("location:subject.php");
                   }
            
                      
           
           break; 
           
           
           case 'editSubject':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']>2){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->select('subjects',array('subject_id'=>$key));
                    $numrow=$db->numRow();
                    
                    if($numrow>0){
                      $row=mysqli_fetch_assoc($result);
                      extract($row);
                      $_SESSION['subject_id']=$subject_id;  
                      $_SESSION['name']=$name;
                      $_SESSION['short_name']=$short_name;
                      $_SESSION['class_id']=$class_id;
                      header('location:subject.php');
                    }
               }
               
           break;
           
           
           
           case 'Modify Subject':
                        
                  $validate=new Validator($_POST);
                  $validate->validate_subject();
                    
                      if($validate->getIsValid()){
                        $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                        $db->connect();
                        $db->select('subjects',array('name'=>$_POST['name'],'class_id'=>$_POST['class_id']));
                        $result=$db->numRow();
                            if($result>0){
                                $_SESSION['b']=true;
                                header("location:subject.php");                            
                            }else{
                                $save=$db->update('subjects',$_POST,array('subject_id'=>$_POST['subject_id']));
                                    if($save){
                                        $_SESSION['y']=true;
                                        header("location:subject.php");
                                        unset($_SESSION['subject_id']);
                                        unset($_SESSION['name']);
                                        unset($_SESSION['short_name']);
                                        unset($_SESSION['class_id']);
                                    }else{
                                        $_SESSION['z']=true;
                                        header("location:subject.php");
                                      }
                               }
                        
                        
                      }else{
                            $error=$validate->getError();
                             foreach($error as $a=>$b){
                                   $my_error.=$b;
                                   $my_error.="<br>";                   
                               } 
                               $_SESSION['c']=$my_error;   
                             header("location:subject.php");
                        }
                   
            break;
            
            
            case 'deleteSubject1':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']>2){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->delete('subjects',array('subject_id'=>$key));
                                           
                        if($result){
                            $_SESSION['e']=true;                                                     
                        }else{
                            $_SESSION['f']=true;                        
                          }
                        
                    header("location:subject.php");
               }
               
            break;
            
            case 'deleteResult':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']>1){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->delete('results',array('result_id'=>$key));
                                           
                        if($result){
                            $_SESSION['e']=true;                                                     
                        }else{
                            $_SESSION['f']=true;                        
                          }
                        
                    header("location:result2.php");
               }
               
            break;
            
            case 'deleteUser':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               $dest=isset($_GET['dest'])? $_GET['dest']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']>3){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->delete('user_info_table',array('user_id'=>$key));
                    $dir='D:\xampp\htdocs\school portal\image\\';
                    $path=$dir.$key.'.jpg';
                                           
                        if($result){
                            unlink($path);
                            $_SESSION['e']=true;                                                     
                        }else{
                            $_SESSION['f']=true;                        
                          }
                        
                    header("location:".$dest.".php");
               }
               
            break;
            
            
            case 'deactivateUser':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               $dest=isset($_GET['dest'])? $_GET['dest']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']>2){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->update('user_info_table',array('account_status'=>'false'),array('user_id'=>$key));
                                                                                  
                        if($result){                            
                            $_SESSION['g']=true;                                                     
                        }else{
                            $_SESSION['h']=true;                        
                          }
                        
                    header("location:".$dest.".php");
               }
               
            break;
            
            
            case 'activateUser':
                        
               $key=isset($_GET['key'])? $_GET['key']:'';
               $dest=isset($_GET['dest'])? $_GET['dest']:'';
               
               if(is_numeric($key) and $_SESSION['access_level']>2){
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->update('user_info_table',array('account_status'=>'true'),array('user_id'=>$key));
                                                                                  
                        if($result){                            
                            $_SESSION['g']=true;                                                     
                        }else{
                            $_SESSION['h']=true;                        
                          }
                        
                    header("location:".$dest.".php");
               }
               
            break;
            
            
            case 'Modify Result':  
             
                    
                    for($i=1; $i<count($_POST['member'])+1;  $i++){
                        $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                        $db->connect();
                        $db->update('results',array('assesment_score'=>$_POST['member'][$i]['assesment_score'],'exam_score'=>$_POST['member'][$i]['exam_score'],'date_modified'=>date('D M Y H i s', strtotime('now'))),array('result_id'=>$_POST['member'][$i]['result_id']));
                    }
                    header('location:result2.php');
                  
                  
            break;
            
            
             case'Submit Banner':
            
                if(isset($_FILES['titleImage']['name']) and !empty($_FILES['titleImage']['name'])){
                   
                    $validate= new Validator($_FILES);
                    $validate->validate_image();
                    $dir='D:\xampp\htdocs\school portal\images\\';
                    
                    if($validate->getIsValid()){
                        $upload=new Upload($_FILES,$dir);
                        $upload->createImage();
                        $result=$upload->saveFile('banner','.png');
                        
                            if($result){
                                $_SESSION['b']=true;
                            }else{
                                $_SESSION['c']=true;
                               }
                         header("location:structure.php");  
                    }else{
                        $error=$validate->getError();
                         foreach($error as $a=>$b){
                               $my_error.=$b;
                               $my_error.="<br>";                   
                         } 
                         $_SESSION['d']=$my_error;   
                          header("location:structure.php");
                     }
                    
                    
                }else{
                    
                     $_SESSION['a']=true;
                       header("location:structure.php");
                  }             
                            
                          
            break;
            
            case'Submit Logo':
            
                if(isset($_FILES['logo']['name']) and !empty($_FILES['logo']['name'])){
                   
                    $validate= new Validator($_FILES);
                    $validate->validate_image();
                    $dir='D:\xampp\htdocs\school portal\images\\';
                    
                    if($validate->getIsValid()){
                        $upload=new Upload($_FILES,$dir);
                        $upload->createImage();
                        $result=$upload->saveFile('logo','.png');
                        
                            if($result){
                                $_SESSION['b']=true;
                            }else{
                                $_SESSION['c']=true;
                               }
                         header("location:structure.php");  
                    }else{
                        $error=$validate->getError();
                         foreach($error as $a=>$b){
                               $my_error.=$b;
                               $my_error.="<br>";                   
                         } 
                         $_SESSION['d']=$my_error;   
                          header("location:structure.php");
                     }
                    
                    
                }else{
                    
                     $_SESSION['a']=true;
                       header("location:structure.php");
                  }             
                            
                          
            break;     
            
            
            
            case'Submit Principal':
            
                if(isset($_FILES['principal']['name']) and !empty($_FILES['principal']['name'])){
                   
                    $validate= new Validator($_FILES);
                    $validate->validate_image();
                    $dir='D:\xampp\htdocs\school portal\images\\';
                    
                    if($validate->getIsValid()){
                        $upload=new Upload($_FILES,$dir);
                        $upload->createImage();
                        $result=$upload->saveFile('principal','.png');
                        
                            if($result){
                                $_SESSION['b']=true;
                            }else{
                                $_SESSION['c']=true;
                               }
                         header("location:structure.php");  
                    }else{
                        $error=$validate->getError();
                         foreach($error as $a=>$b){
                               $my_error.=$b;
                               $my_error.="<br>";                   
                         } 
                         $_SESSION['d']=$my_error;   
                          header("location:structure.php");
                     }
                    
                    
                }else{
                    
                     $_SESSION['a']=true;
                       header("location:structure.php");
                  }             
                            
                          
            break;           
            
            
            default:           
                    header('location:index.php');
            break; 
            
            
        }
        
    }






















?>