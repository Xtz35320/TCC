const modal = document.getElementById("pdfModal");
const modalIframe = document.getElementById("modalIframe");

function openPdfModal(pdfUrl) {
  modal.style.display = "block";
  modalIframe.src = pdfUrl;
}

const span = document.getElementsByClassName("close")[0];

span.onclick = function() {
  modal.style.display = "none";
  modalIframe.src = "";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    modalIframe.src = "";
  }
}



const description = document.querySelector(".tooltip");

document.querySelectorAll('path').forEach(path => {
  path.addEventListener('mouseover', e => {
    e.target.classList.add("enabled");
    description.classList.add("active");
    description.innerHTML = e.target.id;
  });

  path.addEventListener('mouseout', e => {
    e.target.classList.remove("enabled");
    description.classList.remove("active");
  });
});

// Move a tooltip com limite de tela
document.addEventListener('mousemove', e => {
  const tooltipWidth = description.offsetWidth;
  const tooltipHeight = description.offsetHeight;

  let x = e.pageX;
  let y = e.pageY - 50;

  if (x + tooltipWidth + 10 > window.innerWidth) {
    x = window.innerWidth - tooltipWidth - 10;
  }

  if (y + tooltipHeight + 10 > window.innerHeight) {
    y = window.innerHeight - tooltipHeight - 10;
  }

  description.style.left = x + "px";
  description.style.top = y + "px";
});


let indice = 0; // Começa na primeira imagem

  function mudarSlide(direcao) {
    const imagens = document.getElementById("imagens");
    const totalSlides = imagens.children.length;
    indice = (indice + direcao + totalSlides) % totalSlides;
    imagens.style.transform = `translateX(-${indice * 400}px)`;
  }

  window.addEventListener('scroll', function() {
    const menu = document.getElementById('menu');
    if (window.scrollY < 270) {
      menu.classList.add('topo'); // está no topo
    } else {
      menu.classList.remove('topo'); // rolou para baixo
    }
  });

  // Executa na carga inicial
  window.dispatchEvent(new Event('scroll'));


  