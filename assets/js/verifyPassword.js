const btn = document.getElementById("submitButton")

btn.addEventListener("click", function(event){
    verifyPassword(event);
})


function verifyPassword(e){
    var pw = document.getElementById("password").value; 
    var confirmPw = document.getElementById("confirmPassword").value
    var pwMessageBox = document.getElementById("message");
    var confirmMessageBox = document.getElementById("confirmMessage"); 
    //check empty password field  
    if(pw == "") {  
        pwMessageBox.innerHTML = "";
        pwMessageBox.innerHTML = "**Fill the password please!";  
        e.preventDefault();
        return false;  
    }  
    
    //minimum password length validation  
    if(pw.length < 8) {  
        pwMessageBox.innerHTML = "";
        pwMessageBox.innerHTML = "**Password length must be atleast 8 characters";  
        e.preventDefault();
        return false;  
    }  
    
    //maximum length of password validation  
    if(pw.length > 15) { 
        pwMessageBox.innerHTML = ""; 
        pwMessageBox.innerHTML = "**Password length must not exceed 15 characters";  
        e.preventDefault();
        return false;  
    }

    pwMessageBox.innerHTML = ""; 

    //check empty password field  
    if(confirmPw == "") {  
        confirmMessageBox.innerHTML = "";
        confirmMessageBox.innerHTML = "**Please confirm the password";  
        e.preventDefault();
        return false;  
    } 

    //minimum password length validation  
    if(confirmPw.length < 8) {  
        confirmMessageBox.innerHTML = "";
        confirmMessageBox.innerHTML = "**Password length must be atleast 8 characters";  
        e.preventDefault();
        return false;  
    }  

    //maximum length of password validation  
    if(confirmPw.length > 15) {  
        confirmMessageBox.innerHTML = "";
        confirmMessageBox.innerHTML = "**Password length must not exceed 15 characters"; 
        e.preventDefault(); 
        return false;  
    }

    //Passwords are of equal length
    if(confirmPw.length !== pw.length){
        confirmMessageBox.innerHTML = "";
        confirmMessageBox.innerHTML = "**Length must macth"; 
        e.preventDefault(); 
        return false;
    }

    //Ensure passord has been confirmed
    if(confirmPw !== pw){
        confirmMessageBox.innerHTML = "";
        confirmMessageBox.innerHTML = "**Password does not match";  
        e.preventDefault();
        return false;  
    }

    confirmMessageBox.innerHTML = "";
}
