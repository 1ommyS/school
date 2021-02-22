document.querySelector('.for-whom').addEventListener('click', function (e) {
  if (e.target.classList.contains('details')) {
    e.target.previousElementSibling.classList.toggle('height-initial');
    if (e.target.textContent == 'Подробнее') {
      e.target.textContent = 'Свернуть';
    } else {
      e.target.textContent = 'Подробнее';
    }
    console.log(document.querySelectorAll('.height-initial').length);
    if (document.querySelectorAll('.height-initial').length == 1 || document.querySelectorAll('.height-initial').length == 2) {
      document.querySelector('.for-whom-row').classList.remove('row-flex');
    }
    else {
      document.querySelector('.for-whom-row').classList.add('row-flex');
    }
  }
})
document.querySelector('.faq').addEventListener('click', function (e) {
  if (e.target.closest('.panel-heading')) {
    e.target.closest('.panel-heading').querySelector('.fa-sort-down').classList.toggle('fa-sort-down-toggle');
  }
})