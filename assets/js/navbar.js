let menu = document.getElementById('menu-icon');
let menuIcon = document.querySelector('.menu-icon i');
let dropmenu = document.getElementById('drop');

menu.onclick = () =>{
  dropmenu.classList.toggle('open');
  const isOpen = dropmenu.classList.contains('open');

  menuIcon.classList = isOpen
  ? 'fa-solid fa-xmark'
  : 'fa-solid fa-bars'
};