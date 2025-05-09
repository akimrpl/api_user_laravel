<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Members</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 50px auto;
            max-width: 600px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        form {
            margin-top: 20px;
        }

        input {
            margin: 5px;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center;">Manage Members</h1>


        <table id="userTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <h2 id="formTitle">Add Members</h2>
            <form id="userForm">
                <input type="hidden" id="userId">

                <label for="name">Name: </label>
                <input type="text" id="name" required><br><br>

                <label for="email">Email: </label>
                <input type="email" id="email" required><br><br>

                <label for="age">Age: </label>
                <input type="number" id="age" required><br><br>

                <button type="submit">Save</button>
                <div id="formError" class="error"></div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
