document.addEventListener('DOMContentLoaded', (e) => {

    const option = document.querySelector('.sites_option');
    
    option.addEventListener('change', (e) => {
        window.location.href = '/?titleSite='+e.target.value
        e.target.selected = true;
    });
})