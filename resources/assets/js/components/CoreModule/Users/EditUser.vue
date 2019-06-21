<template>

    <div class="portlet light bordered">
        
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit"></i>
                <span class="caption-subject sbold">تعديل المستخدم</span>
            </div>
        </div>
        
        
        <div class="portlet-body form">
            
            <div class="form-body">

                <form @submit.prevent="UpdateUser()" @keydown="form.errors.clear($event.target.name)">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">هل انت متأكد من تعطيل هذا المستخدم؟</div>
                        </div>
                    </div>
                    
                </form>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn blue" @click="UpdateUser()">حفظ</button>
                <button type="submit" class="btn red" @click="undoAction()">تراجع</button>
            </div>

        </div>

    </div>


</template>


<script>

export default {

    props: {
        currentUser: Object
    },
    
    computed: {},
    
    data() {

        return {};
    },
  
    methods: {

        UpdateUser() {            
            axios.delete('/core/users/' + this.currentUser.id).then(response => {
                VueEventHandler.fire('UserUpdated', this.currentUser);
            });
        },

        undoAction() {
            VueEventHandler.fire('UndoAction', this.currentUser);
        },

    },
  
    created() {

    },
  
}
</script>
