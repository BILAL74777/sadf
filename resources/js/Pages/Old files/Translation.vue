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
            if (this.trans) {
                let value = this.trans;
                axios.get(route('api.translate'),{ params: { value } })
                .then((res) => {
                    this.translation = res.data;
                });
            }
        },
    },
};
</script>