/**
 * Author:Amandeep Kaur
 * This js file sends the ajax request to the php page so that the required data can be updated.
 */
window.addEventListener("load",function(){
    let updated = document.getElementById("updated");
    /**
     * Prints the json encoded string
     * @param {message} msg 
     */
    function success(msg){
        updated.innerHTML = msg;
    }
    document.forms.updateFormID.addEventListener("submit",function(event){
        event.preventDefault();
        let userID = document.getElementById("userID").value;
        let url = "../php/changeID.php?userID="+userID;
        fetch(url,{credentials:'include'}).then(response => response.json()).then(success);
    });
    document.forms.updateFormPass.addEventListener("submit",function(event){
        event.preventDefault();
        let pass1 = document.getElementById("pass1").value;
        let pass2 = document.getElementById("pass2").value;
        let url = "../php/changePassword.php?pass1="+ pass1 +"&pass2="+ pass2;
        fetch(url,{credentials:'include'}).then(response => response.json()).then(success);
    });
});