<template>
    <div class="row">

        <span v-show="isLoading"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span>
        
        <core-app class="core-app-item"
            :model="apps"
            :permissions="permissions"
            :is-permission="isPermission"
            :permissionable-type="permissionableType"
            :permissionable-id="permissionableId">
        </core-app>
        
        <core-app-form v-show="displayForm"  :model="formModel">
            <span slot="footer">
                <button type="button" class="btn btn-danger" @click="displayForm=false">
                    اغلاق
                </button>
            </span>
        </core-app-form>
        
        <delete-core-app v-show="displayDeleteForm"  :model="formModel">
            <span slot="footer">
                <button type="button" class="btn btn-success" @click="displayDeleteForm=false">
                    لا
                </button>
            </span>
        </delete-core-app>

        <permission-form v-show="displayPermissionForm"  :model="formModel">
            <span slot="footer">
                <button type="button" class="btn btn-danger" @click="displayPermissionForm=false">اغلاق</button>
            </span>
        </permission-form>

        <delete-permission v-show="displayPermissionDeleteForm"  :model="formModel">
            <span slot="footer">
                <button type="button" class="btn btn-success" @click="displayDeleteForm=false">اغلاق</button>
            </span>
        </delete-permission>
        

    </div>
</template>


<script>
// To Share Data accross views
window.CoreAppSharedData = {
    selectedApp: {}
}

export default {
    props: ['permissionRouteUrl', 'isPermission', 'permissionableType', 'permissionableId'],
    
    data() {
        return {
            apps: {},
            formModel: {},
            displayForm: false,
            displayDeleteForm: false,
            displayPermissionForm: false,
            displayPermissionDeleteForm: false,
            isLoading: false,
            sharedData: CoreAppSharedData,
            permissions: []
        };
    },
    
    methods: {
        
        loadApps() {
            this.isLoading = true;

            axios.get('/core/apps').then(response => {
                this.apps = response.data.data[0];
                this.isLoading = false;
            });
        },
    
        loadPermissions() {
            if (this.isPermission == "true") {
                this.isLoading = true;
                axios.get(this.permissionRouteUrl).then(response => {
                    this.permissions = response.data;
                    this.isLoading = false;
                });
            }
        }
    
    },
  
    created() {

        VueEventHandler.listen('coreAppSelected', (app) => {
            this.sharedData.selectedApp = app;
        });
    
        VueEventHandler.listen('AddNewCoreApp', (app) => {
            this.displayForm = true;
        });

        VueEventHandler.listen('NewCoreAppAdded', (app) => {
            this.displayForm = false;
        });

        VueEventHandler.listen('EditCoreApp', (app) => {
            this.displayForm = true;
        });

        VueEventHandler.listen('CoreAppUpdated', (app) => {
            this.loadApps();
            this.displayForm = false;
        });

        VueEventHandler.listen('DeleteCoreApp', (app) => {
            this.displayDeleteForm = true;
        });

        VueEventHandler.listen('CoreAppDeleted', (app) => {
            this.loadApps();
            this.displayDeleteForm = false;
        });

        VueEventHandler.listen('AddNewPermisison', (app) => {
            this.displayPermissionForm = true;
        });

        VueEventHandler.listen('NewPermissionAdded', (permission) => {
            this.displayPermissionForm = false;
            this.permissions.push(permission);
        });


        VueEventHandler.listen('PermissionUpdated', (permission) => {
            for(var i = 0; i < this.permissions.length; i++) {
                if (this.permissions[i].id == permission.id) {
                    //this.permissions.splice(i, 1);
                    this.permissions[i] = permission;
                    this.permissions.push();
                    break;
                }
            }
            this.displayPermissionForm = false;
        });
    
        VueEventHandler.listen('DeletePermission', (permission) => {
            this.displayPermissionDeleteForm = true;
        });

        VueEventHandler.listen('PermissionDeleted', (permission) => {
            for(var i = 0; i < this.permissions.length; i++) {
                if (this.permissions[i].id == permission.id) {
                    this.permissions.splice(i, 1);
                    break;
                }
            } 
            this.displayPermissionDeleteForm = false;
        });
        
        this.loadApps();
        this.loadPermissions();
    },

}
</script>
