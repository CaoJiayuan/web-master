<template>
    <div class="container">
        <div class="panel panel-default animated fadeInUp">
            <div class="panel-heading">
                <h1>Domains</h1>
                <button class="add-domain btn btn-primary btn-raised" data-target="#add-domain" data-toggle="modal">Add
                    Domain
                </button>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Server name</th>
                        <th class="text-center">Listen</th>
                        <th class="text-center">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="info" v-for="(domain,index) in domains">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center"><a :href="'http://' + domain.name + ':' + domain.listen" v-bind:title="domain.path" target="_blank">{{ domain.name
                            }}</a></td>
                        <td class="text-center">{{ domain.listen }}</td>
                        <td class="text-center">
                            <button class="btn btn-info btn-raised btn-sm" style="margin: 0 5px">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-warning btn-raised btn-sm" style="margin: 0px;" v-on:click="deleteDomain(domain)"><i
                                    class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal inmodal fade" id="add-domain" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated bounceInDown">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title">Add a domain</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group label-floating">
                                    <label for="name" class="control-label">Name</label>
                                    <input id="name" type="text" v-model="domain.name"
                                           class="form-control" name="name" autofocus>
                                    <label class="error" style="color: red" v-if="error.name">{{ error.name[0]
                                        }}</label>
                                </div>

                                <div class="form-group label-floating">
                                    <label for="path" class="control-label">Path</label>
                                    <input id="path" type="text" v-model="domain.path"
                                           class="form-control" name="path">
                                    <label class="error" style="color: red" v-if="error.path">{{ error.path[0]
                                        }}</label>
                                </div>
                                <div class="form-group label-floating">
                                    <label for="listen" class="control-label">Listen</label>
                                    <input id="listen" type="number" v-model="domain.listen"
                                           class="form-control" name="listen" placeholder="Default 80">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer title-action">
                        <button class="btn btn-primary" v-on:click="postDomain">OK
                        </button>
                        <button class="btn btn-white" data-i18n="demo.button.cancel"
                                data-dismiss="modal">Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .add-domain {
        position: relative;
        float: right;
        top: -60px;
    }
</style>
<script type="text/ecmascript-6">

    export default{
        created(){

        },
        data(){
            return {
                domains: [
                    {
                        name: 'hello.dev',
                        listen: 80
                    },
                    {
                        name: 'foo.dev',
                        listen: 80
                    },
                    {
                        name: 'bar.dev',
                        listen: 8088
                    },
                    {
                        name: 'echo.dev',
                        listen: 80
                    }
                ],
                domain: {
                    listen: 80,
                    name: null,
                    path: null
                },
                error: {
                    path: '',
                    name: ''
                }
            }
        },
        components: {},
        methods: {
            postDomain: function () {
                let self = this;

                this.error = {};
                this.$http.post('/api/domains', this.domain).then(res => {
                    $('#add-domain').modal('hide');
                    self.domains.push(self.domain);
                }, response => {
                    if (response.status == 422) {
                        self.error = response.data;
                    }
                });
            },
            deleteDomain :function (data) {
                window.console.log(JSON.stringify(data));
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this domain config!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false,
                    html: false
                }, function(){
                    swal("Deleted!",
                        "Your config file has been deleted.",
                        "success");
                });
            }
        },
        mounted(){
            let self = this;

            this.$http.get('/api/domains').then(res => {
                self.domains = res.data;
            });
        },
        events: {}
    }
</script>