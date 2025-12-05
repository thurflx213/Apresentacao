


</div>

<style>
/* =================================================================== */
/* 5. Rodapé (Footer) - Ajustado (Menor) */
/* =================================================================== */
.rodape {
    width: 100%;
    text-align: center;
    background-color: var(--cor-navbar); /* Preto escuro da navbar */
    color: var(--cor-texto-claro); /* Texto branco/cinza claro */
    padding: 10px 0; /* REDUZIDO: de 30px para 20px de padding vertical */
    margin-top: 20px; /* Reduzido um pouco o espaçamento acima também */
    font-size: 13px; /* REDUZIDO: Fonte base um pouco menor */
    border-top: 2px solid var(--cor-primaria);
    z-index: 1; 
}

.rodape h4 {
    font-family: var(--font-titulo);
    color: var(--cor-primaria);
    font-size: 1.5em; /* REDUZIDO: Título H4 um pouco menor */
    margin-bottom: 3px; /* Espaçamento menor */
    letter-spacing: 1px;
    text-transform: uppercase;
}

.rodape p {
    color: #999;
    margin: 0;
    padding-top: 3px; /* Espaçamento menor */
    font-size: 0.9em; /* REDUZIDO: Texto do parágrafo um pouco menor em relação à base do footer */
}

.rodape a {
    color: var(--cor-primaria);
    text-decoration: none;
    transition: color 0.3s ease;
}

.rodape a:hover {
    color: var(--cor-secundaria);
    text-decoration: underline;
}




</style>
  <footer class="rodape">
    <h4 style="color:white">Koketsu Store</h4>
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