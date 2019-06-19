<template>

    <li>
        <div :class="{bold: isFolder}" @dblclick="changeType">

            <span v-if="isFolder" @click="toggle">[{{open ? '-' : '+'}}]</span>
            <span @click="selectApp(model)" :class="{'selected-core-app': isSelected }"> {{model.name}} </span>
            <span v-show="hasPermission" class="has-permission"><i class="fa fa-check"></i></span>
            
            <div v-show="displayAppsMenu" class="core-app-selected-actions">
                <span class="fa fa-plus core-app-selected-actions-add" @click="addChildApp(model)"></span>
                <span class="fa fa-pencil core-app-selected-actions-edit" @click="editApp(model)"></span>
                <span class="fa fa-trash-o core-app-selected-actions-delete" @click="deleteApp(model)"></span>
            </div>

            <div v-show="displayPermissionMenu" class="core-app-selected-actions">
                <span v-show="!currentPermission" class="fa fa-plus core-app-selected-actions-add" @click="addPermission(model)"></span>
                <span v-show="currentPermission" class="fa fa-trash-o core-app-selected-actions-delete" @click="deletePermission(currentPermission)"></span>
            </div>
        
        </div>
        
        <ul v-show="open" v-if="isFolder">
            <core-app class="core-app-item" v-for="model in model.children_recursive"
                :model="model"
                :key="model.id"
                :permissions="permissions"
                :is-permission="isPermission"
                :permissionable-type="permissionableType"
                :permissionable-id="permissionableId">
            </core-app>
        </ul>
    </li>

</template>


<script>
export default {
    
    props: {
        model: Object,
        permissions: Array,
        isPermission: String,
        permissionableType: String,
        permissionableId: String
    },
  
    data() {
        return {
            open: false,
            sharedData: CoreAppSharedData,
            currentModel: this.model
        }
    },

    created() {
        
        VueEventHandler.listen('NewCoreAppAdded', (app) => {
            if (this.isSelected) {
                this.model.children_recursive.push(app);
            }
        });
    
        VueEventHandler.listen('CoreAppUpdated', (app) => {
            if (this.isSelected) {
                this.currentModel = app;
            }
        });
    
    },
  
    computed: {
        
        displayPermissionMenu() {
            return this.isSelected && (this.isPermission == "true");
        },

        displayAppsMenu() {
            return this.isSelected && (this.isPermission != "true");
        },
        
        isSelected() {
            console.log(this.sharedData.selectedApp.id);
            console.log(this.model.id);
            return this.sharedData.selectedApp.id == this.model.id;
        },

        hasPermission() {
            return (this.currentPermission != false) &&(this.currentPermission.app_id == this.model.id)
        },
    
        currentPermission() {
            var currentPermission = false;
      
            for(var i = 0; i < this.permissions.length; i++) {
                if (this.permissions[i].app_id == this.model.id) {
                    currentPermission = this.permissions[i];
                    break;
                }
            }
        
            return currentPermission;
        },
    
        isFolder() {
            return this.model.children_recursive && this.model.children_recursive.length
        },
    
    },
  
    methods: {
        
        toggle() {
            if (this.isFolder) {
                this.open = !this.open
            }
        },

        changeType() {
            if (!this.isFolder) {
                Vue.set(this.model, 'children_recursive', [])
                this.addChild()
                this.open = true
            }
        },

        addChild() {
            this.model.children_recursive.push({
                name: 'New stuff'
            })
        },

        selectApp(app) {
            this.sharedData.selectedApp = app;
            VueEventHandler.fire('coreAppSelected', app);
            this.displayForm = true;
        },

        addChildApp(app) {
            VueEventHandler.fire('AddNewCoreApp', app);
        },
    
        editApp(app) {
            VueEventHandler.fire('EditCoreApp', app);
        },
    
        deleteApp(app) {
            VueEventHandler.fire('DeleteCoreApp', app);
        },
    
        addPermission(permission) {
            var data = { permissionableType: this.permissionableType, permissionableId: this.permissionableId };
            VueEventHandler.fire('AddNewPermisison', data);
        },
        
        deletePermission(permission) {
            VueEventHandler.fire('DeletePermission', permission);
        }

    }
}
</script>

<style>
.core-app-item {
    cursor: pointer;
}

.bold {
    font-weight: bold;
}

ul {
    padding-left: 1em;
    line-height: 1.5em;
    list-style-type: dot;
}

.selected-core-app {
    background-color: #3598dc;
    color: #fbf7f7;
    padding: 3px;
}

.core-app-selected-actions {
    color: #fbf7f7;
    padding: 1px;
}

.core-app-selected-actions-add {
    background-color: #32c5d2;
}

.core-app-selected-actions-edit {
    background-color: #8E44AD;
}

.core-app-selected-actions-delete {
    background-color: #e7505a;
}

span.has-permission {
    color: green;
}
</style>
