<template>

    <transition name="modal">
        
        <div class="modal" style="display: block">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <span v-show="isLoading"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span>
                        <slot name="header"></slot>
                        <div class="alert alert-success" v-if="savedSuccessfully">
                            تم الحفظ بنجاح
                        </div>
                        <div class="alert alert-danger" v-if="savingError">
                            الرجاء مراجعة الأخطاء
                        </div>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">

                            <form @submit.prevent="saveApp()" @keydown="form.errors.clear($event.target.name)">
                                
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('name') }">
                                            <label for="title" class="col-md-2 control-label">الاسم</label>
                                            <div class="col-md-10">
                                                <input type="text" id="name" name="name" v-model="form.name" class="form-control">
                                                <span class="help-block" v-if="form.errors.has('name')"><strong>{{ form.errors.get('name') }}</strong></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                                <br/>
                                
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('resource_name') }">
                                            <label for="title" class="col-md-2 control-label">مسار تحكم الصلاحية</label>
                                            <div class="col-md-10">
                                                <input type="text" id="resource_name" name="resource_name" v-model="form.resource_name" class="form-control">
                                                <span class="help-block" v-if="form.errors.has('resource_name')"><strong>{{ form.errors.get('resource_name') }}</strong></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                                <br/>
                                
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('frontend_path') }">
                                            <label for="title" class="col-md-2 control-label">المسار في الموقع الخارجي</label>
                                            <div class="col-md-10">
                                                <input type="text" id="frontend_path" name="frontend_path" v-model="form.frontend_path" class="form-control">
                                                <span class="help-block" v-if="form.errors.has('frontend_path')"><strong>{{ form.errors.get('frontend_path') }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <br/>
                                
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('li_color') }">
                                            <label for="title" class="col-md-2 control-label">تغيير لون التصنيف</label>
                                            <div class="col-md-10">
                                                <input type="text" id="li_color" name="li_color" v-model="form.li_color" class="form-control">
                                                <span class="help-block" v-if="form.errors.has('li_color')"><strong>{{ form.errors.get('li_color') }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                <br/>
                                
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('icon') }">
                                            <label for="title" class="col-md-4 control-label">الأيقونة</label>
                                            <div class="col-md-8">
                                                <input type="text" id="icon" name="icon" v-model="form.icon" class="form-control">
                                                <span class="help-block" v-if="form.errors.has('icon')"><strong>{{ form.errors.get('icon') }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('sort') }">
                                            <label for="title" class="col-md-4 control-label">الترتيب</label>
                                            <div class="col-md-8">
                                                <input type="number" id="sort" name="sort" v-model="form.sort" class="form-control">
                                                <span class="help-block" v-if="form.errors.has('sort')"><strong>{{ form.errors.get('sort') }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group" v-bind:class="{ 'has-error': form.errors.has('displayed_in_menu') }">
                                            <label for="title" class="col-md-4 control-label">هل يظهر بالقائمة ؟</label>
                                            <div class="col-md-8">
                                                <input type="checkbox"  id="displayed_in_menu" name="displayed_in_menu" v-model="form.displayed_in_menu" class="form-control">
                                                <span class="help-block" v-if="form.errors.has('displayed_in_menu')"><strong>{{ form.errors.get('displayed_in_menu') }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </form>
                            
                        </div>
                    
                        <slot name="body"></slot>
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-primary"  @click="saveApp()" :disabled="isLoading">حفظ</button>
                        <slot name="footer"></slot>
                    </div>
                    
                </div>
            </div>
        </div>


    </transition>

</template>


<script>

export default {
    props: {
        model: Object
    },
    
    computed: {},
    
    data() {
        return {
            form: new VueForm(this.model),
            savedSuccessfully: false,
            savingError: false,
            isLoading: false,
            sharedData: CoreAppSharedData
        };
    },
  
    created() {

        VueEventHandler.listen('AddNewCoreApp', (app) => {
            this.displayForm = true;
            this.savingError = false
            this.savedSuccessfully = false;
            var self = this;
            var attrs = {
                name: '',
                displayed_in_menu: 0,
                frontend_path: '',
                resource_name: '',
                li_color: '',
                icon: '',
                sort: 1,
                menu_type: 'side_menu',
                is_new_record: true,
                parent_id: this.sharedData.selectedApp.id
            };
            
            this.form = new VueForm(attrs);
        });

        VueEventHandler.listen('EditCoreApp', (app) => {
            this.displayForm = true;
            this.savingError = false
            this.savedSuccessfully = false;

            if (app.displayed_in_menu == "0") {
                app.displayed_in_menu = false;
            }

            this.form = new VueForm(app);
        });
    
    },
  
    methods: {
        
        saveApp() {
            // create task
            this.isLoading = true;
            
            if (this.form.is_new_record) {
                this.form.submit('post', '/core/apps')
                        .then(success => {
                            this.savingError = false
                            this.savedSuccessfully = true;
                            VueEventHandler.fire('NewCoreAppAdded', success.data);
                                this.isLoading = false;
                        })
                        .catch(errors => {
                            this.savingError = true;
                            this.isLoading = false;
                        });
            }
            else {
                this.form.submit('put', '/core/apps/' + this.form.id)
                        .then(success => {
                            this.savingError = false
                            this.savedSuccessfully = true;
                            VueEventHandler.fire('CoreAppUpdated', success.data);
                            this.isLoading = false;
                        })
                        .catch(errors => {
                            this.savingError = true;
                            this.isLoading = false;
                        });
            }

        }
  
    }
}
</script>
