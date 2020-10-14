const hamburger = document.querySelector('.hamburger')
const menu = document.querySelector('.primary-menu')
const closeBtn = document.querySelector('.close-btn')

hamburger.addEventListener('click', () => {
  menu.classList.add('visible')
  closeBtn.classList.add('visible')
  hamburger.classList.add('invisible')
})

closeBtn.addEventListener('click', () => {
  menu.classList.remove('visible')
  closeBtn.classList.remove('visible')
  hamburger.classList.remove('invisible')
})