<?php

class Database{
    protected $host;
    protected $username;
    protected $password;
    protected $database_name;
    public $conn;
    protected $data=array();
    protected $data1=array();
    protected $database_table;
    protected $result;
    protected $insert_id;
    protected $order;
    protected $limit;
        
    
    
    
    public function __construct($host,$username,$password,$database_name){
        
        if(empty($host) or empty($username) or empty($database_name)){
         die('Missing database Config File');            
        }
      $this->host=$host;
      $this->username=$username;
      $this->password=$password;
      $this->database_name=$database_name;        
    }
   
   
   
    public function connect(){
     $this->conn=new mysqli($this->host,$this->username,$this->password,$this->database_name);   
      if($this->conn->connect_error){
        die('Database Connection couldn\'t be established');
      }  
    }
    
    
    
    public function insert($table,array $params){
       if(empty($params) or !is_array($params) or empty($table)){
        die("Invalid Data");
       } 
      
       $this->database_table=$table;
       $this->data=$params;
       
       $query='REPLACE INTO ';
       $query.=$this->database_table.' (';
       
        foreach($this->data as $field=>$value){
            if($field !='action' and $field !='file' and $field !='password2'){
               $query.='`';
               $query.=$field;
               $query.='`,'; 
             }  
        }
        $query=rtrim($query,',');
        $query.=') VALUES (';
                
        foreach($this->data as $field=>$value){
             if($field !='action' and $field !='file' and $field !='password2'){
               $query.='\'';
               $query.=$value;
               $query.='\','; 
             }
        }
        $query=rtrim($query,',');
        $query.=')';
       return $this->conn->query($query);
        
    }
    
    
    
    public function select($table, array $where=array(),array $order=array(),$limit=''){
     if(!is_array($where) or empty($table) or !is_array($order)){
        die("Invalid Data");
       }
       
       $this->database_table=$table; 
       $this->data=$where;
       $this->order=$order;
       $this->limit=$limit;
       
       
       $query='SELECT * FROM ';
       $query.=$this->database_table;
       
       if(!empty($this->data)){
           $query.=' WHERE ';
           
           foreach($this->data as $field=>$value){
                if($field !='action' and $field !='file'){
                  $query.='`'.$field.'`'.'='.'\''.$value.'\''.' AND ';
                }
           }
           $length=strlen($query)-5;
           $query=substr_replace($query,"",$length);
       }
       
       if(!empty($this->order)){
           $query.=' ORDER BY ';
           
           foreach($this->order as $field=>$value){
                
                  $query.='`'.$field.'` '.$value;
                
           }
           
       }
       
       if(!empty($this->limit)){
           $query.=' LIMIT ';
                      
        $query.=$limit;
         
       }
       
       $this->result=$this->conn->query($query);  
       
       return $this->result; 
        
    }
    
    
    public function update($table, array $params, array $where){
       if(empty($params) or !is_array($params) or empty($table) or empty($where) or ! is_array($where)){
        die("Invalid Data");
       } 
        $this->database_table=$table; 
        $this->data=$params;
        $this->data1=$where;
        
        
        $query='UPDATE ';
        $query.=$this->database_table;
        $query.=' SET ';
        
        foreach($this->data as $field=>$value){
                if($field !='action' and $field !='image_id' and $field !='session_id'){
                  $query.='`'.$field.'`'.'='.'\''.$value.'\',';
                }
           }
        $query=rtrim($query,',');
        $query.=' WHERE ';
        
        foreach($this->data1 as $field=>$value){
               
                  $query.='`'.$field.'`'.'='.'\''.$value.'\' AND ';
                
           }
        
        $length=strlen($query)-5;
        $query=substr_replace($query,"",$length);
        
        $result=$this->conn->query($query);
        return $result;
    
        
    }
    
    
    
