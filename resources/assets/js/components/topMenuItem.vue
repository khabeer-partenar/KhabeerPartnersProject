<template>

    <li v-bind:class="{ active: isActive }">

            <a v-if="hasChildren" href="javascript:;">{{ model.name }}</a>
            <a v-else :href="currentUrl">{{ model.name }}</a>

            <ul class="dropdown" v-show="hasChildren">
                <top-menu-item v-for="model in model.menu_children_recursive" :model="model" :key="model.id"></top-menu-item>
            </ul>
        </li>

</template>


<script>
export default {
    
    props: {
        model: Object
    },
  
    data() {
        return {
            open: false,
            hasChildActive: false,
            sharedData: CoreAppSharedData
        }
    },

    created() {
        if (this.isActive) {
            //console.log($("#" + this.model.parent_id).attr("class"));
            //console.log($(this.$options.parent).addClass('active'));
        }
    },

    computed: {
        
        hasChildren() {
            return this.model.menu_children_recursive && this.model.menu_children_recursive.length
        },

        currentUrl() {
            var protocol = location.protocol;
            var slashes = protocol.concat("//");
            var host = slashes.concat(window.location.hostname);
            return host + (location.port ? ':'+location.port: '') + "/" + this.model.frontend_path;
        },
                
        parentId() {
            return "side-menu-item-" + this.model.parent_id;
        },
   
        isActive() {
            var isCurrent =  (window.location.pathname) == ("/" + this.model.frontend_path);
     
            if (isCurrent || this.hasChildActive) {
                this.$options.parent.hasChildActive = true;
            }


            return (isCurrent || this.hasChildActive);
        }
    },

    methods: {
    }

}
</script>