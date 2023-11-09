const btn = document.getElementById("deleteBtn");

btn.addEventListener("click", function(event){
    confirmDelete(event);
});

function confirmDelete(e){
    let message = "Are you sure";
    confirm(message);
}