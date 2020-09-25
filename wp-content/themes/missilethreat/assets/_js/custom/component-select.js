let systemSubmit = document.querySelector('#system-select-go')
let systemSelect = document.querySelector('#system-select')
let missileSubmit = document.querySelector('#missile-select-go')
let missileSelect = document.querySelector('#missile-select')

if (systemSubmit) {
  systemSubmit.addEventListener(
    'submit',
    function () {
      let systemSelection = document.querySelector('#system-select').value

      window.location.href = systemSelection
    },
    false
  )
}

if (systemSelect) {
  systemSelect.addEventListener(
    'keypress',
    function (e) {
      if (e.key === 'Enter') {
        window.location.href = e.target.value
      }
    },
    false
  )
}

if (missileSubmit) {
  missileSubmit.addEventListener(
    'submit',
    function () {
      let missileSelection = document.querySelector('#missile-select').value

      window.location.href = missileSelection
    },
    false
  )
}

if (missileSelect) {
  missileSelect.addEventListener(
    'keypress',
    function (e) {
      if (e.key === 'Enter') {
        window.location.href = e.target.value
      }
    },
    false
  )
}
