document.addEventListener('DOMContentLoaded', (e) => {
    const siteOption = document.querySelector('.sites_option');
    const typeOption = document.querySelector('.type_option');
    const clientsTable = document.querySelector('.email_tbody');
    const modal = document.getElementById("myModal");
    const span = document.getElementsByClassName("close")[0];



    mainEmailRender(clientsTable);

    siteOption.addEventListener('change', (e) => {

        mainEmailRender(clientsTable, e.target.value);

    })


    


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

    document.addEventListener('click', (e) => {

        if(e.target.classList.contains('btn_open_modal')) {
            const data = new FormData();
            data.append('email', e.target.dataset.clientEmail)
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

})

const mainEmailRender = (elem, titleSite = 'hylok') => {
    fetch('/emailDashboardData', {
        method: 'POST',

        body: titleSite
    })
    .then(async res => {

        const data = await res.json();

        data.clients.map((el) => {
        const tdLink = document.createElement('td');
        const tr = document.createElement('tr');

        tdLink.dataset.site = data.site
        tdLink.dataset.clientEmail = el.client_mail
        tdLink.classList.add('btn_open_modal')
        tdLink.innerHTML = '&#11162'
        tr.appendChild(tdLink)
    
        for (const key in el) {
            const td = document.createElement('td');
            td.textContent = el[key]
            tr.appendChild(td)
        }
        elem.appendChild(tr)
    });

    })
    .catch(err => {
        console.log(err);
    })
}