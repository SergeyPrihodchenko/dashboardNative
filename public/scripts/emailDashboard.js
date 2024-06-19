document.addEventListener('DOMContentLoaded', (e) => {

    const siteOption = document.querySelector('.sites_option');
    const typeOption = document.querySelector('.type_option');
    const modal = document.getElementById("myModal");
    const span = document.getElementsByClassName("close")[0];


    document.addEventListener('click', (e) => {
        if(e.target.classList.contains('btn_open_modal')) {
            const data = new FormData();
            data.append('email', e.target.dataset.email)
            data.append('site', e.target.dataset.site)

            fetch('/emailClientCard', {
                method: 'POST',
                body: data
            })
            .then(async res => {
                modal.style.display = "block"
                const data = await res.json()
                const title = document.querySelector('.m_site_title')
                const clientEmail = document.querySelector('.m_client_email')

                title.textContent = data.site
                clientEmail.textContent = data.clientEmail

                const table = modal.querySelector("tbody");
                data.clientData.map((el) => {
                    const tr = document.createElement('tr');
              
                    for (const key in el) {
                        const td = document.createElement('td');
                        td.textContent = el[key]
                        tr.appendChild(td)
                    }

                    table.appendChild(tr)
                });
            })
            .catch(err => {
                console.log(err);
            })
        }
            
    });


    if(siteOption) {
        siteOption.addEventListener('change', (e) => {
            window.location.href = '/?titleSite='+e.target.value
        });
    }

    typeOption.addEventListener('change', (e) => {
        window.location.href = '/'+e.target.value
    });

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
})


