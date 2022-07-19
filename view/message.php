<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <link href="./style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="message">
        <h2>{{pagetitle}}</h2>
        <form @submit.prevent="handleInsertMessage">
                <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter message title" v-model="title" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Body</label>
                    <textarea class="form-control" id="body" rows="3" v-model="body" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Body</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="message of messages">
                        <td> {{message.id}}</td>
                        <td> {{message.title}}</td>
                        <td> {{message.body}}</td>
                        <td><button class="btn btn-info" @click="handleEdit(messages.id, message.title, message.body)">Edit</button>&nbsp;<button class="btn btn-danger" @click="handleDelete(message.id)">Delete</button></td>
                    </tr>                         
                </tbody>
        </table>
    </div>

    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"> </script>
    <script src="../vuejs/messages.js"></script>
</body>
</html>


