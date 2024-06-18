const mysql = require("mysql");

const connection = mysql.createConnection({
	host:'localhost',
	user:'root',
	password:'',
	database:'grubi-v2'
});

connection.connect((err) => {
	if(err) throw err;
	console.log("La conexión funciona");
});

class User {
	constructor(id, name, surname, email) {
		this._id = id;
		this._name = name;
		this._surname = surname;
		this._email = email;
	}

	get id() {
		return this._id;
	}

	set id(id) {
		this._id = id;
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

	addUser({id, name, surname, email}) {
		const newuser = new User(id, name, surname, email);
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
		connection.query('DELETE FROM clientes WHERE id = '. user.id, (err, rows) => {
			if(err) throw err;
			console.log("Los datos de la tabla son:");
			console.log(rows);
		});
	}

	updateUser(id, {name, surname, email}) {
		const user = this._users.find((user) => user.id === id);
		const sentencia = 'UPDATE `clientes` SET `nombre` = ' + name + ', `apellido` = ' + surname + ', `correo` = ' + email + ' WHERE `clientes`.`id_cliente` = ' + user.id;
		connection.query(sentencia, (err, rows) => {
			if(err) throw err;
			console.log("Los datos de la tabla son:");
			console.log(rows);
		});
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

const userManager = new UserManager();

connection.query('SELECT * FROM clientes', (err, rows) => {
	if(err) throw err;
	console.log("Los datos de la tabla son:");
	console.log(rows);
	rows.forEach(row => {
		userManager.addUser({id: row.id, name: row.nombre, surname: row.apellido, email: row.correo});
	});
});

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
	const btnShow = document.getElementById("btnShow");
	btnShow.addEventListener("click", () => {
		showUsersTable(userManager.showUsers(), userManager);
	});
});

connection.end();