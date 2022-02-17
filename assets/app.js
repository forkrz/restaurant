/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application 
import './bootstrap';
 
global.$ = require("jquery")
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything 
const bootstrap =require('bootstrap');




const list = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
list.map((el) => {
  let opts = {
    animation: false,
  }
  if (el.hasAttribute('data-bs-content-id')) {
    opts.content = document.getElementById(el.getAttribute('data-bs-content-id')).innerHTML;
    opts.html = true;
  }
  new bootstrap.Popover(el, opts);  
})
