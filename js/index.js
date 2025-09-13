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

document.querySelectorAll('path').forEach((el) =>
  el.addEventListener('mouseover', (event) => {
    event.target.className = ("enabled");
    description.classList.add("active");
    description.innerHTML = event.target.id;
  })
);

document.querySelectorAll('path').forEach((el) =>
  el.addEventListener("mouseout", () => {
    description.classList.remove("active");
  })
);

document.onmousemove = function (e) {
  description.style.left = e.pageX + "px";
  description.style.top = (e.pageY - 50) + "px";
}

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
