/**
 * Author:Amandeep Kaur
 * This js file sends the ajax request to the php page so that the transfer could take place.
 */
window.addEventListener("load", function () {
    let message = document.getElementById("transferred");
    /**
     * Prints the json encoded string
     * @param {message} msg 
     */
    function success(msg) {
        message.innerHTML = msg;
        
    }
    document.forms.transferForm.addEventListener("submit", function (event) {
        event.preventDefault();
        let fromValue = document.forms.transferForm.from.value;
        let toValue = document.forms.transferForm.to.value;
        let amount = document.forms.transferForm.amount.value;
        let url = "../php/transferNextPage.php?from=" + fromValue + "&to=" + toValue + "&amount=" + amount;
        fetch(url, {
            credentials: 'include'
        })
        .then(response => response.json())
        .then(success);

    });
});