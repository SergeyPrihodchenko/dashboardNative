document.addEventListener('DOMContentLoaded', (e) => {

    const siteOption = document.querySelector('.sites_option');
    const typeOption = document.querySelector('.type_option');
    
    if(siteOption) {
        siteOption.addEventListener('change', (e) => {
            window.location.href = '/?titleSite='+e.target.value
        });
    }

    typeOption.addEventListener('change', (e) => {
        window.location.href = '/'+e.target.value
    });

    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
})


