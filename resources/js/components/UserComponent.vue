<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-calendar">
                    <h4 class="card-title ">
                        Usuarios
                        <small class="float-sm-right">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#UserModal" data-json="null" > Nuevo  <i class="fa fa-plus-circle"></i> </button>
                        </small>
                    </h4>
                    </div>
                <vue-bootstrap4-table :classes="classes" :rows="users" :columns="columns" :config="config"  @on-change-query="onChangeQuery"  :totalRows="total_rows">
                    <template slot="sort-asc-icon">
                        <i class="fa fa-sort-asc"></i>
                    </template>
                    <template slot="sort-desc-icon">
                        <i class="fa fa-sort-desc"></i>
                    </template>
                    <template slot="no-sort-icon">
                        <i class="fa fa-sort"></i>
                    </template>
                    <template slot="option" slot-scope="props">
                        <a href="#" data-toggle="modal" data-target="#UserModal" @click="edit(props.row)" ><i class="fas fa-pen-square text-primary"></i></a>
                        <a href="#" v-if="!props.row.deleted_at"> <i class="fas fa-user-slash text-success " @click="deleteItem(props.row)"></i></a>
                        <a href="#" v-if="props.row.deleted_at"> <i class="fas fa-user text-danger "  @click='enabledItem(props.row)'></i></a>
                    </template>
                </vue-bootstrap4-table>
            </div>
        </div>
        <div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="ArticleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form id='formArticle' role="form">

                    <div class="modal-content">
                        <div v-html='csrf'></div>
						<input type="text" name="id" :value="form.id" v-if="form.id" hidden>
                        <div class="modal-header laravel-modal-bg">
                            <h5 class="modal-title" >{{title}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

							<div class="row">
                                <div class="form-group col-md-12">
                                    <label for="lbname">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" v-model="form.name" placeholder="Nombre">
                                    <!--<div class="invalid-feedback">{{ errors.first("name") }}</div>-->
                                    <span v-if="errors.name" class="text-danger">{{ errors.name[0] }}</span>
                                </div>
							</div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="lbname">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" v-model="form.email" placeholder="Email">
                                    <!--<div class="invalid-feedback">{{ errors.first("name") }}</div>-->
                                    <span v-if="errors.email" class="text-danger">{{ errors.email[0] }}</span>
                                </div>
							</div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="lbname">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" v-model="form.password" placeholder="Password">
                                    <!--<div class="invalid-feedback">{{ errors.first("name") }}</div>-->
                                    <span v-if="errors.password" class="text-danger">{{ errors.password[0] }}</span>
                                </div>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancelar</button>
                            <button type="submit" class="btn btn-success" @click.prevent='save()'>Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</template>

<script>
import VueBootstrap4Table from 'vue-bootstrap4-table';
import { ValidationProvider, extend } from 'vee-validate';
import { required } from 'vee-validate/dist/rules';
    export default {
        props:['url','csrf'],
        
        data:()=>({
            columns: [
                {
                    label: "Id",
                    name: "id",
                    filter: {
                        type: "simple",
                        placeholder: "Ingrese Id"
                    },
                    sort: true,
                },
                {
                    label: "Nombre",
                    name: "name",
                    filter: {
                        type: "simple",
                        placeholder: "Ingrese Nombre"
                    },
                    sort: true,
                },
                {
                    label: "Email",
                    name: "email",
                    filter: {
                        type: "simple",
                        placeholder: "Ingrese Correo"
                    },
                    sort: true,
                },
                {
                    label: "Opciones",
                    name: "option",
                    sort: false,
                }
            ],
            config: {
                checkbox_rows: false,
                rows_selectable: false,
                pagination: true,
                card_mode: false,
                show_refresh_button:  false,
                show_reset_button:  false,
                global_search:  {
                    placeholder:  "Enter custom Search text",
                    visibility:  false,
                    case_sensitive:  false
                },
                per_page_options:  [5,  10,  20,  30],
                server_mode:  true,
                loaderText: 'Updating...', // by default 'Loading...'
            },
            queryParams: {
                sort: [],
                filters: [],
                global_search: "",
                per_page: 10,
                page: 1,
            },
            total_rows: 0,
            showLoader: true,
            classes: {
                table : {
                    "table-striped " : false,

                },
            },
            users:[],
            form:{},
            title:'',
            errors: []
        }),
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            search() {
                axios.get('users/create', {
                    params: this.getParams(this.queryParams)
                })
                .then((response)=> {
                    console.log(response.data);
                    this.users= response.data.data;
                    this.total_rows =response.data.total;
                    this.showLoader = false;
                })
                .catch((error)=> {
                    console.log(error);
                });
            },
            onChangeQuery(queryParams) {
                this.showLoader = true;
                console.log(this.getParams(queryParams));
                this.queryParams = queryParams;
                this.search();
            },
            getParams (queryParams) {
                let params={};
                queryParams.filters.forEach(element => {
                    if(element.type=='simple'){
                        switch (element.name) {
                            default:
                                params[element.name] = element.text;
                            break;
                        }
                    }
                });
                params['page']=queryParams.page;
                params['pagination_rows']=queryParams.per_page;
                return params;
            },
            create(){
                this.form = {};
            },
            save(){
                console.log("GUARDANDO");
                axios.post(`users`,this.form)
                .then(response=>{
                    console.log(response);
                    $('#UserModal').modal('hide');
                    location.reload();
                })
                .catch((error)=>{
                    
                    if(error.response.status == 422){
                        console.log(error.response.data.errors);
                        this.errors = error.response.data.errors
                    }
                });
            },
            edit(user){
                console.log(user);
                axios.get(`users/${user.id}`).then(response=>{
                    this.form = response.data.user;
                    console.log(this.form);
                });
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                    let form = document.getElementById("formArticle");

                        form.submit();
                        return;
                    }
                    toastr.error('Debe completar la informacion correctamente')
                });
            },
            deleteItem(data){
                Swal.fire({
                title: 'Esta Seguro de Inactivar al usuario '+data.name+'?',
                text: "una vez inactivo el usuario n o podra ingresar al sistema!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
                }).then((result) => {
                if (result.value) {

                    axios.delete(`users/${data.id}`)
                        .then(response=>{
                            console.log(response);
                            location.reload();
                        })
                        .catch(error=>{
                            // handle error
                            Swal.fire(
                            'Error! contactese con soporte tecnico',
                            ''+error,
                            'error'
                            )
                            // console.log(error);
                        });
                }
                })

            },
            enabledItem(data){

            Swal.fire({
                title: 'Esta Seguro de Activar al usuario'+data.name+'?',
                text: "una vez activo el usuario podrá ingresar al sistema",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
                }).then((result) => {
                if (result.value) {

                    axios.get(`users/${data.id}/edit`)
                        .then(response=>{
                            console.log(response);
                            location.reload();
                        })
                        .catch(error=>{
                            // handle error
                            Swal.fire(
                            'Error! contactese con soporte tecnico',
                            ''+error,
                            'error'
                            )
                            // console.log(error);
                        });


                }
            })

        }
        },
        components: {
            VueBootstrap4Table,
            ValidationProvider
        },
    }
</script>