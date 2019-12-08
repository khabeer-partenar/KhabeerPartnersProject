<template>

    <ul id="menu">
        <top-menu-item v-for="app in apps" :model="app" :key="app.id"></top-menu-item>
    </ul>

</template>

<script>
    export default {
        
        data() {
            return {
                apps: {},
                isLoading: false
            };
        },
  
        methods: {

            loadApps() {
                this.isLoading = true;
                axios.get('/core/authorized-apps').then(response => {
                    this.apps = response.data.data;
                    this.isLoading = false;
                });
            }

        },
  
        mounted() {
            this.loadApps();
        }
        
    }
</script>