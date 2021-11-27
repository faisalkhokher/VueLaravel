<template>
    <div>
    <section class="content">
            <div class="row">
                <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Category</h3>

                   <router-link to="/category/addcategory">Add</router-link>

                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                        <th>ID</th>
                        <th>Category</th>
                       
                        </tr>
                        <tr>
                        <td>183</td>
                        <td>John Doe</td>
                        <td>11-7-2014</td>
                        <td><span class="label label-success">Approved</span></td>
                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                        </tr>
                    
                    </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
            </div>
    </section>
    </div>
</template>