async function displayUsers() {
    const response = await fetch('/api/members');
    const data = await response.json();
    const tbody = document.querySelector('#userTable tbody');
    tbody.innerHTML = '';

    data.forEach(user => {
        const tr = document.createElement('tr');
        tr.dataset.id = user.id;

        const tdName = document.createElement('td');
        tdName.textContent = user.name;
        const tdEmail = document.createElement('td');
        tdEmail.textContent = user.email;
        const tdAge = document.createElement('td');
        tdAge.textContent = user.age;

        const tdActions = document.createElement('td');
        const editButton = document.createElement('button');
        editButton.textContent = 'Edit';
        editButton.onclick = () => editUser(user.id);
        
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.onclick = () => deleteUser(user.id);

        tdActions.appendChild(editButton);
        tdActions.appendChild(deleteButton);

        tr.appendChild(tdName);
        tr.appendChild(tdEmail);
        tr.appendChild(tdAge);
        tr.appendChild(tdActions);

        tbody.appendChild(tr);
    });
}

document.querySelector('#userForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const userId = document.querySelector('#userId').value;
    const name = document.querySelector('#name').value;
    const email = document.querySelector('#email').value;
    const age = document.querySelector('#age').value;
    const errorDiv = document.querySelector('#formError');
    
    if (!name || !email || !age) {
        errorDiv.textContent = 'All fields are required.';
        return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        errorDiv.textContent = 'Invalid email format.';
        return;
    }

    errorDiv.textContent = '';

    const userData = {
        name,
        email,
        age
    };

    let response;
    if (userId) {
        response = await fetch(`/api/members/${userId}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(userData),
        });
    } else {
        response = await fetch('/api/members', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(userData),
        });
    }

    const result = await response.json();
    if (response.ok) {
        clearForm();
        displayUsers();
    } else {
        errorDiv.textContent = result.message || 'Error occurred';
    }
});

async function editUser(id) {
    const response = await fetch(`/api/members/${id}`);
    const user = await response.json();
    document.querySelector('#userId').value = user.id;
    document.querySelector('#name').value = user.name;
    document.querySelector('#email').value = user.email;
    document.querySelector('#age').value = user.age;
    document.querySelector('#formTitle').textContent = 'Edit User';
}

async function deleteUser(id) {
    if (confirm('Are you sure you want to delete this user?')) {
        const response = await fetch(`/api/members/${id}`, { method: 'DELETE' });
        if (response.ok) {
            displayUsers();
        } else {
            alert('Failed to delete user');
        }
    }
}

function clearForm() {
    document.querySelector('#userForm').reset();
    document.querySelector('#userId').value = '';
    document.querySelector('#formTitle').textContent = 'Add User';
}

displayUsers();
