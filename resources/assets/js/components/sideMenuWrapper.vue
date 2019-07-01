<template>

    <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-closed " data-keep-expanded="false" data-auto-scroll="false" data-slide-speed="200" style="padding-top: 20px">


        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler">
                <span></span>
            </div>
        </li>
        <!-- END SIDEBAR TOGGLER BUTTON -->

        <!-- HEADER -->
        <!-- <li class="heading">
            <h3 class="uppercase">
                <span v-show="!isLoading">القائمة الرئيسية</span>
            </h3>
        </li> -->
        <!-- END HEADER -->

        <side-menu-item v-for="app in apps" :model="app" :key="app.id"></side-menu-item>

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
  
        created() {
            this.loadApps();
        }
        
    }
</script>