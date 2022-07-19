<!DOCTYPE html>
<html lang="en">
<head>
    <link href="./style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="user">
        <div>
            <form @submit.prevent="handleLogin">
                <h1>{{title}}</h1>
                <label>Email:</label>
                <input type="text" v-model="email" required>

                <label>Password:</label>
                <input type="password" v-model="password" required>

                <div class="submit">
                    <button>Login</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"> </script>
    <script src="../vuejs/user.js"></script>
</body>
</html>


