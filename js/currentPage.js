let activePage = parseInt(document.getElementById('meta-data-page').textContent);
let activeIconArray = ['../../images/icons/search-selected.svg','../../images/icons/receipt-selected.svg', '../../images/icons/user-selected.svg' ]

console.log(activePage)

const footerElement = document.getElementsByTagName('footer')[0];
const footerChildElements = footerElement.children;
footerChildElements[activePage].classList.add('footer-box-active')
let footerIconElement = footerChildElements[activePage].getElementsByTagName('img');
let footerTextElement = footerChildElements[activePage].getElementsByTagName('p');
footerIconElement[0].src = activeIconArray[activePage]
footerTextElement[0].classList.add('text-color-4')