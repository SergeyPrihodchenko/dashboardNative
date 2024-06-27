export const mainEmailRender = (domElem, data, clear = true) => {

    fetch('/emailDashboardData', {
        method: 'POST',

        body: data
    })
    .then(async res => {
        
        if(clear) {
            domElem.innerHTML = '';
        }

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

export const tableBuilder = (domEl, data) => {

    data.clientData.map((el) => {
        const tr = document.createElement('tr')
  
        for (const key in el) {
            const td = document.createElement('td')
            td.textContent = el[key]
            tr.appendChild(td)
        }

        domEl.appendChild(tr)
    });

}

export const scrolling = (scrollTop, scrollHeight, clientHeight, page, mailAttr, siteAttr, modal) => {
    if(scrollTop + clientHeight >= scrollHeight) {
        uploader(mailAttr, siteAttr, page, modal)
    }
}

export const uploader = (mail, site, page, modal) => {

    const data = new FormData();
            data.append('mail', mail)
            data.append('site', site)
            data.append('page', page)
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
                const table = modal.querySelector('tbody');
                
                if(page <= 1) {
                    table.innerHTML = ''
                }

                tableBuilder(table, data)

            })
            .catch(err => {
                console.log(err);
            })

}