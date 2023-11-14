const btn = document.getElementById("deleteBtn");

btn.addEventListener("click", function(event){
    let message = "Are you sure";
    if(confirm(message) === false){
        event.preventDefault();
    }
});