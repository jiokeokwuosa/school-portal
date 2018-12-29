<?php
class Validator{
    protected $is_valid=true;
    protected $error_Messages=array();
    protected $data=array();
    protected $type='';
    protected $size='';
    public $extension='';
    
    
    public function __construct(array $params){
      if(empty($params) or !is_array($params)){
        die("Invalid Data");
      } 
     $this->data=$params;  
    }    
    
    
        
    public function validate_signup(){
       if(empty($this->data['reg_number'])){
        $this->error_Messages['reg_number']='Please Enter Reg Number';        
       }
       
       if(empty($this->data['password1'])){
        $this->error_Messages['password1']='Please Enter Password';        
       }elseif(strlen($this->data['password1'])<4){
            $this->error_Messages['password1']='Password should be up to 4 characters';
         }
       
       if(empty($this->data['password2'])){
        $this->error_Messages['password2']='Please Enter Confirm Password';        
       }
       
       if(!empty($this->data['password2']) and !empty($this->data['password2']) and $this->data['password1']!=$this->data['password2']){
        $this->error_Messages['password2']='Confirm password do not match';        
       }      
       
       if(empty($this->data['first_name'])){
        $this->error_Messages['first_name']='Please Enter First Name';        
       }
       
       if(empty($this->data['last_name'])){
        $this->error_Messages['last_name']='Please Enter Last Name';        
       }
                   
       if(empty($this->data['phone_number'])){
        $this->error_Messages['phone_number']='Please Enter Phone Number';        
       }
       
       if(empty($this->data['gender'])){
        $this->error_Messages['gender']='Please Select Gender';        
       }
       
       if(empty($this->data['access_level'])){
        $this->error_Messages['access_level']='Please Select User';        
       }
                         
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    }
    
    public function validate_modify(){
         
       if(empty($this->data['first_name'])){
        $this->error_Messages['first_name']='Please Enter First Name';        
       }
       
       if(empty($this->data['last_name'])){
        $this->error_Messages['last_name']='Please Enter Last Name';        
       }
       
       if(empty($this->data['phone_number'])){
        $this->error_Messages['phone_number']='Please Enter Phone Number';        
       }
       
       if(empty($this->data['gender'])){
        $this->error_Messages['gender']='Please Select Gender';        
       }
       
                    
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    }
    
    
    public function validate_contactus(){
      
       if(empty($this->data['full_name'])){
        $this->error_Messages['full_name']='Please Enter Full Name';        
       }
       
       if(empty($this->data['subject'])){
        $this->error_Messages['subject']='Please Enter Subject';        
       }
       
       if(empty($this->data['phone_number'])){
        $this->error_Messages['phone_number']='Please Enter Phone Number';        
       }
       
       if(empty($this->data['message'])){
        $this->error_Messages['message']='Please Enter Message';        
       }            
                         
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    }
    
    
    public function validate_login(){
       if(empty($this->data['reg_number'])){
        $this->error_Messages['reg_number']='Please Enter Reg Number';        
       }
       
       if(empty($this->data['password'])){
        $this->error_Messages['password']='Please Enter Password';        
       }
       
       if(empty($this->data['access_level'])){
        $this->error_Messages['access_level']='Please Select User';        
       }
                      
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    }
    
    public function validate_session(){
       if(empty($this->data['session'])){
        $this->error_Messages['session']='Please Enter the Session';        
       }
                                        
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    }
    
    public function validate_class(){
       if(empty($this->data['name'])){
        $this->error_Messages['name']='Please Enter Class Name';        
       }
       
       if(empty($this->data['teacher'])){
        $this->error_Messages['teacher']='Please Enter Teacher\'s name';        
       }
       
       if(empty($this->data['population'])){
        $this->error_Messages['population']='Please Enter number of Students';        
       }
                           
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    } 
    
    public function validate_subject(){
       if(empty($this->data['name'])){
        $this->error_Messages['name']='Please Enter Subject Name';        
       }
       
       if(empty($this->data['short_name'])){
        $this->error_Messages['short_name']='Please Enter the Short Name';        
       }
       
       if(empty($this->data['class_id'])){
        $this->error_Messages['class_id']='Please Select Class';        
       }
                           
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    } 
    
    public function validate_result(){
       if(empty($this->data['session_id'])){
        $this->error_Messages['session_id']='Please Select the Session';        
       }
       
       if(empty($this->data['term_id'])){
        $this->error_Messages['term_id']='Please Select the Term';        
       }
              
       if(empty($this->data['subject_id'])){
        $this->error_Messages['subject_id']='Please Select Subject';        
       }
                           
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    } 
    
