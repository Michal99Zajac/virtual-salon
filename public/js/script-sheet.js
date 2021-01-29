const orderingSection = document.getElementById('sheet-ordering-person');
const myselfRadio = document.getElementById('self-visit');
const somebodyRadio = document.getElementById('someone-visit');

orderingSection.setAttribute('style', 'display: none');

myselfRadio.addEventListener('click', () => {
  orderingSection.setAttribute('style', 'display: none');
});

somebodyRadio.addEventListener('click', () => {
  orderingSection.setAttribute('style', 'display: flex');
});
