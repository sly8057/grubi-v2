class User {
	constructor(name, surname, email) {
		this._name = name;
		this._surname = surname;
		this._email = email;
	}

	get name() {
		return this._name;
	}

	set name(name) {
		this._name = name;
	}

	get surname() {
		return this._surname;
	}

	set surname(surname) {
		this._surname = surname;
	}

	get email() {
		return this._email;
	}

	set email(email) {
		this._email = email;
	}
}

class UserManager {
	constructor(){
		this._users = JSON.parse(localStorage.getItem("users")) || [];
	}

	addUser({name, surname, email}) {
		const newuser = new User(name, surname, email);
		newuser.id =
				this._users.length > 0
				? this._users[this._users.length - 1].id + 1
				: 1;
		this._users.push(newuser);
		this.saveUsers();
		return newuser;
	}

	showUsers() {
		return this._users;
	}

	deleteUser(id) {
		this._users = this._users.filter((user) => user.id !== id);
		this.saveUsers();
	}

	updateUser(id, {name, surname, email}) {
		const user = this._users.find((user) => user.id === id);
		if(user) {
			user.name = name;
			user.surname = surname;
			user.email = email;
			this.saveUsers();
		}
	}

	saveUsers() {
		localStorage.setItem("users", JSON.stringify(this._users));
	}
}

function showUsersTable(users, userManager) {
	const usersTable = document.getElementById("usersTable");
	usersTable.innerHTML = "";

	if(users.length === 0) {
		usersTable.innerHTML = "<p>No hay usuarios registrados.</p>";
		return;
	}

	const table = document.createElement("table");
	const headerRow = table.insertRow();
	const headers = ["Nombre", "Apellido", "Correo", ""];

	headers.forEach((headerText) => {
			const th = document.createElement("th");
			th.textContent = headerText;
			headerRow.appendChild(th);
	});

	users.forEach((user) => {
			const row = table.insertRow();

			const cellName = row.insertCell();
			cellName.textContent = user.name;

			const cellSurname = row.insertCell();
			cellSurname.textContent = user.surname;

			const cellEmail = row.insertCell();
			cellEmail.textContent = user.email;

			const cell_ = row.insertCell();

			const btnDelete = document.createElement("button");
			btnDelete.textContent = "Eliminar";
			btnDelete.setAttribute( "class", "delete");
			btnDelete.addEventListener("click", () => {
					const confir = confirm(`Estás seguro de querer eliminar a ${user.name} ${user.surname}?`);
					if(confir) {
						userManager.deleteUser(user.id);
						showUsersTable(userManager.showUsers(), userManager);
					}
			});
			cell_.appendChild(btnDelete);

			const btnEdit = document.createElement("button");
			btnEdit.textContent = "Editar";
			btnEdit.setAttribute( "class", "edit");
			btnEdit.addEventListener("click", () => {
					const newName = prompt("Nuevo nombre:", user.name);
					const newSurame = prompt("Nuevo Apellido:", user.surname);
					const newEmail = prompt("Nuevo Correo:", user.email);
					if(newName && newSurame && newEmail) {
						userManager.updateUser(user.id, {
								name: newName,
								surname: newSurame,
								email: newEmail});
						showUsersTable(userManager.showUsers(), userManager);
					} else {
						alert("Ingresa todos los datos");
					}
			});
			cell_.appendChild(btnEdit);
	});

	usersTable.appendChild(table);
}

document.addEventListener("DOMContentLoaded", () => {
	const userManager = new UserManager();

	const btnAdd = document.getElementById("btnAdd");
	btnAdd.addEventListener("click", () => {
		const name = prompt("Ingresa el Nombre:");
		const surname = prompt("Ingresa el Apellido:");
		const email = prompt("Ingresa el Correo:");

		if (name && surname && email) {
			userManager.addUser({name: name, surname: surname, email: email});
		} else {
			alert("Debes ingresar todos los datos");
		}
	});

	const btnShow = document.getElementById("btnShow");
	btnShow.addEventListener("click", () => {
		showUsersTable(userManager.showUsers(), userManager);
	});
});