document.addEventListener('DOMContentLoaded', (e) => {
    const siteOption = document.querySelector('.sites_option');
    const typeOption = document.querySelector('.type_option');
    const clientsTable = document.querySelector('.email_tbody');
    const modal = document.getElementById("myModal");
    const span = document.getElementsByClassName("close")[0];
    const modalTable = modal.querySelector('.block_table');

    mainEmailRender(clientsTable)

    siteOption.addEventListener('change', (e) => {

        const data = new FormData
        data.append('titleSite', e.target.value)
        data.append('page', 1)

        mainEmailRender(clientsTable, data)

    })


    modalTable.addEventListener('scroll', (e) => {
        console.log(e.target.scrollTop);
        const scrollHeight = e.target.scrollHeight;
        // Получаем видимую высоту элемента
        const clientHeight = e.target.clientHeight;
        console.log(scrollHeight);
        console.log(clientHeight);
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

    clientsTable.addEventListener('click', (e) => {

        if(e.target.classList.contains('btn_open_modal')) {
            const data = new FormData();
            data.append('email', e.target.dataset.clientMail)
            data.append('site', e.target.dataset.site)

            fetch('/emailClientCard', {
                method: 'POST',
                body: data
            })
            .then(async res => {
                modal.style.display = "block"
                const data = await res.json()
                const title = document.querySelector('.m_site_title')
                const clientMail = document.querySelector('.m_client_mail')

                title.textContent = data.site
                clientMail.textContent = data.clientMail

                const table = modal.querySelector("tbody")
                table.innerHTML = ''

                data.clientData.map((el) => {
                    const tr = document.createElement('tr')
              
                    for (const key in el) {
                        const td = document.createElement('td')
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

const mainEmailRender = (domElem, titleSite) => {

    fetch('/emailDashboardData', {
        method: 'POST',

        body: titleSite
    })
    .then(async res => {
        domElem.innerHTML = '';

        const data = await res.json();

        data.clients.map((el) => {
        const tdLink = document.createElement('td');
        const tr = document.createElement('tr');

        tdLink.dataset.site = data.site
        tdLink.dataset.clientMail = el.client_mail
        tdLink.classList.add('btn_open_modal')
        tdLink.innerHTML = '&#11162'
        tr.appendChild(tdLink)
    
        for (const key in el) {
            const td = document.createElement('td');
            td.textContent = el[key]
            tr.appendChild(td)
        }
        domElem.appendChild(tr)
        });

    })
    .catch(err => {
        console.log(err);
    })
}

function scrollUploader(domElem) {

    domElem.addEventListener('scroll', e => {
        console.log(e.target);
    })
}