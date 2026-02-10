async function chargerFilms() {
  const reponse = await api.get("/movie");
  const films = reponse.data || reponse;

  if (!films.length) {
    document.getElementById("moviesBody").innerHTML =
      '<tr><td colspan="9">Aucun film</td></tr>';
    return;
  }

  document.getElementById("moviesBody").innerHTML = films
    .map(
      (f) => `
        <tr>
            <td>${f.id}</td>
            <td>${f.title}</td>
            <td>${f.description}</td>
            <td>${f.duration} min</td>
            <td>${f.release_year}</td>
            <td>${f.genre || "-"}</td>
            <td>${f.director}</td>
            <td>
                <button class="btn btn-sm btn-warning" onclick="editerFilm(${f.id})">Modifier</button>
                <button class="btn btn-sm btn-danger" onclick="supprimerFilm(${f.id})">Supprimer</button>
            </td>
            <td>${f.createdAt || f.created_at || "-"}</td>
            <td>${f.updatedAt || f.updated_at || "-"}</td>
        </tr>
    `,
    )
    .join("");
}

document.getElementById("movieForm").addEventListener("submit", async (e) => {
  e.preventDefault();
  const id = document.getElementById("movieId").value;
  const data = {
    title: document.getElementById("title").value,
    description: document.getElementById("description").value,
    duration: parseInt(document.getElementById("duration").value),
    release_year: parseInt(document.getElementById("release_year").value),
    genre: document.getElementById("genre").value,
    director: document.getElementById("director").value,
  };

  if (id) {
    await api.post(`/movie/update/${id}`, data);
  } else {
    await api.post("/movie/add", data);
  }

  document.getElementById("movieForm").reset();
  document.getElementById("movieId").value = "";
  chargerFilms();
});

async function editerFilm(id) {
  const film = await api.get(`/movie/${id}`);
  document.getElementById("movieId").value = film.id;
  document.getElementById("title").value = film.title;
  document.getElementById("description").value = film.description;
  document.getElementById("duration").value = film.duration;
  document.getElementById("release_year").value = film.release_year;
  document.getElementById("genre").value = film.genre;
  document.getElementById("director").value = film.director;
}

async function supprimerFilm(id) {
  if (confirm("Supprimer ?")) {
    await api.get(`/movie/delete/${id}`);
    chargerFilms();
  }
}

chargerFilms();
