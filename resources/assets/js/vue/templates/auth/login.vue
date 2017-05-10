<template>
    <div class="container margin-top-70">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        <form id="login_form" v-on:submit.prevent="login">
                            <div class="form-group" :class="{ 'has-error': error }">
                                <label for="email">Email</label>
                                <input type="email" v-model="form.email" class="form-control" id="email" placeholder="Email" :disabled="loading" />
                            </div>
                            <div class="form-group" :class="{ 'has-error': error }">
                                <label for="password">Password</label>
                                <input type="password" v-model="form.password" class="form-control" id="password" placeholder="Password" :disabled="loading" />
                            </div>
                            <button type="submit" class="btn btn-default" :disabled="loading" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">Login</button>
                            <p v-if="error" class="bg-danger margin-top-10 padding-10">
                                <span v-if="error == 'login'">
                                    Email and/or password was incorrect. Please try again.
                                </span>
                                <span v-if="error == 'social'">
                                    Authentication failed. Please try again.
                                </span>
                            </p>
                        </form>
                        <hr />
                        <p class="text-center">Or</p>
                        <hr />
                        <div class="overlay overlay-container">
                            <a href="/api/auth/linkedin" class="margin-bottom-10 btn btn-block btn-social btn-facebook text-center" :disabled="loading">
                                <span class="fa fa-facebook"></span> Sign in with Facebook
                            </a>
                            <a href="/api/auth/linkedin" class="margin-bottom-10 btn btn-block btn-social btn-linkedin text-center" :disabled="loading">
                                <span class="fa fa-linkedin"></span> Sign in with LinkedIn
                            </a>
                            <a href="/api/auth/google" class="margin-bottom-10 btn btn-block btn-social btn-google text-center" :disabled="loading">
                                <span class="fa fa-google"></span> Sign in with Google
                            </a>
                            <a href="/api/auth/github" class="btn btn-block btn-social btn-github text-center" :disabled="loading">
                                <span class="fa fa-github"></span> Sign in with GitHub
                            </a>
                            <div v-if="loading == 'social'" class="overlay overlay-body text-center">
                                <loader></loader>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import loader from '../components/loader.vue'

    export default {
        components: { loader },
        data() {
            return {
                loading: false,
                error: false,
                form: { email: '', password: '' }
            }
        },
        computed: {
            user() { return this.$store.getters.getUser }
        },
        watch: {
            /**
            Watching the loading state to change login form submit button loading state
            */
            loading(value) {
                var button = $('#login_form button[type=submit]');
                if(value == 'login') {
                    button.button('loading')
                } else {
                    button.button('reset')
                }
            }
        },
        created() {
            if(this.$route.query.social) {
                this.loading = 'social'
                this.error = false
                this.$store.dispatch('socialAuth', this.$route.query).then(() => {
                    this.$router.push({ name: 'page.home' })
                }).catch(error => {
                    this.error = 'social'
                    this.loading = false
                })
            }
        },
        methods: {
            login() {
                //Setting loading to true
                this.loading = 'login'

                //Reset error
                this.error = false

                //Dispatch the authentication action with user input email and password
                this.$store.dispatch('auth', {
                    username: this.form.email,
                    password: this.form.password
                }).then(() => { //Success
                    //Redirect to admin page
                    this.$router.push({ name: 'page.home' })
                }).catch((error) => { //Error
                    //Setting error to true
                    this.error = 'login'

                    //Reseting loading
                    this.loading = false
                })
            }
        }
    }
</script>