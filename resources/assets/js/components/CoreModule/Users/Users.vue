<template>
    <div class="row">

        <div v-if="displayUsersData" class="portlet light bordered">

            <div class="portlet-title">
                
                <div class="caption">
                    <i class="fa fa-users"></i>
                    <span class="caption-subject sbold">المستخدمين</span>
                </div>
        
                <div class="actions">

                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <input type="submit" class="btn btn-primary" @click="showAddUserFormComponent()" value="اضافة مستخدم">
                    </div>
        
                </div>
            
            </div>

            <div class="portlet-body">

                <div v-if="userAddedSuccessfully">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success">تم اضافة المستخدم بنحاح</div>
                        </div>
                    </div>
                </div>

                <div v-if="userDisabledSuccessfully">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success">تم تعطيل المستخدم بنحاح</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="row col-md-4">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" v-model="searchInput" v-on:keyup="searchAction()" placeholder="البحث">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-scrollable">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الاسم</th>
                                <th>رقم الهوية</th>
                                <th>البريد الإلكتروني</th>
                                <th>رقم الجوال</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-show="isLoading">
                                <td colspan="6" class="text-center">
                                    <i class="fa fa-spinner fa-spin fa-fw"></i> جاري التحميل
                                </td>
                            </tr>

                            <tr v-for="user in usersData.data" v-bind:key="user.id">
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.national_id }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.phone_number }}</td>
                                <td>
                                    <a class="btn btn-xs btn-primary" @click="showEditUserComponent(user)"><i class="fa fa-edit"></i> تعديل</a>
                                    <a class="btn btn-xs btn-danger" @click="showDisableUserComponent(user)"><i class="fa fa-trash"></i> تعطيل</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        عدد المستخدمين: {{ usersData.total }}
                    </div>


                    <div v-show="this.nextUsersPageUrl" class="col-md-6">
                        <div class="pull-right">
                            <ul class="pagination">
                                <li class="prev">
                                    <a @click="loadPrevUsersData()"><i class="fa fa-angle-double-right"></i></a>
                                </li>
                                <li class="next">
                                    <a @click="loadNextUsersData()"><i class="fa fa-angle-double-left"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
            

        </div>

        <core-add-user v-show="displayAddUser" />
        <core-edit-user :currentUser="currentUser" v-show="displayEditUser" />
        <core-disable-user :currentUser="currentUser" v-show="displayDisableUserAction" />

    </div>
</template>


<script>

export default {
    props: {
        canCreateNewUser: String
    },
    
    data() {
        return {
            displayUsersData: true,
            displayDisableUserAction: false,
            displayAddUser: false,
            displayEditUser: false,

            userDisabledSuccessfully: false,
            userAddedSuccessfully: false,

            searchInput: '',
            currentUser: null,
            usersData: [],
            nextUsersPageUrl: null,
            prevUsersPageUrl: null,
        };
    },
    
    methods: {

        loadUsers(url) {
            this.isLoading = true;

            axios.get(url).then(response => {
                this.usersData = response.data;
                this.nextUsersPageUrl = response.data.next_page_url;
                this.prevUsersPageUrl = response.data.prev_page_url;
                this.isLoading = false
            });

        },

        loadPrevUsersData() {
            this.loadUsers(this.prevUsersPageUrl);
        },

        loadNextUsersData() {
            this.loadUsers(this.nextUsersPageUrl);
        },

        searchAction() {
            this.loadUsers('/core/users/search?search=' + this.searchInput)
        },

        showUsersDataComponent() {
            this.usersData = [];
            this.displayUsersData = true;
            this.displayDisableUserAction = false;
            this.displayAddUser = false;
            this.displayEditUser = false;

            this.loadUsers('/core/users');
        },

        showAddUserFormComponent() {
            this.displayAddUser = true;
            this.displayUsersData   = false;
            this.displayDisableUserAction = false;
            this.displayEditUser = false;
        },

        showEditUserComponent(user) {
            this.currentUser = user;

            this.displayEditUser = true;
            this.displayDisableUserAction = false;
            this.displayUsersData = false;
            this.displayAddUser = false;
        },

        showDisableUserComponent(user) {
            this.currentUser = user;

            this.displayDisableUserAction = true;
            this.displayUsersData = false;
            this.displayAddUser = false;
            this.displayEditUser = false;
        },

    },
  
    created() {

        this.loadUsers('/core/users');

        VueEventHandler.listen('UserAdded', (addedUserData) => {
            this.userAddedSuccessfully = true;
            this.userDisabledSuccessfully = false;
            this.searchInput = '';
            this.showUsersDataComponent();
        });

        VueEventHandler.listen('UserDisabled', (disabledUserData) => {
            this.userDisabledSuccessfully = true;
            this.userAddedSuccessfully = false;
            this.searchInput = '';
            this.showUsersDataComponent();
        });

        VueEventHandler.listen('UndoAction', (data) => {
            this.userDisabledSuccessfully = false;
            this.searchInput = '';
            this.showUsersDataComponent();
        });

    },

}
</script>
