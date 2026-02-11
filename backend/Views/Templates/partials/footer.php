


</div>

<style>
/* =================================================================== */
/* 5. Rodapé (Footer) - Ajustado (Menor) */
/* =================================================================== */
.rodape {
    width: 100%;
    text-align: center;
    background-color: var(--bg-top); /* Usando a mesma cor da navbar para consistência */
    color: var(--text-main); /* Texto dinâmico conforme o tema */
    padding: 20px 0;
    margin-top: 40px; 
    font-size: 13px;
    border-top: 1px solid var(--border-color);
    z-index: 1; 
}

.rodape h4 {
    font-family: inherit;
    color: var(--text-main);
    font-size: 1.4em;
    margin-bottom: 5px;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-weight: 700;
}

.rodape p {
    color: var(--text-muted);
    margin: 0;
    padding-top: 5px;
    font-size: 0.9em;
}

.rodape a {
    color: var(--accent);
    text-decoration: none;
    transition: color 0.3s ease;
}

.rodape a:hover {
    color: var(--accent-hover);
    text-decoration: underline;
}




</style>
  <footer class="rodape">
    <h4>Koketsu Store</h4>
    <p>© 2025 Koketsu. Desenvolvido com <a href="https://www.w3schools.com/w3css/" target="_blank">HTML & CSS</a></p>
  </footer>

</div>

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