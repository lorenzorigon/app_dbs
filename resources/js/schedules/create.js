const {value} = require("lodash/seq");
const services = document.getElementsByName('service');
let day = document.querySelector('#day');
const axios = require('axios').default;
let service = setService();

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
    hours.forEach((hour) => {
       console.log(hour);
    });
}







