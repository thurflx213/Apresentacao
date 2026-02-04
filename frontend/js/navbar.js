/**
 * Gerenciador de Navbar
 * Responsável pela interatividade da barra de navegação
 */

const NavbarManager = (() => {
  const navbar = document.querySelector('.navbar-homepage');
  const hamburger = document.querySelector('.hamburger');
  const navMenu = document.querySelector('.nav-menu');
  
  const init = () => {
    // Scroll effect
    window.addEventListener('scroll', handleScroll);
    
    // Mobile menu
    if (hamburger) {
      hamburger.addEventListener('click', toggleMenu);
    }
    
    // Close menu when clicking on a link
    if (navMenu) {
      navMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closeMenu);
      });
    }
    
    // Set active link
    setActiveLink();
    window.addEventListener('hashchange', setActiveLink);
  };
  
  const handleScroll = () => {
    if (window.scrollY > 50) {
      navbar?.classList.add('scrolled');
    } else {
      navbar?.classList.remove('scrolled');
    }
  };
  
  const toggleMenu = () => {
    hamburger.classList.toggle('active');
    navMenu.classList.toggle('active');
  };
  
  const closeMenu = () => {
    hamburger?.classList.remove('active');
    navMenu?.classList.remove('active');
  };
  
  const setActiveLink = () => {
    const navLinks = document.querySelectorAll('.nav-menu a');
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    
    navLinks.forEach(link => {
      const href = link.getAttribute('href');
      if (href === currentPage || (currentPage === '' && href === 'index.html')) {
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  };
  
  return {
    init
  };
})();

// Inicializar quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', () => {
  NavbarManager.init();
});
