document.addEventListener(
  'input',
  function (event) {
    // Only run on our select menu
    if (event.target.id !== 'component-select') return

    console.log(event.target.value)
    window.location.href = event.target.value
  },
  false
)
