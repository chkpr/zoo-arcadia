import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';



console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');



let test = document.getElementsByClassName("stats");
for (let i = 0 ; i < test.length; i++) {
    test[i].addEventListener("click", function() {
        console.log(test.item(i).id);        
            });
};

const $ = require('jquery');
require('bootstrap');

var myCarousel = document.querySelector('#carousel-id');
var carousel = new bootstrap.Carousel(myCarousel, {interval:2000,wrap:false});