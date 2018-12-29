$(document).ready(function(){
    $(document).on('change',".selectOption", function(){
       var objValue= $(this).val();
           if(objValue==1 || objValue==2){
             $('.classes').removeClass('hide');
           }else{
              $('.classes').addClass('hide');
             }                   
    });   
    
    
    $(document).on('change',".class_id", function(){
      var class_id= $(this).val();
      
        if(class_id){
            $.ajax({type:"POST",
                    url:"custom.php",
                    data:"class_id="+class_id,
                    success:function(result){
                     $(".subject_id").html(result);
                      
                     }  
            });        
            
        }else{
           $(".subject_id").html('<option value="">Select Class First</option>');
            
          }
        
        
    });
    
    
    $(document).on('change',".class", function(){
      var class_id= $(this).val();
      
        if(class_id){
            $.ajax({type:"POST",
                    url:"custom.php",
                    data:"student_class="+class_id,
                    success:function(result){
                     $(".reg_number").html(result);
                      
                     }  
            });        
            
        }else{
           $(".reg_number").html('<option value="">Select Class First</option>');
            
          }
        
        
    });
    
    
});

function checkRegister() {
	if (document.register.reg_number.value == "") {
		alertify.alert('Sign up Error', 'Please Enter Reg Number');
		return false;
	}
	if (document.register.password1.value == "") {
		alertify.alert('Sign up Error', 'Please Enter Password');
		return false;
	} else if (document.register.password1.value.length < 4) {
		alertify.alert('Sign up Error', 'Password should be up to 4 characters');
		return false;
	}
	if (document.register.password2.value == "") {
		alertify.alert('Sign up Error', 'Please Enter Confirm Password');
		return false;
	}
	if (document.register.password1.value != document.register.password2.value) {
		alertify.alert('Sign up Error', 'Confirm Password do not match');
		return false;
	}
	if (document.register.first_name.value == "") {
		alertify.alert('Sign up Error', 'Please Enter First Name');
		return false;
	}
	if (document.register.last_name.value == "") {
		alertify.alert('Sign up Error', 'Please Enter Last Name');
		return false;
	}   
	if (document.register.phone_number.value == "") {
		alertify.alert('Sign up Error', 'Please Enter Phone Number');
		return false;
	}
	if (document.register.gender.value == "") {
		alertify.alert('Sign up Error', 'Please Select Gender');
		return false;
	}
	if (document.register.access_level.value == "") {
		alertify.alert('Sign up Error', 'Please Select User');
		return false;
	}
    
    var test = document.getElementById('class_id');
    var testClass=test.className;
    if(testClass.indexOf('hide')==-1){
        if (document.register.class_id.value == "") {
		alertify.alert('Sign up Error', 'Please Select Class');
		return false;
     	}
    }else{
       return;
      }
      
	return true;
}

function checkModify() {
	
	if (document.register.first_name.value == "") {
		alertify.alert('Sign up Error', 'Please Enter First Name');
		return false;
	}
	if (document.register.last_name.value == "") {
		alertify.alert('Sign up Error', 'Please Enter Last Name');
		return false;
	}   
	if (document.register.phone_number.value == "") {
		alertify.alert('Sign up Error', 'Please Enter Phone Number');
		return false;
	}
	if (document.register.gender.value == "") {
		alertify.alert('Sign up Error', 'Please Select Gender');
		return false;
	}
    
    var test = document.getElementById('class_id');
    var testClass=test.className;
    if(testClass.indexOf('hide')==-1){
        if (document.register.class_id.value == "") {
		alertify.alert('Sign up Error', 'Please Select Class');
		return false;
     	}
    }else{
       return;
      }

	return true;
}

function checkLogin() {
	if (document.login.reg_number.value == "") {
		alertify.alert('Login Error', 'Please Enter Reg Number');
        return false;
	}
	if (document.login.password.value == "") {
		alertify.alert('Login Error', 'Please Enter Password');
		return false;
	} 
	
	if (document.login.access_level.value == "") {
		alertify.alert('Login Error', 'Please Select User');
		return false;
	}
	return true;
}

function checkContact() {
	if (document.contact.full_name.value == "") {
		alertify.alert('Contact Error', 'Please Enter Full Name');
		return false;
	}
	
    if (document.contact.subject.value == "") {
		alertify.alert('Contact Error', 'Please Enter Subject');
		return false;
	} 
    if (document.contact.phone_number.value == "") {
		alertify.alert('Contact Error', 'Please Enter Phone Number');
		return false;
	} 
	if (document.contact.message.value == "") {
		alertify.alert('Contact Error', 'Please Enter the Message');
		return false;
	} 
	return true;
}

