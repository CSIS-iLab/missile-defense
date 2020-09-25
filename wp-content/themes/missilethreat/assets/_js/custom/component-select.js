let systemSubmit = document.querySelector('#system-select-go')
let missileSubmit = document.querySelector('#missile-select-go')

if (missileSubmit) {
  missileSubmit.addEventListener(
    'click',
    function () {
      let missileSelection = document.querySelector('#missile-select').value

      window.location.href = missileSelection
    },
    false
  )
}

if (systemSubmit) {
  systemSubmit.addEventListener(
    'click',
    function () {
      let systemSelection = document.querySelector('#system-select').value

      window.location.href = systemSelection
    },
    false
  )
}
