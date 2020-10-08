document.addEventListener('DOMContentLoaded', function () {
  let currentURL = window.location.href.replace('https:', '')
  let currentHash = window.location.hash

  let chapters = document.querySelectorAll('.chapter')

  document.addEventListener('click', function () {
    chapters.forEach((chapter) => {
      let chapterHref = chapter.getAttribute('href')

      chapter.classList.remove('is-active')
      chapter.setAttribute('aria-current', 'false')

      if (chapterHref === currentHash || chapterHref === currentURL) {
        chapter.classList.toggle('is-active')
        chapter.setAttribute('aria-current', 'page')
      }
    })
  })
})
