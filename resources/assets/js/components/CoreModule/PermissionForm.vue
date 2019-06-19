<template>
    
    <transition name="modal">
        
        <div class="modal" style="display: block">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <span v-show="isLoading"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span>
                        <slot name="header"></slot>
                        <div class="alert alert-success" v-if="savedSuccessfully">تم الحفظ بنجاح</div>
                        <div class="alert alert-danger" v-if="savingError">الرجاء مراجعة الأخطاء</div>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            
                            <form @submit.prevent="savePermission()" @keydown="form.errors.clear($event.target.name)">

                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-11"><h4>هل انت متأكد من عملية اضافة الصلاحيات؟</h4></div>
                                </div>

                            </form>
                        </div>
                        
                        <slot name="body"></slot>
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-primary" @click="savePermission()">نعم</button>
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
            sharedData: CoreAppSharedData,
            permission: {},
            permissionableType: null,
            permissionableId: null,
            isLoading: false
        };
    },
  
    created() {

        VueEventHandler.listen('AddNewPermisison', (data) => {
            this.displayForm = true;
            this.savingError = false
            this.savedSuccessfully = false;
            this.permissionableType = data.permissionableType;
            this.permissionableId = data.permissionableId;
            var self = this;
            var attrs = {
                app_id: this.sharedData.selectedApp.id,
                permissionable_type: data.permissionableType,
                permissionable_id: data.permissionableId,
            };
            this.form = new VueForm(attrs);
        });
    },
  
    methods: {
        
        savePermission() {

            // create permission
            this.isLoading = true;
            var baseURL = '/core/' + this.permissionableType + '/' + this.permissionableId + '/permissions';
        
            this.form.submit('post', baseURL)
                .then(success => {
                    this.savingError = false
                    this.savedSuccessfully = true;
                    VueEventHandler.fire('NewPermissionAdded', success);
                    this.isLoading = false;
                })
                .catch(errors => {
                    this.savingError = true;
                    this.isLoading = false;
                });
        
        }
        
    }
}
</script>
