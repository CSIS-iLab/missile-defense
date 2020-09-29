document.addEventListener('DOMContentLoaded', function () {
  let itemSubmit = document.querySelector('#item-select-go')
  let itemSelect = document.querySelector('#item-select')

  if (itemSubmit) {
    itemSubmit.addEventListener('click', function () {
      window.location.href = itemSelect.value
    })
  }

  if (itemSelect) {
    itemSelect.addEventListener(
      'keypress',
      function (e) {
        if (e.key === 'Enter') {
          window.location.href = e.target.value
        }
      },
      false
    )
  }
})
