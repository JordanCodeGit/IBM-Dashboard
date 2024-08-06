let page_text = document.querySelector('.curr-salesman');
let prev_salesman = document.querySelector('.prev');
let next_salesman = document.querySelector('.next');
// let other = document.querySelector('.other');

const NextPage = () => {
    var temp = parseInt(page_text.textContent.charAt(-1));
    page_text.textContent = `Current page : ${temp + 1}`;
};

window.addEventListener('DOMContentLoaded', () => {

});
