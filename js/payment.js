/**
 * Author:Amandeep Kaur
 * This js file sends the ajax request to the php page so that the payment could take place.
 */
window.addEventListener("load", function () {
    let message = document.getElementById("message");
    document.forms.paymentForm.addEventListener("submit", function (event) {
        event.preventDefault();
        let url = "../php/paymentNextPage.php?from=" + document.getElementById("from").value + "&emailAddr=" + document.getElementById("emailAddr").value +
            "&amount=" + document.getElementById("amount").value;
        /**
         * Prints the json encoded string
         * @param {message} msg 
         */
        function success(msg) {
            message.innerHTML = msg; 
        }
        fetch(url, {
                credentials: 'include'
            })
            .then(response => response.json())
            .then(success);
    });
});