function checkSession() {
	if (document.session.session.value == "") {
		alertify.alert('Add Session Error', 'Please Enter the Session');
        return false;
	}
	if (document.session.term.value == "") {
		alertify.alert('Add Session Error', 'Please Select the Term');
		return false;
	} 
		
	return true;
}

function checkClass() {
	if (document.classForm.name.value == "") {
		alertify.alert('Add Class Error', 'Please Enter Class Name');
        return false;
	}
	if (document.classForm.teacher.value == "") {
		alertify.alert('Add Class Error', 'Please Enter Teacher\'s Name');
        return false;
	}
    if (document.classForm.population.value == "") {
		alertify.alert('Add Class Error', 'Please Enter Number of Students');
        return false;
	} 
		
	return true;
}


function checkDelete(){
    
    var status=confirm('Confirm Delete');
    if(status){
        return true;
    }else{
        return false;
      }  
    
}

function checkApprove(){
    
    var status=confirm('Confirm Approve');
    if(status){
        return true;
    }else{
        return false;
      }  
    
}

function checkEdit(){    
   
    var status=confirm('Confirm Edit');
    if(status){
        return true;
    }else{
        return false;
      }
       
}

$(document).ready(function () {
    $(document).on('change', "#titleImage", function () {
        //Get count of selected files
        var allowedExtensions = /(\.gif|\.png|\.jpg|\.jpeg)$/i;
        $("#titleImageError").text("");
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var imgName = $(this)[0].files[0].name;
        var image_holder = $("#image-holder");
        image_holder.empty();
        if (allowedExtensions.exec(imgPath)) {
            if (typeof (FileReader) != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++)
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<p>" + imgName + "</p>").appendTo(image_holder);
                        $("<img />", {
                            "src": e.target.result,
                            "class": "thumb-image"
                        }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
            } else {
                $("#titleImage").val("");
                $("#titleImage").focus();
                $("#titleImageError").text("This browser does not support FileReader.");
            }
        } else {
            $("#titleImage").val("");
            $("#titleImage").focus();
            $("#titleImageError").text("Please select only images of type: .gif, .png, .jpg, .jpeg");
        }
    
    });
});

function checkPicture(){
 if (document.picture.titleImage.value == "") {
		alertify.alert('Picture Error', 'Please Upload Image');
        return false;
 } 
 return true;
}

function checkPassword(){
 if (document.password.old_password.value == "") {
		alertify.alert('Password Error', 'Please Enter the Old Password');
        return false;
 } 
 
 if (document.password.new_password.value == "") {
		alertify.alert('Password Error', 'Please Enter New Password');
        return false;
 } else if (document.password.new_password.value.length < 8) {
		alertify.alert('Password Error', 'Password should be up to 8 characters');
        return false;
    }
    
 if (document.password.new_password1.value == "") {
		alertify.alert('Password Error', 'Please Confirm New Password');
        return false;
 } 
 
 if (document.password.new_password1.value != document.password.new_password.value) {
		alertify.alert('Password Error', 'The Confirm Password does not match');
        return false;
 } 
 return true;
}


function checkNotify(){
 if (document.notify.message.value == "") {
		alertify.alert('Error', 'Please Enter the Message');
        return false;
 } 
 
 return true;
}

function checkLibrary(){
 if (document.library.title.value == "") {
		alertify.alert('Library Error', 'Please Enter Book Title');
        return false;
 } 
 
 if (document.library.subject.value == "") {
		alertify.alert('Library Error', 'Please Enter Book Subject');
        return false;
 } 
 
 if (document.library.description.value == "") {
		alertify.alert('Library Error', 'Please Enter Book Description');
        return false;
 }  
 
 if (document.library.file.value == "") {
		alertify.alert('Library Error', 'Select File to Upload');
        return false;
 } 
 
 return true;
}

function checkQuestion(){
 if (document.question.questions.value == "") {
		alertify.alert('Question Error', 'Please Enter the Question');
        return false;
 } 
 
 if (document.question.option1.value == "") {
		alertify.alert('Question Error', 'Please Enter Option1');
        return false;
 } 
 
  
 return true;
}





