const button = document.getElementById('toggleButton');
    const contentElements = document.querySelectorAll('.myprofile');

    button.addEventListener('click', () => {
      contentElements.forEach(element => {
        element.classList.toggle('hidden');
      });

      // Update button text
      button.textContent = contentElements[0].classList.contains('hidden') 
        ? 'Show Content' 
        : 'Hide Content';
    });