    public function delete($table, array $where){
       if(empty($table) or empty($where) or ! is_array($where)){
        die("Invalid Data");
       } 
        
        $this->database_table=$table; 
        $this->data=$where;
        
        
        $query='DELETE FROM ';
        $query.=$this->database_table;
        $query.=' WHERE ';
        
        foreach($this->data as $field=>$value){
                if($field !='action' and $field !='file'){
                  $query.='`'.$field.'`'.'='.'\''.$value.'\'AND';
                }                
           }
        $length=strlen($query)-3;
        $query=substr_replace($query,"",$length);   
        
        $result=$this->conn->query($query);
        return $result;
    
        
    }
    
    public function custom($query){
       $result=$this->conn->query($query);
       return $result;        
    }
        
      
    public function insert_id(){
        return $this->conn->insert_id;
    }
    
    public function numRow(){
        return $this->conn->affected_rows;                
    } 
    
    public function getSubjectName($subject_id){  
        $result=$this->select('exam_subject_list',array('subject_id'=>$subject_id));        
        $row=mysqli_fetch_assoc($result);
        extract($row);
        return $name;       
        
    }
    
    public function getSubjectName1($subject_id){  
        $result=$this->select('subjects',array('subject_id'=>$subject_id));        
        $row=mysqli_fetch_assoc($result);
        extract($row);
        return $short_name;       
        
    }
    
    public function getSubjectName2($subject_id){  
        $result=$this->select('subjects',array('subject_id'=>$subject_id));        
        $row=mysqli_fetch_assoc($result);
        extract($row);
        return $name;       
        
    }
    
    public function getUserName($reg_number){ 
        $result=$this->select('user_info_table',array('reg_number'=>$reg_number));  
        $row=mysqli_fetch_assoc($result);
        extract($row);
        return $last_name.' '.$first_name;       
        
    }
    
    public function getTermName($term_id){ 
        $result=$this->select('term',array('term_id'=>$term_id));  
        if($this->numRow()>0){
          $row=mysqli_fetch_assoc($result);
          extract($row);
          return $name;   
        }else{
            return 'Annual';
        }
              
        
    }
    
    public function getSessionName($session_id){ 
        $result=$this->select('session',array('session_id'=>$session_id));  
        $row=mysqli_fetch_assoc($result);
        extract($row);
        return $session;       
        
    }
    
    public function getTeacherName($class_id){ 
        $result=$this->select('classes',array('class_id'=>$class_id));  
        $row=mysqli_fetch_assoc($result);
        extract($row);
        return $teacher;       
        
    }
    
    public function getAccessName($access_level){ 
        $result=$this->select('access_table',array('access_level'=>$access_level));  
        $row=mysqli_fetch_assoc($result);
        extract($row);
        return $access_name;       
        
    }
        
    public function getClassName($class_id='null'){ 
        $result=$this->select('classes',array('class_id'=>$class_id));
        $row=mysqli_fetch_assoc($result);
        if($this->numRow()==0){
            return 'No Class';
        }else{
           extract($row);
           return $name;    
        }
            
        
    }
    
    public function getCommentNo($article_id){ 
        $result=$this->select('comments',array('article_id'=>$article_id));
        $num=$this->numRow();
        return $num;       
        
    }
    
    public function listClasses($id=null){
        $selectClassesList='<option value="">Select Class</option>';
        $result=$this->select('classes');
        if($this->numRow()>0){
          while($row=mysqli_fetch_assoc($result)){            
            extract($row);
            $selected=null;
            if($class_id==$id){
               $selected="selected=selected"; 
            }
            
          $selectClassesList.="<option $selected value=$class_id>$name</option>";
          }  
        }
        return $selectClassesList;        
    }
    
    public function listSession($id=null){
        $selectSessionList='<option value="">Select Session</option>';
        $result=$this->select('session');
        if($this->numRow()>0){
          while($row=mysqli_fetch_assoc($result)){            
            extract($row);
            $selected=null;
            if($session_id==$id){
               $selected="selected=selected"; 
            }
            
          $selectSessionList.="<option $selected value=$session_id>$session</option>";
          }  
        }
        return $selectSessionList;        
    }
    
