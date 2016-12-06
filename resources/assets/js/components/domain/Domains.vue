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
          <tr>
            <td>1</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
          </tr>
          <tr class="info">
            <td>3</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
          </tr>
          <tr class="success">
            <td>4</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
          </tr>
          <tr class="danger">
            <td>5</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
          </tr>
          <tr class="warning">
            <td>6</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
          </tr>
          <tr class="active">
            <td>7</td>
            <td>Column content</td>
            <td>Column content</td>
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
      return {}
    },
    components: {},
    methods   : {},
    mounted(){

    },
    events    : {}
  }
</script>