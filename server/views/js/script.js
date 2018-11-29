document.addEventListener('DOMContentLoaded', () => {
  const listCont = document.querySelector('#questionList');
  if (!listCont) {
    return false;
  }
  const list = Array.from(listCont.querySelectorAll('.card'));

  list.forEach(card => {
    const showEl = card.querySelector('.show-answer');
    if(!showEl) {
      return;
    }
    showEl.addEventListener('click', e => {
      e.preventDefault();
      list.forEach(item => {
        item.querySelector('.answer').classList.add('d-none');
        item.querySelector('.show-answer').textContent = 'Посмотреть ответ';
      });
      const el = e.currentTarget;
      const answerCont = el.parentElement.parentElement.querySelector('.answer');
      if (el.dataset.isHide === 'true') {
        el.dataset.isHide = false;
        el.textContent = 'Показать ответ';
        answerCont.classList.add('d-none');
      } else {
        el.dataset.isHide = true;
        el.textContent = 'Скрыть ответ';
        answerCont.classList.remove('d-none');
      }
    })
  })
});
