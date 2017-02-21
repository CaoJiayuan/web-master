<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="animated fadeInUp well">
                    <div>Login</div>
                    <div class="panel-body">
                        <div role="form">
                            <div class="form-group label-floating">
                                <label for="email" class="control-label">E-Mail Address</label>
                                <input id="email" type="email" v-model="user.email"
                                       class="form-control" name="email" autofocus>
                                <label class="error" style="color: red" v-if="user.email == ''">Email is
                                    required</label>
                            </div>
                            <div class="form-group label-floating">
                                <label for="password" class="control-label">Password</label>
                                <input id="password" type="password" v-model="user.password"
                                       class="form-control" name="password">
                                <label class="error" style="color: red" v-if="user.password == ''">Password is
                                    required</label>

                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" v-on:click="login" class="btn btn-primary btn-raised">
                                        Login
                                    </button>
                                    <label class="error form-control-static" style="color: red" v-if="errorUser != ''">
                                        &nbsp;&nbsp; {{ errorUser }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default {
        created(){

        },
        data(){
            return {
                user: {
                    email: '',
                    password: ''
                },
                errorUser: ''
            }
        },
        components: {},
        methods: {
            login: function () {
                if (this.user.email == '' || this.user.password == '') {
                    return;
                }

                this.$http.post('/api/login', this.user).then(response => {
                    localStorage.setItem('jwt_token', response.data.token);
                    this.$router.push('/')
                }, response => {
                    if (response.status == 403) {
                        this.errorUser = response.data.error;
                    }
                })
            },
            logout: function () {
                localStorage.removeItem('jwt_token');
                this.$router.push('/login')
            },

        },
        mounted() {
            this.logout();
        },

    }
</script>
