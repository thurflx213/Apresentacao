/**
 * Gerenciador de Navbar
 * Responsável pela interatividade da barra de navegação
 */

const NavbarManager = (() => {
  const navbar = document.getElementById('navbar');

  const init = () => {
    window.addEventListener('scroll', handleScroll);
  };

  const handleScroll = () => {
    if (window.scrollY > 50) {
      navbar?.classList.add('scrolled');
    } else {
      navbar?.classList.remove('scrolled');
    }
  };

  const handleMobileSearch = () => {
    const searchInput = document.getElementById('globalSearch');
    if (window.innerWidth < 992 && searchInput) {
      searchInput.focus();
      // Se houver um container mobile oculto, ele poderia ser mostrado aqui
    }
  };

  return {
    init,
    handleMobileSearch
  };
})();

// Inicializar quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', () => {
  NavbarManager.init();
});
