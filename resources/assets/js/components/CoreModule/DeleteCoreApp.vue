<template>
    <transition name="modal">
        
        <div class="modal" style="display: block">
            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header">
                        <span v-show="isLoading"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span>
                        <slot name="header"></slot>
                        <div class="alert alert-success" v-if="savedSuccessfully">تم الحفظ بنجاح</div>
                        <div class="alert alert-danger" v-if="savingError">الرجاء مراجعة الأخطاء</div>
                    </div>
                    
                    <div class="modal-body">

                        <div class="row">
                            
                            <form @submit.prevent="deleteApp()" @keydown="form.errors.clear($event.target.name)">
                                
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-11"><h4>هل انت متأكد من عملية الحذف؟</h4></div>
                                </div>
                                
                                <div class="alert alert-danger" v-if="form.errors.has('message')">
                                    <strong>{{ form.errors.get('message') }}</strong>
                                </div>
                            
                            </form>
                            
                        </div>

                        <slot name="body"></slot>
                    
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-danger"  @click="deleteApp()">حذف</button>
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
                sharedData: CoreAppSharedData,
        };
    },

    created() {
        VueEventHandler.listen('DeleteCoreApp', (app) => {
            this.displayForm = true;
            this.savingError = false
            this.savedSuccessfully = false;
            this.form = new VueForm(app);
        });
    },
  
    methods: {
        
        deleteApp() {
            this.isLoading= true;
            this.form.submit('delete', '/core/apps/' + this.form.id)
               .then(success => {
                    this.savingError = false
                    this.savedSuccessfully = true;
                    VueEventHandler.fire('CoreAppDeleted', success.data);
                    this.isLoading= false;
               })
               .catch(errors => {
                    this.savingError = true;
                    this.isLoading = false;
                });
        }
    }

}
</script>
