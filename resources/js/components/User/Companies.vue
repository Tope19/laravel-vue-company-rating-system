<template>
    <section class="section bg-gray">

        <div class="container-fluid">

            <div class="row gap-y col-md-11 justify-content-lg-end">
                <div @change="getCompanies()" class="col-md-2 form-group mr-12" >
                    <label>Order By:</label>
                    <select class="form-control" v-model="query.orderBy">
                        <option value="">-- Select --</option>
                        <option value="name">Name</option>
                        <option value="avg_rating">Rating</option>
                    </select>
                </div>
                <div @change="getCompanies()" class="col-md-2 form-group">
                    <label>Sort By:</label>
                    <select class="form-control" v-model="query.sortBy">
                        <option value="desc">Descending</option>
                        <option value="asc">Ascending</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row col-md-10 col-sm-12  gap-y mx-auto" style="">
                <company :is_auth="is_auth" v-for="company in companiesData.data" :key="company.id" :company="company"  ></company>
                <br>
                <br>
                <nav class="flexbox mt-6 col-md-12">
                    <a class="btn btn-white" :class="{'disabled': companiesData.current_page === 1}"
                       @click="getCompanies(companiesData.current_page - 1)">
                        <i class="ti-arrow-left fs-9 mr-2"></i> Prev
                    </a>
                    <a class="btn btn-white" :class="{'disabled': companiesData.current_page === companiesData.last_page}"
                       @click="getCompanies(companiesData.current_page + 1)">
                        Next <i class="ti-arrow-right fs-9 ml-2"></i>
                    </a>
                </nav>
            </div>

        </div>
    </section>
</template>

<script>
import Company from "./Company";
export default {
    name: "Companies",

    props: ['is_auth'],

    components: {Company},

    data(){

        return {

            companiesData: {},
            query: {
                orderBy: '',
                sortBy: 'desc',
            }
        }
    },

    created() {
        this.getCompanies();
    },

    methods: {
        getCompanies(page) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            let query = '';
            if (this.query.orderBy){
                query = `&orderBy=${this.query.orderBy}&sortBy=${this.query.sortBy}`
            }
            this.$http.get('/companies?page=' + page + query)
                .then(response => {
                    this.companiesData = response.data;
                }).catch(err => {
                    // console.log(err)
            });
        }
    }
}
</script>

<style scoped>

</style>
