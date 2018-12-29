<?php
/*

$result=array();

$pos=$real_pos=0;
$prev_score=-1;


    foreach($students as $exam_no=>$score){
       $real_pos +=1;
       $pos=($prev_score != $score)? $real_pos: $pos;
       $result[$exam_no]=array('score'=>$score,'position'=>$pos,'exam_no'=>$exam_no);
       echo $score.' == '.$result[$exam_no]['position']."<br>";
       $prev_score=$score;              
        
    }
    
*/ 

$newStudents=array();
$pos=0;
$count=0;
$holder=-1;

    foreach($students as $k=>$v){
        $count++;
            if($v<$holder || $holder==-1){
                $holder=$v;
                $pos=$count;
            }
        $newStudents[]=makeStudent($pos,$v,$k);
    }
    
    $newStudents=fixLast($newStudents);
   
      /*print_r($newStudents);
    
        foreach($newStudents as $v){
            echo 'Position :'.$v->position."<br>";
            echo 'Score :'.$v->score."<br>";
            echo 'exam_no :'.$v->examNo."<br>";        
        }
        echo"<br><br>";
        echo getPosition($newStudents,'2011513333');    
      */
   
    
    function makeStudent($pos,$sco,$No){
        $student= new stdClass();
        $student->position=$pos;
        $student->score=$sco;
        $student->examNo=$No; 
        
        return $student;       
        
    }
    
    function fixLast($students){
        $length=count($students)-1;
        $count=0;
        $i=$length;
            while($students[$i]->position==$students[--$i]->position){
                $count++;                
            }
            
            for($i=0; $i<=$count; $i++){
                $students[$length-$i]->position=$students[$length-$i]->position+$count;
            }
            
        return $students;
                    
    }
    
    function getPosition($newStudents,$reg_number){
         foreach($newStudents as $v){           
            if($v->examNo==$reg_number){
               return $v->position; 
            }       
        }   
        
    }
    
       
       
    function suffix($value){ 
        
            switch ($value) {
                case 1:
                case 21:
                case 31:
                    $suffix = $value."st";
                break;
                
                case 2:
                case 22:
                    $suffix = $value."nd";
                break;
                
                case 3:
                case 23:
                    $suffix = $value."rd";
                break;
                
                default:
                    $suffix= $value."th";
                break;
            
          }
        return $suffix;
    }    
    

    


?>
