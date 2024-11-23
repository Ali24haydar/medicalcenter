/*=============== SHOW SOCIAL NETWORKS ===============*/

const showSocial = (toggleClass, socialClass) => {
    // Use querySelectorAll to select all elements with the specified classes
    const toggleButtons = document.querySelectorAll(`.${toggleClass}`);
    const socialCards = document.querySelectorAll(`.${socialClass}`);
  
    // Loop through all the toggle buttons and attach the event listeners
    toggleButtons.forEach((toggle, index) => {
      toggle.addEventListener('click', () => {
        const social = socialCards[index];
  
        // If the animation class exists, we add the down-animation class
        if (social.classList.contains('animation')) {
          social.classList.add('down-animation');
  
          // We remove the down-animation class after a delay
          setTimeout(() => {
            social.classList.remove('down-animation');
          }, 1000);
        }
  
        // We add the animation class to the element with the specified class
        social.classList.toggle('animation');
      });
    });
  }
  
  showSocial('card__social-toggle', 'card__social');


  let sideMenu = document.getElementById("sideMenu");
  let sidebar = document.getElementById("sidebar");

  sideMenu.addEventListener("click", () =>{
    sidebar.classList.toggle("open");
  });
  
