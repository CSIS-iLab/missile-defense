const hamburger = document.querySelector('.hamburger')
const menu = document.querySelector('.primary-menu')
const nav = document.querySelector('.site-nav')
const navClose = document.querySelector('.nav-close')
const logo = document.querySelector('.header__logo')
const searchIcon = document.querySelector('.header__search-icon')
const searchClose = document.querySelector('.header__search-close')
const searchForm = document.querySelector('.header__search')
const content = document.querySelector('#site-content')
const header = document.querySelector('.header')
const entryHeader = document.querySelector('.page__header-title')

hamburger.addEventListener('click', () => {
  menu.classList.add('is-visible')
  nav.setAttribute('aria-expanded', true)
  navClose.classList.add('is-visible')
  hamburger.classList.add('is-invisible')
})

searchIcon.addEventListener('click', () => {
  searchForm.classList.add('is-visible')
  searchIcon.classList.add('is-invisible')
  logo.classList.add('is-invisible')
  hamburger.classList.add('is-invisible')
  menu.classList.remove('is-visible')
  menu.classList.add('is-invisible')
  searchIcon.setAttribute('aria-expanded', true)
  nav.setAttribute('aria-expanded', false)
  navClose.classList.remove('is-visible')
})


function closeNav() {
  menu.classList.remove('is-visible')
  nav.setAttribute('aria-expanded', false)
  navClose.classList.remove('is-visible')
  hamburger.classList.remove('is-invisible')
}

function closeSearch() {
  searchForm.classList.remove('is-visible')
  searchIcon.classList.remove('is-invisible')
  logo.classList.remove('is-invisible')
  hamburger.classList.remove('is-invisible')
  menu.classList.remove('is-visible')
  menu.classList.remove('is-invisible')
  navClose.classList.remove('is-visible')
  searchIcon.setAttribute('aria-expanded', false)
}

navClose.addEventListener('click', closeNav)
content.addEventListener('click', closeNav)

searchClose.addEventListener('click', closeSearch)
content.addEventListener('click', closeSearch)


const entryHeaderOptions = {
  rootMargin: '-172px 0px 0px 0px'
}

const entryHeaderObserver = new IntersectionObserver(function (entries, entryHeaderObserver) {
  entries.forEach(entry => {
    if (!entry.isIntersecting) {
      header.classList.add('full-color')
    } else {
      header.classList.remove('full-color')
    }
  })
}, entryHeaderOptions)

entryHeaderObserver.observe(entryHeader)