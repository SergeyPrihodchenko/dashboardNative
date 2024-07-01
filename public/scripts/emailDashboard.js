import { mainEmailRender, tableBuilder, scrolling, uploader } from './modules/emailDashboardM.js'

document.addEventListener('DOMContentLoaded', (e) => {
    const siteOption = document.querySelector('.sites_option');
    const typeOption = document.querySelector('.type_option');
    const clientsTable = document.querySelector('.email_tbody');
    const modal = document.getElementById("myModal");
    const span = document.getElementsByClassName("close")[0];
    const modalTable = modal.querySelector('.m_block_table');
    const pageTable = document.querySelector('.block_table');

    let mainPage = 1;
    let modalPage = 1;

    let siteAttr = ''
    let mailAttr = ''

    mainEmailRender(clientsTable, {page: mainPage})

    siteOption.addEventListener('change', (e) => {

        const data = new FormData
        data.append('titleSite', e.target.value)
        data.append('page', 1)

        mainEmailRender(clientsTable, data)

    })


    typeOption.addEventListener('change', (e) => {
        window.location.href = '/'+e.target.value
    });

    span.onclick = function() {
        modal.style.display = "none";
        modalPage = 1
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            modalPage = 1
        }
    }

    clientsTable.addEventListener('click', (e) => {

        const data = new FormData
        data.append('mail', e.target.dataset.clientMail)
        data.append('site', e.target.dataset.site)
        data.append('id', e.target.dataset.clientId)
        console.log(e.target.dataset.clientId, e.target.dataset.site, e.target.dataset.clientMail);
        fetch('/emailClientCard', {
            method: 'POST',
            body: data
        })
        .then(async res => {
            const response = await res.json()
            console.log(response);

            const mail = response.clientMail
            const site = response.site
            const domEl = modal.querySelector('.card_events')
            domEl.innerHTML = ''
            const title = document.querySelector('.site_title')
            const titleMail = document.querySelector('.client_mail')
            const clientCode = document.querySelector('.client_code')
            title.textContent = site
            titleMail.textContent = mail

            for(let key in response.data) {


                const cardGroup = document.createElement('div')
                cardGroup.classList.add('card_group')
                const cardGroupTitle = document.createElement('h4')
                cardGroupTitle.classList.add('card_group_title')
                cardGroupTitle.textContent = key
                cardGroup.appendChild(cardGroupTitle)
                response.data[key].forEach(obj => {
                    const card = document.createElement('div')
                    card.classList.add('card')
                    const cardTitle = document.createElement('h4')
                    cardTitle.classList.add('card_title')
                    cardGroup.appendChild(card)
                    card.appendChild(cardTitle)
                    for(let key in obj) {
                        if(key == '1C') {
                            clientCode.textContent = obj[key].client_code
                            cardTitle.textContent = key
                            const object = obj[key]
                            for(let key in object) {
                                const p = document.createElement('p')
                                p.classList.add(key)
                                p.textContent = object[key]
                                card.appendChild(p)
                            }
                        } 
                       
                        if(key == 'yandex') {
                            cardTitle.textContent = key
                            const yandex = obj[key]
                                yandex['dimensions'].forEach(el => {
                                    for(key in el) {
                                        const p = document.createElement('p')
                                        p.classList.add(key)
                                        p.textContent = el[key]
                                        card.appendChild(p)
                                    }
                                })
                                yandex['metrics'].forEach((el, key) => {
                                    const metricTitle = ['посещения', 'пользователи']
                                    const p = document.createElement('p')
                                    p.classList.add('metric')
                                    p.textContent = metricTitle[key] + " : " + el
                                    card.appendChild(p)
                                })
                        }
                    }
                });
                domEl.appendChild(cardGroup)
            }
        })
        .catch(err => {
            console.log(err);
        })
        if(e.target.classList.contains('btn_open_modal')) {
            modal.style.display = "block"
        }
            
    });

})

