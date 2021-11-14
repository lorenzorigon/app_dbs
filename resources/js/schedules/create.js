const services = document.getElementsByName('service');
let day = document.querySelector('#day');
const axios = require('axios').default;
let parent = document.querySelector('div .card-body form .container .row.text-center');
let btnSubmit = document.querySelector('div #submit');
const loading = document.querySelector('#loading')
const appointmentsWrapper = document.getElementById('appointments-wrapper');

fetchAppointments()

day.addEventListener('input', fetchAppointments)

services.forEach( service => {
    service.addEventListener('click', fetchAppointments);
});

function fetchAppointments(service, day){
    const selecteService = document.querySelector('[name="service"]:checked').value;
    const selectedDay =  document.querySelector('#day').value;

    appointmentsWrapper.innerHTML = '';
    loading.style.display = 'flex';

    const params = {
        service: selecteService,
        day: selectedDay,
    }
    axios.get('/schedule/appointments', { params })
        .then(function (response) {
            // handle success
            loadHours(response.data);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .finally(function () {
            loading.style.display = 'none';
        });
}

function loadHours(hours){

    for(let i = 0; i < hours.length; i++) {
        //definindo as propriedades dos elementos
        const scheduleCheckButton = document.querySelector('#appointment-button-model').cloneNode(true)
        const input = scheduleCheckButton.querySelector('input')
        const label = scheduleCheckButton.querySelector('label')

        scheduleCheckButton.style.display = 'block'
        input.setAttribute('id' , i);
        input.setAttribute('value' , hours[i].hour);
        label.setAttribute('for', i);
        label.innerText = hours[i].hour;

        if(hours[i].filledByOther === true){
            label.setAttribute('class', 'danger');
        }else if (hours[i].filledByUser === true){
            label.setAttribute('class', 'success');
        }

        //adicionar os botões na div interna
        appointmentsWrapper.appendChild(scheduleCheckButton);
    }

    //adicionando a div com os botões na tela
    parent.insertBefore(appointmentsWrapper, btnSubmit);
}







