const hamburger = document.querySelector('.hamburger')
const menu = document.querySelector('.primary-menu')
const navClose = document.querySelector('.nav-close')
const logo = document.querySelector('.header__logo')
const searchIcon = document.querySelector('.header__search-icon')
const searchClose = document.querySelector('.header__search-close')
const searchForm = document.querySelector('.header__search')
const content = document.querySelector('#site-content')
const header = document.querySelector('.header')

hamburger.addEventListener('click', () => {
  menu.classList.add('visible')
  navClose.classList.add('visible')
  hamburger.classList.add('invisible')
})

searchIcon.addEventListener('click', () => {
  searchForm.classList.add('visible')
  searchIcon.classList.add('invisible')
  logo.classList.add('invisible')
  hamburger.classList.add('invisible')
  menu.classList.remove('visible')
  menu.classList.add('invisible')
  navClose.classList.remove('visible')
})


function closeNav() {
  menu.classList.remove('visible')
  navClose.classList.remove('visible')
  hamburger.classList.remove('invisible')
}

function closeSearch() {
  searchForm.classList.remove('visible')
  searchIcon.classList.remove('invisible')
  logo.classList.remove('invisible')
  hamburger.classList.remove('invisible')
  menu.classList.remove('visible')
  menu.classList.remove('invisible')
  navClose.classList.remove('visible')
}

function headerColor() {
  if (window.scrollY >= 72) {
    header.classList.add('full-color')
  } else {
    header.classList.remove('full-color')
  }
}

navClose.addEventListener('click', closeNav)
content.addEventListener('click', closeNav)

searchClose.addEventListener('click', closeSearch)
content.addEventListener('click', closeSearch)

window.addEventListener('scroll', headerColor)