    public function listSubject($id=null,$class_id=null){
        $selectSubjectList='<option value="">Select Subject</option>';
        if(!empty($class_id)){
            $result=$this->select('subjects',array('class_id'=>$class_id));
        }else{
           $result=$this->select('subjects');  
          }        
            if($this->numRow()>0){
              while($row=mysqli_fetch_assoc($result)){            
                extract($row);
                $selected=null;
                if($subject_id==$id){
                   $selected="selected=selected"; 
                }
                
              $selectSubjectList.="<option $selected value=$subject_id>$name:".$this->getClassName($class_id)."</option>";
              }  
            }
        return $selectSubjectList;        
    }
    
    public function listStudents($id=null,$class_id=null){
        $selectStudentList='<option value="">Select Student</option>';
        if(!empty($class_id)){
            $result=$this->select('user_info_table',array('class_id'=>$class_id,'access_level'=>'1','status'=>'true'));
        }else{
           $result=$this->select('user_info_table');  
          }        
            if($this->numRow()>0){
              while($row=mysqli_fetch_assoc($result)){            
                extract($row);
                $selected=null;
                if($reg_number==$id){
                   $selected="selected=selected"; 
                }
                
              $selectStudentList.="<option $selected value=$reg_number>$last_name $first_name:".$this->getClassName($class_id)."</option>";
              }  
            }
        return $selectStudentList;        
    }
    
    public function listTerm($id=null){
        $selectTermList='<option value="">Select Term</option>';
        $result=$this->select('term');
        if($this->numRow()>0){
          while($row=mysqli_fetch_assoc($result)){            
            extract($row);
            $selected=null;
            if($term_id==$id){
               $selected="selected=selected"; 
            }
            
          $selectTermList.="<option $selected value=$term_id>$name</option>";
          }  
        }
        return $selectTermList;        
    }
    
    public function listAccessLevel($id=null){
        $selectAccessList='<option value="">Select User</option>';
        $result=$this->select('access_table');
        if($this->numRow()>0){
          while($row=mysqli_fetch_assoc($result)){            
            extract($row);
            $selected=null;
            if($access_id==$id){
               $selected="selected=selected"; 
            }
            
          $selectAccessList.="<option $selected value=$access_level>$access_name</option>";
          }  
        }
        return $selectAccessList;        
    }
    
    public function getGrade($score=null){
      if($score>=70){
        $grade='A';
      }elseif($score>=60){
          $grade='B';
         }elseif($score>=50){
           $grade='C';
          }elseif($score>=45){
             $grade='D';
            }elseif($score>=40){
               $grade='E';
              }elseif($score<40){
                 $grade='F';
                }    
      return $grade;      
        
    }
    
    public function getRemark($average=null){
      if($average>=70){
        $remark='EXCELLENT';
      }elseif($average>=55){
         $remark='GOOD';
        }elseif($average>=50){
            $remark='FAIR';
          }elseif($average>=40){
             $remark='POOR';
            }elseif($average<40){
               $remark='FAIL';
              }     
      return $remark;      
        
    }
    
    public function trim_body($text,$max_length=400,$tail='...'){
        $tail_len=strlen($tail);
    	if(strlen($text)> $max_length){
    		$tmp_text=substr($text,0,$max_length-$tail_len);
    //$max_length-$tail_length becos the $tail contains some characters(...)already that will be included in the main text	
    		if(substr($text, $max_length-$tail_len, 1)== ' '){
    //if an empty space is next after the last truncated character
    
    // note use double space not single space
    			$text = $tmp_text;
    		}
    		else{
    //if not then the truncation happened within a word
    			$pos=strrpos($tmp_text,' ');
    // getting the position of the last space
    			$text=substr($text,0,$pos);		
    		}
    		$text = $text.$tail;		
    	}
    	return $text;
   } 
    
    
           
    
    
    public function closeDb(){
      return $this->conn->close(); 
    } 
    
    
  
        
    
}

?>