    public function validate_result2(){
       if(empty($this->data['session_id'])){
        $this->error_Messages['session_id']='Please Select the Session';        
       }
       
       if(empty($this->data['term_id'])){
        $this->error_Messages['term_id']='Please Select the Term';        
       }
                       
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    } 
    
    public function validate_result3(){
       if(empty($this->data['session_id'])){
        $this->error_Messages['session_id']='Please Select the Session';        
       }
       
       if(empty($this->data['term_id'])){
        $this->error_Messages['term_id']='Please Select the Term';        
       }
                     
       if(empty($this->data['reg_number'])){
        $this->error_Messages['reg_number']='Please Select Student';        
       }
                           
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    } 
    
    
    public function validate_result4(){
       if(empty($this->data['session_id'])){
        $this->error_Messages['session_id']='Please Select the Session';        
       }
       
       if(empty($this->data['term_id'])){
        $this->error_Messages['term_id']='Please Select the Term';        
       }
                     
       if(empty($this->data['class_id'])){
        $this->error_Messages['class_id']='Please Select Your Class';        
       }
                           
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    } 
    
    public function validate_notify(){
         
       if(empty($this->data['message'])){
        $this->error_Messages['message']='Please Enter the message';        
       }
                                 
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    }  
       
    public function validate_password(){
       if(empty($this->data['old_password'])){
        $this->error_Messages['old_password']='Please Enter Your Old password';        
       }
       
       if(empty($this->data['new_password'])){
        $this->error_Messages['new_password']='Please Enter New password';        
       }elseif(strlen($this->data['new_password'])<4){
            $this->error_Messages['new_password']='Password should be up to 4 characters';     
          }
       
       if(empty($this->data['new_password1'])){
        $this->error_Messages['new_password1']='Enter Confirm Password';        
       }elseif($this->data['new_password1'] != $this->data['new_password']){
            $this->error_Messages['new_password1']='Confirm Password do not Match';        
          }
                
                           
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    } 
    
    public function validate_library(){
         
       if(empty($this->data['title'])){
        $this->error_Messages['title']='Please Enter Book title';        
       }
       
       if(empty($this->data['subject'])){
        $this->error_Messages['subject']='Please Select Subject';        
       }
       
       if(empty($this->data['description'])){
        $this->error_Messages['description']='Please Enter Book Description';        
       }
                                 
       if(!empty($this->error_Messages)){
        $this->is_valid=false;    
       }      
          
    }   
      
    public function validate_image(){
        foreach($this->data as $a=>$b){
          $this->type=$b['type']; 
          $this->size=$b['size']; 
        }
        
        if($this->type !='image/jpeg' and $this->type!='image/png' and $this->type!='image/gif' and $this->type!='image/jpg'){
        $this->error_Messages['type']='File type not supported';    
        }  
        
        if($this->size>100000000){
        $this->error_Messages['size']='Image size limit is 1MB';     
        }      
        
        if(!empty($this->error_Messages)){
            $this->is_valid=false;    
        }    
           
        
    }
    
    public function validate_file(){
        foreach($this->data as $a=>$b){
          $this->type=$b['type']; 
          $this->size=$b['size']; 
        }
        
        if($this->type !='application/msword' and $this->type !='application/msexcel' and $this->type !='application/mspowerpoint' and $this->type!='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' and $this->type!='application/vnd.openxmlformats-officedocument.wordprocessingml.document' and $this->type!='application/vnd.openxmlformats-officedocument.presentationml.presentation' and $this->type!='application/pdf'){
        $this->error_Messages['type']='File type not supported';    
        }  
        
        if($this->size>500000000){
        $this->error_Messages['size']='File size limit is 5MB but u have '.$this->size.'bytes';     
        }      
        
        if(!empty($this->error_Messages)){
            $this->is_valid=false;    
        }    
           
        
    }
    
    public function fileExtension(){
        if($this->type=='application/msword' or $this->type=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
         $this->extension='.doc';   
        }elseif($this->type=='application/msexcel' or $this->type=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
            $this->extension='.xlsx';
           }elseif($this->type=='application/mspowerpoint' or $this->type=='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
                $this->extension='.pptx';
             }elseif($this->type=='application/pdf'){
                    $this->extension='.pdf';
                }
        return $this->extension;
    }
    
    
    
    
    
    
  
    public function getIsValid(){
     return $this->is_valid;
            
    }
    
    
   
    public function getError(){
     return $this->error_Messages;
            
    }
    
    
    
    
    
    
    
}
?>