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
            regTitle: "Register User",
        }
    },
    methods: {
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
        async handleUserReg(){
            let input ={
                username: this.username,
                email: this.email,
                phoneno: this.phoneno,
                age: this.age,
                password: this.password,

            }
            console.log(input);
            const url = 'http://localhost/loadPDO/api/user/create.php'; 
            const options = {
                method: "POST",
                data: input,
                url
            }
            try {
                const response = await axios(options);
                swal(response.data);
                if (response.data.status === true) {
                    //console.log(response.status);
                    swal("Registration successful, Proceed to Login")
                    window.location.href= "../view/login.php"
                }else{
                    console.log(response.data);
                }
            }
            catch (error) {
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