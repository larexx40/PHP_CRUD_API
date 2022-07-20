let app = Vue.createApp({
    data() {
        return {
            pageTitle: 'View Messages',
            id: '',
            title: '',
            body: '',
            messages: [],
            authToken: ''
        }
    },
    methods: {
        async handleInsertMessage() {
            const input = {
                title: this.title,
                body: this.body
            }
            const url = 'http://localhost/loadPDO/api/message/insertmessage.php';
            const options = {
                method: "POST",
                headers: { "Authorization": `Bearer ${this.authToken}` },
                url,
                data: input,
            }
            try {
                let response = await axios(options)
                if (response) {
                    this.messages = response.data;
                    console.log(response.data);
                }
            } catch (error) {
                console.log(error);
            }
            swal(response.data);
            this.handleGetMessage()
        },
        async handleGetMessage(){
            const url = 'http://localhost/loadPDO/api/message/getmessage.php';
            const options = {
                method: "GET",
                headers: { "Authorization": `Bearer ${this.authToken}` },
                url
            }
            try {
                let response = await axios(options)
                if (response) {
                    this.messages = response.data;
                    console.log(response.data);
                }
            } catch (error) {
                console.log(error);
            }
        },
        async handleDelete(id){
            const url = 'http://localhost/loadPDO/api/message/deletemessage.php';
            const options = {
                method: "POST",
                headers: { "Authorization": `Bearer ${this.authToken}` },
                url
            }
            //console.log(id);
            let input = {
                id: id
            }
            //let endpoint = 'http://localhost/loadPDO/api/message/deletemessage.php'
            try {
                let response = await axios(endpoint, input)
                if (response) {
                    console.log(response.data);
                    swal(response.data);
                    this.handleGetMessage()
                }
            } catch (error) {
                console.log(error);
            }
        },
        async handleEdit(id, title, body){
            this.id =id;
            this.title =title;
            this.body = body;
        },
        getToken(){
            const token = window.localStorage.getItem("authToken");
            //console.log(token);
            this.authToken = token;
        }
    },
    async mounted() {
        this.getToken();
        console.log(this.authToken);
        let url = 'http://localhost/loadPDO/api/message/getmessage.php'
        const options = {
            method: "GET",
            headers: { "Authorization": `Bearer ${this.authToken}` },
            url
        }
        try {
            let response = await axios(options)
            if (response) {
                this.messages = response.data;
                console.log(response.data);
            }
        } catch (error) {
            console.log(error);
        }
        
    }
})
app.mount("#message")