
Vue.component('side-menu-wrapper', require('./components/sideMenuWrapper.vue').default);
Vue.component('side-menu-item', require('./components/sideMenuItem.vue').default);


Vue.component('core-app', require('./components/CoreModule/CoreApp.vue').default);
Vue.component('core-app-wrapper', require('./components/CoreModule/CoreAppWrapper.vue').default);
Vue.component('core-app-form', require('./components/CoreModule/CoreAppForm.vue').default);
Vue.component('delete-core-app', require('./components/CoreModule/DeleteCoreApp.vue').default);
Vue.component('attach-user-to-group', require('./components/CoreModule/AttachUserToGroup.vue').default);
Vue.component('permission-form', require('./components/CoreModule/PermissionForm.vue').default);
Vue.component('delete-permission', require('./components/CoreModule/DeletePermission.vue').default);


Vue.component('core-users', require('./components/CoreModule/Users/Users.vue').default);
Vue.component('core-add-user', require('./components/CoreModule/Users/AddUser.vue').default);
Vue.component('core-edit-user', require('./components/CoreModule/Users/EditUser.vue').default);
Vue.component('core-disable-user', require('./components/CoreModule/Users/DisableUser.vue').default);
