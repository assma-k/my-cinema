async function chargerSalles() {
    const reponse = await api.get('/backend/index.php');
    const salles = reponse.data || reponse;

    if (!salles.length) {
        document.getElementById('roomsBody').innerHTML = '<tr><td colspan="5">Aucune salle</td></tr>';
        return;
    }

    document.getElementById('roomsBody').innerHTML = salles.map(s => `
        <tr>
            <td>${s.id}</td>
            <td>${s.name}</td>
            <td>${s.capacity}</td>
            <td>${s.type || '-'}</td>
            <td>
                <button class="btn btn-sm btn-warning" onclick="editerSalle(${s.id})">Modifier</button>
                <button class="btn btn-sm btn-danger" onclick="supprimerSalle(${s.id})">Supprimer</button>
            </td>
             <td>${s.createdAt || s.created_at || '-'}</td>
            <td>${s.updatedAt || s.updated_at || '-'}</td>
        </tr>
    `).join('');
}

document.getElementById('roomForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = document.getElementById('roomId').value;
    const data = {
        name: document.getElementById('name').value,
        capacity: parseInt(document.getElementById('capacity').value),
        type: document.getElementById('type').value,
        active: true,
        created_at: maintenant()
    };

    if (id) {
        await api.post(`/room/update/${id}`, data);
    } else {
        await api.post('/room/add', data);
    }

    document.getElementById('roomForm').reset();
    document.getElementById('roomId').value = '';
    chargerSalles();
});

async function editerSalle(id) {
    const salle = (await api.get(`/room/${id}`)).data;
    document.getElementById('roomId').value = salle.id;
    document.getElementById('name').value = salle.name;
    document.getElementById('capacity').value = salle.capacity;
    document.getElementById('type').value = salle.type;
}

async function supprimerSalle(id) {
    if (confirm('Supprimer ?')) {
        await api.get(`/room/delete/${id}`);
        chargerSalles();
    }
}

chargerSalles();