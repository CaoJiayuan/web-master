<template>
  <div class="container">
    <div class="panel panel-default animated fadeInUp">
      <div class="panel-heading">
        <h1>Domains</h1>
        <button class="add-domain btn btn-primary" data-target="#add-domain" data-toggle="modal">Add Domain</button>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-hover ">
          <thead>
          <tr>
            <th>#</th>
            <th>Server name</th>
            <th>Listen</th>
            <th>Options</th>
          </tr>
          </thead>
          <tbody>
          <tr class="info" v-for="(domain,index) in domains">
            <td>{{ index + 1 }}</td>
            <td><a :href="'http://' + domain.name" target="_blank">{{ domain.name }}</a></td>
            <td>{{ domain.listen }}</td>
            <td>Column content</td>
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
                <div class="form-group">
                  <div class="col-sm-8">

                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-8">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer title-action">
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
        domains : [
          {
            name : 'hello.dev',
            listen : 80
          },
          {
            name : 'foo.dev',
            listen : 80
          },
          {
            name : 'bar.dev',
            listen : 8088
          },
          {
            name : 'echo.dev',
            listen : 80
          },
        ]
      }
    },
    components: {},
    methods   : {},
    mounted(){
      let self = this;
      this.$http.get('/api/domains').then(res => {
        self.domains = res.data;
      })
    },
    events    : {}
  }
</script>