</div>
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-black">
    <h4>Koketsu Store</h4>
    <p>© 2025 Koketsu. Desenvolvido com <a href="https://getbootstrap.com" target="_blank" class="w3-text-theme">Bootstrap</a></p>
  </footer>

</div>

<script src="/frontend/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const mapBase = {
      'w3-container': ['container-fluid'],
      'w3-row-padding': ['row', 'g-3'],
      'w3-quarter': ['col-12', 'col-md-6', 'col-lg-3'],
      'w3-third': ['col-12', 'col-md-4'],
      'w3-half': ['col-12', 'col-md-6'],
      'w3-margin-bottom': ['mb-3'],
      'w3-padding': ['p-3'],
      'w3-padding-16': ['p-3'],
      'w3-padding-24': ['p-4'],
      'w3-padding-32': ['p-5'],
      'w3-small': ['btn-sm'],
      'w3-round': ['rounded'],
      'w3-round-medium': ['rounded'],
      'w3-round-large': ['rounded-3'],
      'w3-center': ['text-center'],
      'w3-left': ['float-start'],
      'w3-right': ['float-end'],
      'w3-clear': ['clearfix'],
      'w3-table': ['table'],
      'w3-striped': ['table-striped'],
      'w3-bordered': ['table-bordered'],
      'w3-border': ['border'],
      'w3-hoverable': ['table-hover'],
      'w3-responsive': ['table-responsive'],
      'w3-panel': ['card', 'p-3'],
      'w3-card-4': ['card', 'shadow-sm'],
      'w3-bar': ['d-flex', 'align-items-center'],
      'w3-bar-item': ['me-2'],
      'w3-hide-large': ['d-lg-none'],
      'w3-hide-small': ['d-none', 'd-sm-inline'],
      'w3-top': ['fixed-top', 'w-100']
    };

    const textMap = {
      'w3-text-red': 'text-danger',
      'w3-text-green': 'text-success',
      'w3-text-blue': 'text-primary',
      'w3-text-black': 'text-dark',
      'w3-text-white': 'text-white',
      'w3-text-theme': 'text-warning'
    };

    const buttonColorMap = {
      'w3-blue': 'btn-primary',
      'w3-red': 'btn-danger',
      'w3-green': 'btn-success',
      'w3-yellow': 'btn-warning',
      'w3-amber': 'btn-warning',
      'w3-orange': 'btn-warning',
      'w3-teal': 'btn-info',
      'w3-black': 'btn-dark',
      'w3-grey': 'btn-secondary',
      'w3-dark-grey': 'btn-secondary'
    };

    const bgMap = {
      'w3-blue': ['bg-primary', 'text-white'],
      'w3-red': ['bg-danger', 'text-white'],
      'w3-green': ['bg-success', 'text-white'],
      'w3-yellow': ['bg-warning', 'text-dark'],
      'w3-amber': ['bg-warning', 'text-dark'],
      'w3-orange': ['bg-warning', 'text-dark'],
      'w3-teal': ['bg-info', 'text-dark'],
      'w3-black': ['bg-dark', 'text-white'],
      'w3-grey': ['bg-secondary', 'text-white'],
      'w3-dark-grey': ['bg-secondary', 'text-white'],
      'w3-light-grey': ['bg-light', 'text-dark'],
      'w3-white': ['bg-white', 'text-dark']
    };

    document.querySelectorAll('[class*="w3-"]').forEach((el) => {
      const classes = Array.from(el.classList);

      classes.forEach((cls) => {
        if (mapBase[cls]) {
          mapBase[cls].forEach((b) => el.classList.add(b));
        }
        if (textMap[cls]) {
          el.classList.add(textMap[cls]);
        }
      });

      if (el.classList.contains('w3-button')) {
        el.classList.add('btn');
        classes.forEach((cls) => {
          if (buttonColorMap[cls]) {
            el.classList.add(buttonColorMap[cls]);
          }
        });
      } else {
        classes.forEach((cls) => {
          if (bgMap[cls]) {
            bgMap[cls].forEach((b) => el.classList.add(b));
          }
        });
      }
    });
  });
</script>
<script>
var mySidebar = document.getElementById("mySidebar");
var overlayBg = document.getElementById("myOverlay");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>