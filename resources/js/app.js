window.onload = () => {
    'use strict';
    console.log('to aqui carai')
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker
            .register('./sw.js');
    }
}
require('./bootstrap');


