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

        if(e.target.classList.contains('btn_open_modal')) {
            modal.style.display = "block"
        }
            
    });

})

