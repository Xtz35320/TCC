const express = require("express");
const cors = require("cors");
const fetch = (...args) =>
  import("node-fetch").then(({ default: fetch }) => fetch(...args));
const FormData = require("form-data");

const app = express();
app.use(cors());
app.use(express.json({ limit: "50mb" }));

const API_KEY = "2b10KaoMEL6NRIQn0pjHOciLO";

app.post("/identify", async (req, res) => {
  try {
    const { imageBase64 } = req.body;

    // Transforma o base64 em arquivo
    const buffer = Buffer.from(imageBase64, "base64");

    // Prepara envio como arquivo (PlantNet só aceita assim)
    const form = new FormData();
    form.append("images", buffer, { filename: "foto.jpg" });
    form.append("organs", "auto");

    const response = await fetch(
      `https://my-api.plantnet.org/v2/identify/all?api-key=${API_KEY}`,
      {
        method: "POST",
        body: form,
      }
    );

    const data = await response.json();
    res.json(data);

  } catch (err) {
    console.log(err);
    res.status(500).json({ error: "Erro ao identificar planta" });
  }
});

app.listen(3000, () => console.log("Servidor rodando"));