var orderComplete;
const successSection = document.getElementById("thankYou");
const unsuccessfulSection = document.getElementById("unsuccessful");

window.onload = () =>{
    orderComplete  = localStorage.getItem("orderComplete");
    console.log(orderComplete)

    if(orderComplete != null){
        if(orderComplete == 1){
            successSection.classList.remove("hidden");
            unsuccessfulSection.classList.add("hidden");

            localStorage.removeItem("usercart");
        }else if(orderComplete == 0){
            successSection.classList.add("hidden");
            unsuccessfulSection.classList.remove("hidden");
        }
    }else{
        window.location = "home.php";
    }
}

function redirect(){
    window.location = "home.php";
}