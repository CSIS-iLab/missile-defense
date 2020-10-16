const hamburger = document.querySelector('.hamburger')
const menu = document.querySelector('.primary-menu')
const navClose = document.querySelector('.nav-close')
const logo = document.querySelector('.header__logo')
const searchIcon = document.querySelector('.header__search-icon')
const searchClose = document.querySelector('.header__search-close')
const searchForm = document.querySelector('.header__search')
const content = document.querySelector('#site-content')

hamburger.addEventListener('click', () => {
  menu.classList.add('visible')
  navClose.classList.add('visible')
  hamburger.classList.add('invisible')
})

navClose.addEventListener('click', closeNav)

searchIcon.addEventListener('click', () => {
  searchForm.classList.add('visible')
  searchIcon.classList.add('invisible')
  logo.classList.add('invisible')
  hamburger.classList.add('invisible')
  menu.classList.remove('visible')
  navClose.classList.remove('visible')
})

searchClose.addEventListener('click', () => {
  searchForm.classList.remove('visible')
  searchIcon.classList.remove('invisible')
  logo.classList.remove('invisible')
  hamburger.classList.remove('invisible')
})

searchClose.addEventListener('click', closeSearch)

content.addEventListener('click', closeNav)
content.addEventListener('click', closeSearch)

function closeNav() {
  menu.classList.remove('visible')
  navClose.classList.remove('visible')
  hamburger.classList.remove('invisible')
}

function closeSearch() {
  menu.classList.remove('visible')
  navClose.classList.remove('visible')
  searchForm.classList.remove('visible')
  searchIcon.classList.remove('invisible')
  logo.classList.remove('invisible')
  hamburger.classList.remove('invisible')
}