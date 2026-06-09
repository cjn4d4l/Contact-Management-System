<!DOCTYPE html>
<html lang="en">

<?php
include('C:\xampp\htdocs\Contact Management System\backend\db_connection.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        header {
            background-color: white;
            height: 100px;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1;
            border-bottom: solid 2px black;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            padding-left: 20px;
            padding-right: 20px;
        }

        nav {
            display: flex;
            gap: 10px;
        }

        .navBtns {
            background-color: white;
            border: solid 2px black;
            border-radius: 10px;
            width: 120px;
            height: 40px;
            margin: 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgb(244, 244, 244);
        }

        main {
            padding: 20px;
        }

        dialog {
            margin: 130px auto;
            width: 300px;
            height: 300px;
            border: solid 2px black;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .dialogInputs {
            width: 150px;
            height: 30px;
            margin: 10px;
        }

        .dialogbtns {
            margin: 10px;
            width: 150px;
            height: 30px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <h2>Contact Management System</h2>
        <nav>
            <button class="navBtns" onclick="showDialog('addDialog')">Add</button>
            <button class="navBtns" onclick="showDialog('deleteDialog')">Delete</button>
            <button class="navBtns" onclick="showDialog('about')">About</button>
        </nav>
    </header>
    <main>
        <p id="contacts">Contacts Go Here</p>
    </main>
    <dialog id="addDialog">
        <h3>Add a Contact</h3>
        <form id="addForm">
            <input class="dialogInputs" id="contact_name" type="text" placeholder="Enter Name"> <br>
            <input class="dialogInputs" id="contact_number" type="text" maxlength="11" placeholder="e.g 09123456789"> <br>
            <button class="dialogbtns">Add Contact</button> <br>
        </form>
        <button class="dialogbtns" onclick="closeModal('addDialog')">Cancel</button>
        <p id="message"></p>
    </dialog>
    <dialog id="deleteDialog">
        <h3>Delete a Contact</h3>
        <form id="deleteForm">
            <input class="dialogInputs" type="number" id="contact_id" placeholder="Contact ID Number"> <br>
            <button class="dialogbtns" id="deletebtn">Delete</button> <br>
        </form>
        <button class="dialogbtns" onclick="closeModal('deleteDialog')">Cancel</button>
        <p id="deleteMessage"></p>
    </dialog>
    <dialog id="about">
        <h3>About</h3>
        <p>A simple Contact Management System project built by CJ Nadal Tejolan</p> <br>
        <button class="dialogbtns" onclick="closeModal('about')">Close</button>
    </dialog>
    <script>
        function closeModal(id) {
            document.getElementById(id).close();
        }

        function showDialog(id) {
            document.getElementById(id).showModal();
        }

        function clearInputs () {
            document.getElementById("contact_name").value = "";
            document.getElementById("contact_number").value = "";
            document.getElementById("contact_id").value = "";
        }

        document.getElementById("addForm").addEventListener("submit", (e) => {
            e.preventDefault();
            let contact_name = document.getElementById("contact_name").value;
            let contact_number = document.getElementById("contact_number").value;
            console.log("Gumana");
            fetch('addContact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `contact_name=${encodeURIComponent(contact_name)}&contact_number=${encodeURIComponent(contact_number)}`
            })
            .then(Response => Response.text())
            .then(data => {
                document.getElementById("message").innerHTML = data;
            })
            clearInputs();
        })

        document.getElementById("deleteForm").addEventListener("submit", (e) => {
            e.preventDefault();
            const contact_id = document.getElementById("contact_id").value;
            console.log(contact_id);
            fetch('deleteContact.php',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `contact_id=${encodeURIComponent(contact_id)}`
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("deleteMessage").innerHTML = data;
            })
            clearInputs();
        })

        function renderContacts () {
            console.log("rendered");
            fetch('renderContact.php')
            .then(Response => Response.text())
            .then(data => {
                document.getElementById("contacts").innerHTML = data
            })
            setTimeout(renderContacts, 2000);
        }
        renderContacts();
    </script>
</body>

</html>