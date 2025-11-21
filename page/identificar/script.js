document.getElementById("form").addEventListener("submit", async (e) => {
  e.preventDefault();
  const file = document.getElementById("imagem").files[0];

  if (!file) {
    alert("Selecione uma imagem.");
    return;
  }

  let finalBlob = file;

  if (file.type === "image/webp") {
    finalBlob = await convertWebPToJpeg(file);
  }

  const reader = new FileReader();
  reader.onloadend = async () => {
    const base64 = reader.result.split(",")[1];

    const response = await fetch("http://localhost:3000/identify", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ imageBase64: base64 }),
    });

    const data = await response.json();
    console.log(data);

    mostrarResultados(data);
  };

  reader.readAsDataURL(finalBlob);
});

async function convertWebPToJpeg(file) {
  return new Promise((resolve) => {
    const img = new Image();
    img.onload = () => {
      const canvas = document.createElement("canvas");
      canvas.width = img.width;
      canvas.height = img.height;
      const ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0);

      canvas.toBlob(
        (blob) => resolve(blob),
        "image/jpeg",
        0.9
      );
    };
    img.src = URL.createObjectURL(file);
  });
}

// ----------------------------------------------------------
// EXIBIR RESULTADOS ORGANIZADOS
// ----------------------------------------------------------
function mostrarResultados(data) {
  const div = document.getElementById("resultado");
  div.innerHTML = "";

  if (!data || !data.results || data.results.length === 0) {
    div.innerHTML = "<p>Não foi possível identificar a planta.</p>";
    return;
  }

  // MELHOR RESULTADO
  const principal = data.results[0];
  const nomePrincipal = principal.species?.scientificName || "Desconhecida";
  const scorePrincipal = (principal.score * 100).toFixed(1);

  let html = `
    <h3> Melhor identificação</h3>
    <p><strong>Nome científico:</strong> ${nomePrincipal}</p>
    <p><strong>Probabilidade:</strong> ${scorePrincipal}%</p>
  `;

  // OUTRAS POSSIBILIDADES
  if (data.results.length > 1) {
    html += `<h3 style="margin-top:15px;"> Outras possibilidades</h3>`;

    for (let i = 1; i < data.results.length; i++) {
      const r = data.results[i];
      const nome = r.species?.scientificName || "Desconhecida";
      const score = (r.score * 100).toFixed(1);

      html += `
        <p>• <strong>${nome}</strong> — ${score}%</p>
      `;
    }
  }

  div.innerHTML = html;
}