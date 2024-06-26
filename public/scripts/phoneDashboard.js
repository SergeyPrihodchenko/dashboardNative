window.addEventListener('DOMContentLoaded', () => {
  const phoneTbody = document.querySelector('.phone_tbody');
  const typeOption = document.querySelector('.type_option');
  const modal = document.getElementById("myModal");
  const span = document.getElementsByClassName("close")[0];
  const mainTable = document.querySelector('.block_table');

  let mainPage = 1

  maiPhoneRender(phoneTbody, mainPage)
  mainPage++

  mainTable.addEventListener('scroll', (e) => {

    const scrollTop = e.target.scrollTop
    const scrollHeight = e.target.scrollHeight;

    if(scrollTop > (scrollHeight / 2.5)) {
      maiPhoneRender(phoneTbody, mainPage, false)
      mainPage++
    }
  })

  phoneTbody.addEventListener('click', (e) => {

    if(e.target.classList.contains('btn_open_modal')) {
      const data = new FormData();
            data.append('phone', e.target.dataset.clientPhone)

            fetch('/phoneClientCard', {
                method: 'POST',
                body: data
            })
            .then(async res => {
                modal.style.display = "block"
                const data = await res.json()
                console.log(data);
                const clientMail = document.querySelector('.m_client_mail')

                clientMail.textContent = data.phone

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
})

  typeOption.addEventListener('change', (e) => {
      window.location.href = '/'+e.target.value
  });



  span.onclick = function() {
    modal.style.display = "none";
    mainPage = 1
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
      mainPage = 1
    }
  }

})


const maiPhoneRender = (domElem, page, clear = true) => {

  const data = new FormData
  data.append('page', page)

  fetch('/phoneDashboardData', {
      method: 'POST',
      body: data
  })
  .then(async res => {
      
      if(clear) {
        domElem.innerHTML = ''
      }

      const data = await res.json();
      console.log(data);
      data.clients.map((el) => {
      const tdLink = document.createElement('td');
      const tr = document.createElement('tr');

      tdLink.dataset.clientPhone = el.client_phone
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