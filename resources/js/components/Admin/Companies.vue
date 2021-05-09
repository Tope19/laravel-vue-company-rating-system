<template>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="mb-4" style="position: absolute; right: 0; margin-bottom: 50px">
                    <button style="padding: 10px" @click="createCompany()" class="  btn btn-primary">
                        <i class="fas fa-plus" style="padding-right: 10px"></i>Add New Company
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive box-body">
                    <table class="table table-striped table-md">
                        <tbody><tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Website</th>
                            <th>Avg Rating</th>
                            <th>Created At</th>
                            <th colspan="2">Action</th>
                        </tr>
                        <tr v-for="company, key in companiesData.data">
                            <td>{{key+1}}</td>
                            <td>{{company.name}}</td>
                            <td>{{company.email}}</td>
                            <td>{{company.phone}}</td>
                            <td>{{company.website}}</td>
                            <td>{{company.avg_rating ? parseFloat(company.avg_rating).toFixed(2) : 0.00}}</td>
                            <td>{{company.formatted_date}}</td>
                            <td ><a class="cursor" @click="editCompany(company)"><i class="text-center fas text-primary fa-edit"></i></a></td>
                            <td><a :class="!company.has_rating ? 'cursor' : 'disabled'"
                                   @click="deleteCompany(company.id, key)">
                                <span class="text-center text-danger fas fa-trash" ></span>
                                </a>
                            </td>
                        </tr>
                        </tbody></table>
                </div>
            </div>
            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    <ul class="pagination mb-0">
                        <li class="page-item  cursor" :class="{'disabled': companiesData.current_page === 1}">
                            <a class="page-link"
                               @click="getCompanies(companiesData.current_page - 1)" tabindex="-1">
                                <i class="fas fa-chevron-left mr-3"></i>
                            Previous</a>
                        </li>
                        <li style="" class="page-item cursor" :class="{'disabled': companiesData.current_page === companiesData.last_page}">
                            <a class="page-link"
                               @click="getCompanies(companiesData.current_page + 1)" >
                                Next <i class="fas fa-chevron-right ml-3"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <store-company></store-company>
    </div>
</div>
</template>

<script>
import Swal from 'sweetalert'
import StoreCompany from "./StoreCompany";

export default {
    name: "Companies",

    components: {StoreCompany},

    data(){

        return {

            companiesData: {}
        }
    },


    mounted(){

        this.getCompanies()

        this.$on('add_company', (company) => {

            this.companiesData.data.unshift(company);
            this.notifSuceess('Company Created Successfully!!!')

        });


        this.$on('update_company', (company) => {

            const index = this.companiesData.data.findIndex(item => item.id === company.id);
            this.companiesData.data.splice(index, 1, company);

            this.notifSuceess('Company Updated Successfully!!')
        })
    },

    methods: {

        createCompany(){

            this.$emit('create_company');

        },

        editCompany(company){

            this.$emit('edit_company', company)

        },


        getCompanies(page) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            this.$http.get('/companies?page=' + page)
                .then(response => {
                    this.companiesData = response.data;
                }).catch(err => {
                // console.log(err)
            });
        },

        deleteCompany(id, key){

            Swal('Are you sure want to delete this company', {
                buttons: ['Oh no!', true]
            }).then(value => {
                if (value) {
                    this.$http.delete(`/admin/companies/${id}`).then(res => {

                        this.companiesData.data.splice(key, 1);
                        this.notifSuceess('Company Deleted Successfully');

                    }).catch(err => {

                        this.notifError( err.message || 'An error occurred')
                    })

                }
            })

        }

    }
}
</script>

<style scoped>
.fas{
    font-size: 20px;
}

.disabled {
    color: #aaa;
    cursor: not-allowed;
    opacity: 0.5;
    text-decoration: none;
}
</style>
