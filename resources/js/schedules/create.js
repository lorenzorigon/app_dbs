const {value, next} = require("lodash/seq");
const services = document.getElementsByName('service');
let day = document.querySelector('#day');
const axios = require('axios').default;
let service = setService();
let parent = document.querySelector('div .card-body form .container .row.text-center');
let btnSubmit = document.querySelector('div #submit');

day.addEventListener('input', (day) => {
    this.day = day.target.value;
    setService();
});

function setService() {
    services.forEach(service => {
        if (service.checked === true) {
            this.service = service;
        }
    });
    req(this.service.value, this.day.value);
}
services.forEach( service => {
    service.addEventListener('click', defineService);
});


function defineService(service){
    this.service = service.target.attributes.value.nodeValue;
    req(this.service, day.value);
}

function req(service, day){
    axios.get('/schedule/appointments?service=' + service + '&day='+ day)
        .then(function (response) {
            // handle success
            loadHours(response.data);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });
}

function loadHours(hours){

    divParent = document.createElement('div');
    divParent.setAttribute('class', 'row');

    //limpar tela
    //parent.removeChild(divParent);

    for(let i = 0; i < hours.length; i++) {
        //criando os elementos
        let div = document.createElement('div');
        let input = document.createElement('input');
        let label = document.createElement('label');

        //definindo as propriedades dos elementos
        div.setAttribute('class', 'col-6');

        input.setAttribute('id' , i);
        input.setAttribute('type' , 'radio');
        input.setAttribute('name' , 'start_at_hour');
        input.setAttribute('value' , hours[i].hour);

        label.setAttribute('class', 'label');
        label.setAttribute('for', i);
        label.innerText = hours[i].hour;

        if(hours[i].filledByOther === true){
            label.setAttribute('class', 'danger');
        }else if (hours[i].filledByUser === true){
            label.setAttribute('class', 'success');
        }

        //definindo estrutura html
        div.appendChild(input);
        div.appendChild(label);

        //adicionar os botões na div interna
        divParent.appendChild(div);

    }
    //adicionando a div com os botões na tela
    parent.insertBefore(divParent, btnSubmit);
}







