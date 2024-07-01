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
        document.querySelector('.loader_block').style.display = 'flex'
        if(e.target.classList.contains('fa-eye')) {
            e = e.target.parentNode
            data.append('mail', e.dataset.clientMail)
            data.append('site', e.dataset.site)
            data.append('id', e.dataset.clientId)
        } else {
           if(e.target.classList.contains('btn_open_modal')) {
            e = e.target
            data.append('mail', e.dataset.clientMail)
            data.append('site', e.dataset.site)
            data.append('id', e.dataset.clientId)
           } else {
            return
           }
        }
        const domEl = modal.querySelector('.card_events')
        domEl.innerHTML = ''

        fetch('/emailClientCard', {
            method: 'POST',
            body: data
        })
        .then(async res => {
            const response = await res.json()
            console.log(response);

            document.querySelector('.client_ym_id').textContent = ''
            
            const mail = response.clientMail
            const site = response.site
            const title = document.querySelector('.site_title')
            const titleMail = document.querySelector('.client_mail')
            const clientCode = document.querySelector('.client_code')
            title.textContent = site
            titleMail.textContent = mail

            for(let key in response.data) {

                if(key == 'invoice_sum') {
                    document.querySelector('.invoice_sum').textContent = response.data[key]
                    continue
                }
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
                                if(key == 'client_id') {
                                    document.querySelector('.'+key).innerHTML = object[key]  
                                    continue
                                }
                                if(key == 'client_code') {
                                    continue
                                }
                                if(key == 'client_mail') {
                                    continue
                                }
                                const p = document.createElement('p')
                                p.classList.add(key)
                                p.textContent = object[key]
                                card.appendChild(p)
                            }
                        } 
                       
                        if(key == 'yandex') {
                            cardTitle.textContent = key
                            const yandex = obj[key]
                                yandex['dimensions'].forEach((el, id) => {
                                    if(id == 0) {
                                        document.querySelector('.client_ym_id').textContent = ''
                                        document.querySelector('.client_ym_id').textContent = el['name']
                                    }
                                    for(key in el) {
                                        if(id == 0) {
                                            continue
                                        }
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
                document.querySelector('.loader_block').style.display = 'none'
                domEl.appendChild(cardGroup)
            }
        })
        .catch(err => {
            console.log(err);
        })
        if(e.classList.contains('btn_open_modal')) {
            modal.style.display = "block"
        }
            
    });

})

