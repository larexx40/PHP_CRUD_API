let app = Vue.createApp({
    data() {
        return {
            title: "login",
            username: '',
            email: '',
            phoneno: '',
            age: '',
            password: '',
        }
    },
    methods: {
        async handleUserReg(){
            let input ={
                username: this.username,
                email: this.email,
                phoneno: this.phoneno,
                age: this.age,
                password: this.password,

            }
            let endpoint ='http://localhost/loadtask/src/services/insertUser.php'
            try {
                const response = await axios.post(endpoint, input);
                console.log(response.data);
            }
            catch (error) {
                console.log(error);
            }
            
        },
        async handleLogin(){
            let input = {
                email: this.email,
                password: this.password
            }
            let endpoint = 'http://localhost/loadPDO/api/user/login.php'
            try {
                const response = await axios.post(endpoint, input);
                swal(response.data.message);
                if (response.data.status) {
                    //small delay to show message
                    window.location.href = "../view/message.php"
                }
                console.log(response.data);
            } catch (error) {
                console.log(error);
            }
        }
        
    },
    mounted() {
        
    },

})
app.mount("#user")