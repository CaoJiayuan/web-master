<template>
    <ul class="nav navbar-nav navbar-right">
        <li v-on:click="logout">
         <router-link to="/login">Logout</router-link>
        </li>
    </ul>
</template>
<script>
    export default {
        created(){

        },
        data(){
            return {

            }
        },
        components: {},
        methods: {

        },
        mounted() {

        },

    }
</script>
