<template>
    <div class="container margin-top-70">
        <div class="col-xs-12">
            <h1>Events</h1>
            <div class="col-xs-6">
                <h2>Public Events</h2>
                <div class="input-group">
                    <input type="text" v-model="publicMessage" class="form-control" placeholder="Message">
                    <span class="input-group-btn">
                        <button v-on:click.prevent="sendPublic" class="btn btn-primary" type="button">Send</button>
                    </span>
                </div>
                <h3>
                    Log
                    <a class="btn btn-sm btn-default" href="#" v-on:click.prevent="clear('public')">Clear</a>
                </h3>
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr v-for="message in publicLog">
                            <td>
                                {{ message }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-6">
                <h2>Private Events</h2>
                <div v-if="isAuth">
                    <div class="input-group">
                        <input type="text" v-model="privateMessage" class="form-control" placeholder="Message">
                        <span class="input-group-btn">
                            <button v-on:click.prevent="sendPrivate" class="btn btn-primary" type="button">Send</button>
                        </span>
                    </div>
                    <h3>
                        Log
                        <a class="btn btn-sm btn-default" href="#" v-on:click.prevent="clear('private')">Clear</a>
                    </h3>
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr v-for="message in privateLog">
                                <td>
                                    {{ message }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else>
                    <em>Please login</em>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                publicMessage: null,
                privateMessage: null,
                publicLog: [],
                privateLog: []
            }
        },
        computed: {
            isAuth() {
                return this.$store.getters.isAuth
            }
        },
        mounted() {
            Echo.channel('public').listen('.message', (payload) => {
                this.publicLog.push(payload.message)
            })
            if(this.$store.getters.isAuth) {
                Echo.channel('private-user.' + this.$store.getters.getUser.id).listen('.message', (payload) => {
                    this.privateLog.push(payload.message)
                })
            }
        },
        methods: {
            sendPublic() {
                axios.post('/api/event/public', { message: this.publicMessage })
            },
            sendPrivate() {
                axios.post('/api/event/private', { message: this.privateMessage })
            },
            clear(logName) {
                if(logName == 'public') {
                    this.publicLog = []
                } else if (logName == 'private') {
                    this.privateLog = []
                }
            }
        }
    }
</script>