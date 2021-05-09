<template>
    <div class="modal fade" id="createCompany"  data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" :class="{'is-invalid': errors.hasError('name')}" v-model="company.name"
                                   class="form-control" placeholder="">
                            <div class="invalid-feedback" v-if="errors.hasError('name')">{{ errors.first('name') }}</div>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" :class="{'is-invalid': errors.hasError('email')}" v-model="company.email"
                                   class="form-control" placeholder="">
                            <div class="invalid-feedback" v-if="errors.hasError('email')">{{ errors.first('email') }}</div>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" :class="{'is-invalid': errors.hasError('phone')}" v-model="company.phone"
                                   class="form-control" placeholder="">
                            <div class="invalid-feedback" v-if="errors.hasError('phone')">{{ errors.first('phone') }}</div>
                        </div>
                        <div class="form-group">
                            <label>Website:</label>
                            <input type="text" :class="{'is-invalid': errors.hasError('website')}" v-model="company.website"
                                   class="form-control" placeholder="">
                            <div class="invalid-feedback" v-if="errors.hasError('website')">{{ errors.first('website') }}</div>
                        </div>
                    </div>

                    <div class="modal-footer" style = "padding-top: 0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="editCompany(company.id)" v-if="editing">Update Company</button>
                        <button type="button" @click="storeCompany()" class="btn btn-primary" v-else>Create Company</button>
                    </div>

                 </div>
        </div>
    </div>
</template>

<script>


    import ErrorBag from '../error_bag'

    class Company{

        constructor(company){

            this.name = company.name || '';
            this.email = company.email || '';
            this.phone = company.phone || '';
            this.website = company.website || '';
        }

    }

    export default {
        name: "StoreCompany",

        data(){

            return{

                editing: false,
                company: new Company({}),
                errors: new ErrorBag

            }
        },

        mounted(){

            this.$parent.$on('create_company', () => {

                this.editing = false;
                this.company = new Company({});
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createCompany').modal('show')


            });

            this.$parent.$on('edit_company', (company) => {

                this.editing = true;
                this.company = new Company(company);
                this.company.id = company.id;
                if (this.errors.hasErrors()) {
                    this.errors.clearAll();
                }
                $('#createCompany').modal('show')

            })

        },

        computed: {

            name(){

                return this.editing ? 'Edit Company' : 'Create Company'

            }

        },

        methods: {

            storeCompany(){


                this.$http.post('/admin/companies', this.company).then(res => {

                    this.$parent.$emit('add_company', res.data);
                    $('#createCompany').modal('hide')


                }).catch(err => {

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;
                        this.errors.setErrors(errors);
                    }
                    this.notifError( err.message || 'An error occurred')
                })

            },

            editCompany(id){

                this.$http.put(`/admin/companies/${id}`, this.company).then(res => {

                    this.$parent.$emit('update_company', res.data);
                    $('#createCompany').modal('hide')

                }).catch(err => {

                    if (err.response && err.response.status == 422) {
                        const errors = err.response.data.errors;
                        this.errors.setErrors(errors);
                    }
                    this.notifError( err.message || 'An error occurred')

                })

            }
        }
    }
</script>

<style scoped>

    textarea {
        height: 100px !important;
    }

</style>
