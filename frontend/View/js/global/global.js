class API {
  constructor(baseUrl = "http://localhost:8000/backend") {
    this.baseUrl = baseUrl;
  }
  
  async get(endpoint) {
    const response = await fetch(
      `${this.baseUrl}/index.php?url=${endpoint}`
    );
    return await response.json();
  }

  async post(endpoint, data) {
    const response = await fetch(
      `${this.baseUrl}/index.php?url=${endpoint}`,
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      }
    );
    return await response.json();
  }
}

const api = new API();

function viderFormulaire(idFormulaire) {
  document.getElementById(idFormulaire).reset();
}

function maintenant() {
  const date = new Date();
  return date.toISOString().slice(0, 19).replace("T", " ");
}
