let films = [];
let salles = [];

async function chargerOptions() {
    const resFilms = await api.get('/movie');
    films = resFilms.data || resFilms;

    const resSalles = await api.get('/room');
    salles = resSalles.data || resSalles;

    document.getElementById('movie_id').innerHTML = '<option>Sélectionner...</option>' + 
        films.map(f => `<option value="${f.id}">${f.title}</option>`).join('');

    document.getElementById('room_id').innerHTML = '<option>Sélectionner...</option>' + 
        salles.map(s => `<option value="${s.id}">${s.name}</option>`).join('');
}

async function chargerSeances() {
    const reponse = await api.get('/screening');
    const seances = reponse.data || reponse;

    if (!seances.length) {
        document.getElementById('screeningsBody').innerHTML = '<tr><td colspan="5">Aucune séance</td></tr>';
        return;
    }

    document.getElementById('screeningsBody').innerHTML = seances.map(s => {
        const film = films.find(f => f.id === s.movie_id);
        const salle = salles.find(r => r.id === s.room_id);
        return `
            <tr>
                <td>${s.id}</td>
                <td>${film ? film.title : s.movie_id}</td>
                <td>${salle ? salle.name : s.room_id}</td>
                <td>${s.start_time}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editerSeance(${s.id})">Modifier</button>
                    <button class="btn btn-sm btn-danger" onclick="supprimerSeance(${s.id})">Supprimer</button>
                </td>
                 <td>${s.createdAt || s.created_at || '-'}</td>
            </tr>
        `;
    }).join('');
}

document.getElementById('screeningForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = document.getElementById('screeningId').value;

    const rawDate = document.getElementById('start_time').value;
    const dateSQL = rawDate.replace('T', ' ') + ':00';

    const data = {
        movie_id: parseInt(document.getElementById('movie_id').value),
        room_id: parseInt(document.getElementById('room_id').value),
        start_time: dateSQL,
        created_at: maintenant()
    };

    if (id) {
        await api.post(`/screening/update/${id}`, data);
    } else {
        await api.post('/screening/add', data);
    }

    document.getElementById('screeningForm').reset();
    document.getElementById('screeningId').value = '';
    chargerSeances();
});

async function editerSeance(id) {
    const seance = (await api.get(`/screening/${id}`));
 
    document.getElementById('screeningId').value = seance.id;
    document.getElementById('movie_id').value = seance.movie_id;
    document.getElementById('room_id').value = seance.room_id;
    if (seance.start_time) {
        document.getElementById('start_time').value = seance.start_time.replace(' ', 'T').substring(0, 16);
    }
}

async function supprimerSeance(id) {
    if (confirm('Supprimer ?')) {
        await api.get(`/screening/delete/${id}`);
        chargerSeances();
    }
}

chargerOptions();
chargerSeances();