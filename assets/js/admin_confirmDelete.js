let deleteBtn = document.getElementById('confirmDeleteUser');

deleteBtn.addEventListener('click', (e)=>{
if(confirm("Are you sure you want to delete this user?")==false){
    e.preventDefault();
}
})