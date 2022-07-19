let app = Vue.createApp({
    data() {
        return {
            title: "login",
            username: '',
            email: '',
            phoneno: '',
            age: '',
            password: '',
            authToken: '',
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
            const url = 'http://localhost/loadPDO/api/user/login.php';
            const options = {
                method: "POST",
                data: input,
                url
            }
            try {
                const response = await axios(options);
                swal(response.data.message);
                if (response.data.status) {
                    this.authToken = response.data.authtoken;
                    window.localStorage.setItem("authToken", response.data.authtoken);
                    //small delay to show message
                    window.location.href = "../view/message.php"
                }
                console.log(response.data);
            } catch (error) {
                console.log(error);
            }
        },
        getToken(){
            const token = window.localStorage.getItem("authToken");
            this.authToken = token;
        }
        
    },
    mounted() {
        this.getToken()
    },

})
app.mount("#user")