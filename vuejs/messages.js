let app = Vue.createApp({
    data() {
        return {
            pagetitle: 'View Messages',
            id: '',
            title: '',
            body: '',
            messages: [],
        }
    },
    methods: {
        async handleInsertMessage() {
            const input = {
                title: this.title,
                body: this.body
            }
            let endpoint = ''
            let response = await axios.post(endpoint, input)
            swal(response.data);
            this.handleGetMessage()
        },
        async handleGetMessage(){
            let endpoint = 'http://localhost/loadPDO/api/message/getmessage.php'
            try {
                let response = await axios.get(endpoint)
                if (response) {
                    this.messages = response.data;
                    console.log(response.data);
                }
            } catch (error) {
                console.log(error);
            }
        },
        async handleDelete(id){
            //console.log(id);
            let input = {
                id: id
            }
            let endpoint = 'http://localhost/loadPDO/api/message/deletemessage.php'
            try {
                let response = await axios.post(endpoint, input)
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
        }
    },
    async mounted() {
        let endpoint = 'http://localhost/loadPDO/api/message/getmessage.php'
        try {
            let response = await axios.get(endpoint)
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