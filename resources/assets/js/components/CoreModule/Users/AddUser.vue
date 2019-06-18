<template>

    <div class="portlet light bordered">
        
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-user"></i>
                <span class="caption-subject sbold">اضافة مستخدم</span>
            </div>
        </div>
        
        
        <div class="portlet-body form">
            
            <div class="form-body">

                <form @submit.prevent="saveUser()" @keydown="form.errors.clear($event.target.name)">

                    <div v-if="savingError">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger">الرجاء مراجعة الأخطاء</div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                            
                        <div class="col-md-4">
                            <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('main_department_id') }">
                                <label for="title" class="col-md-4 control-label">نوع الجهة</label>
                                <div class="col-md-8">
                                    <v-select
                                        :debounce="250"
                                        :options="mainDepartmentsTypes"
                                        placeholder=""
                                        :on-change="setMainDepartmentType"
                                        label="name">
                                    </v-select>
                                    <span class="help-block" v-if="form.errors.has('main_department_id')"><strong>{{ form.errors.get('main_department_id') }}</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('parent_department_id') }">
                                <label for="title" class="col-md-4 control-label">اسم الجهة</label>
                                <div class="col-md-8">
                                    <v-select
                                        :debounce="250"
                                        :options="parentDepartments"
                                        placeholder=""
                                        :on-change="setParentDepartmentType"
                                        label="name"
                                        :disabled="parentDepartments.length == 0">
                                    </v-select>
                                    <span class="help-block" v-if="form.errors.has('parent_department_id')"><strong>{{ form.errors.get('parent_department_id') }}</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('direct_department_id') }">
                                <label for="title" class="col-md-4 control-label">الإدارة</label>
                                <div class="col-md-8">
                                    <v-select
                                        :debounce="250"
                                        :options="directDepartments"
                                        placeholder=""
                                        :on-change="setDirectDepartmentType"
                                        label="name"
                                        :disabled="directDepartments.length == 0">
                                    </v-select>
                                    <span class="help-block" v-if="form.errors.has('direct_department_id')"><strong>{{ form.errors.get('direct_department_id') }}</strong></span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <br />

                    <div class="row">
                            
                        <div class="col-md-4">
                            <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('national_id') }">
                                <label for="title" class="col-md-4 control-label">رقم الهوية</label>
                                <div class="col-md-8">
                                    <input type="text" id="national_id" name="national_id" v-model="form.national_id" class="form-control">
                                    <span class="help-block" v-if="form.errors.has('national_id')"><strong>{{ form.errors.get('national_id') }}</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('name') }">
                                <label for="title" class="col-md-4 control-label">الإسم</label>
                                <div class="col-md-8">
                                    <input type="text" id="name" name="name" v-model="form.name" class="form-control col-md-12">
                                    <span class="help-block" v-if="form.errors.has('name')"><strong>{{ form.errors.get('name') }}</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('phone_number') }">
                                <label for="title" class="col-md-4 control-label">رقم الجوال</label>
                                <div class="col-md-8">
                                    <input type="number" id="phone_number" name="phone_number" v-model="form.phone_number" class="form-control col-md-12">
                                    <span class="help-block" v-if="form.errors.has('phone_number')"><strong>{{ form.errors.get('phone_number') }}</strong></span>
                                </div>
                            </div>
                        </div>
                        
                    </div>


                    <br />

                    <div class="row">
                            
                        <div class="col-md-4">
                            <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('email') }">
                                <label for="title" class="col-md-4 control-label">البريد الإلكتروني</label>
                                <div class="col-md-8">
                                    <input type="text" id="email" name="email" v-model="form.email" class="form-control col-md-12">
                                    <span class="help-block" v-if="form.errors.has('email')"><strong>{{ form.errors.get('email') }}</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('job_role_id') }">
                                <label for="title" class="col-md-4 control-label">الدور الوظيفي</label>
                                <div class="col-md-8">
                                    <v-select
                                        :debounce="250"
                                        :options="groupsTypes"
                                        placeholder=""
                                        :on-change="setGroupType"
                                        label="name">
                                    </v-select>
                                    <span class="help-block" v-if="form.errors.has('job_role_id')"><strong>{{ form.errors.get('job_role_id') }}</strong></span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </form>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn blue" @click="saveUser()" :disabled="isLoading">حفظ</button>
                <button type="submit" class="btn red" @click="undoAction()" :disabled="isLoading">تراجع</button>
            </div>

        </div>

    </div>


</template>


<script>
import vSelect from 'vue-select'

export default {
    components: {vSelect},
    props: {
        mainDepartmentsTypesUrl: String,
        parentDepartmentsTypesUrl: String,
        directDepartmentsTypesUrl: String,
        permissionsTypesUrl: String,
        storeUserUrl: String,
    },
    
    computed: {},
    
    data() {

        let vueFormField = {
            main_department_id: '',
            parent_department_id: '',
            direct_department_id: '',
            national_id: '',
            name: '',
            phone_number: '',
            email: '',
            job_role_id: '',
        }

        return {
            form: new VueForm(vueFormField),
            savingError: false,
            isLoading: false,
            mainDepartmentsTypes: [],
            parentDepartments: [],
            directDepartments: [],
            groupsTypes: [],
        };
    },
  
    methods: {
        
        loadRequiredValues() {
            this.isLoading = true;

            axios.get('/core/departments/0').then(response => {
                this.mainDepartmentsTypes = response.data;
            });

            axios.get('/core/users/groups').then(response => {
                this.groupsTypes = response.data;
            });

            this.isLoading = false;
        },

        setMainDepartmentType(department) {
            this.isLoading = true;

            axios.get('/core/departments/' + department.id).then(response => {
                this.parentDepartments = response.data;
                this.directDepartments = [];
                this.isLoading         = false;

                this.form.main_department_id = department.id;
            });
        },

        setParentDepartmentType(department) {
            this.isLoading = true;

            axios.get('/core/departments/' + department.id).then(response => {
                this.directDepartments = response.data;
                this.isLoading         = false;

                this.form.parent_department_id = department.id;
            });
        },

        setDirectDepartmentType(department) {
            this.form.direct_department_id = department.id;
        },

        setGroupType(group) {
            this.form.job_role_id = group.id;
        },

        saveUser() {            
            this.isLoading = true;
            
            this.form.submit('post', '/core/users')
                    .then(success => {
                        this.savingError = false;
                        this.isLoading = false;

                        VueEventHandler.fire('UserAdded', {});
                    })
                    .catch(errors => {
                        this.savingError = true;
                        this.isLoading = false;
                    });
        },


        undoAction() {
            VueEventHandler.fire('UndoAction', {});
        },

    },
  
    created() {
        this.loadRequiredValues();
    },
  
}
</script>
