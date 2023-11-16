const btn = document.getElementById("submitButton");
const staff_name = document.getElementById("name_input_field");
const surname = document.getElementById("surname_input_field");
const email = document.getElementById("email_input_field");
const phone = document.getElementById("phone_input_field");
const type = document.getElementById("type_input_field");

btn.addEventListener("click", function(event){
    verifyName(event);
    verifySurname(event);
    verifyEmail(event);
    verifyPhone(event);
    verifyType(event);
    verifyPassword(event);
})


function verifyName(e){
    var messageBox = document.getElementById("name_message");

    if(staff_name.value == ""){
        messageBox.innerHTML = "";
        messageBox.innerHTML = "**Required!";  
        e.preventDefault();
        return false;  
    }else{
        messageBox.innerHTML = "";
        return true;  
    }
}

function verifySurname(e){
    var messageBox = document.getElementById("surname_message");

    if(surname.value == ""){
        messageBox.innerHTML = "";
        messageBox.innerHTML = "**Required!";  
        e.preventDefault();
        return false;  
    }else{
        messageBox.innerHTML = "";
        return true;  
    }
}

function verifyEmail(e){
    var messageBox = document.getElementById("email_message");

    if(email.value == ""){
        messageBox.innerHTML = "";
        messageBox.innerHTML = "**Required!";  
        e.preventDefault();
        return false;  
    }else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))
    {
        messageBox.innerHTML = "";
        return true;  
    }else{
        messageBox.innerHTML = "";
        messageBox.innerHTML = "**Please enter a valid email address";  
        e.preventDefault();
        return false; 
    }
}

function verifyPhone(e){
    var messageBox = document.getElementById("phone_message");

    if(phone.value == ""){
        messageBox.innerHTML = "";
        messageBox.innerHTML = "**Required!";  
        e.preventDefault();
        return false;  
    }else if (phone.value.length < 10 || phone.value.length > 10){
        messageBox.innerHTML = "";
        messageBox.innerHTML = "**Must be 10 digits";  
        e.preventDefault();
        return false; 
    }else{
        messageBox.innerHTML = "";
        return true;  
    }
}

function verifyType(e){
    var messageBox = document.getElementById("type_message");

    if(type.value == ""){
        messageBox.innerHTML = "";
        messageBox.innerHTML = "**Required!";  
        e.preventDefault();
        return false;  
    }else{
        messageBox.innerHTML = "";
        return true;  
    }
}

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

    //Ensure passord has been confirmed
    if(confirmPw !== pw){
        confirmMessageBox.innerHTML = "";
        confirmMessageBox.innerHTML = "**Password does not match";  
        e.preventDefault();
        return false;  
    }

    confirmMessageBox.innerHTML = "";
}