<template>
    {{translation}}
</template>


<script>
export default {
    props: ["trans"],
    created() {
        this.fetchTrans();
    },
    data() {
        return {
            translation: this.trans,
        };
    },
    methods: {
        fetchTrans(){
        //    testing
            // let value = this.$page.props.lang_data[this.trans];

            // if (typeof value !== 'undefined') {
            //     // checking if the translation found than use it.    
            //     this.translation = value;
            // }else{
            //     // storing the word in database that is not found.
            //     if (this.trans) {
            //         console.log(this.$page.props.lang_data['dUMMY TEXT']);
            //         console.log('comming log' + value);
            //         value = this.trans;
            //         axios.get(route('translate'),{ params: { value } });
            //     }

            // }
        },
    },
};
</script>