document.addEventListener(
  'input',
  function (event) {
    // Only run on our select menu
    if (
      event.target.id !== 'system-select' &&
      event.target.id !== 'missile-select'
    )
      return

    window.location.href = event.target.value
  },
  false
)
