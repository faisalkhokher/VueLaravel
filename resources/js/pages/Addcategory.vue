<template>
    <div>   
        <div class="card card-primary mt-1">
              <div class="card-header">
                <h3 class="card-title">Add Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="storeCategory()">
                <div class="card-body">
                
                
                    <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter" v-model="form.name">
                  </div>
        
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
    </div>
</template>

<script>
export default {
  data: () => ({
    form: new Form({
      name: '',
    })
  }),

  methods: {
    async storeCategory () {
      const response = await this.form.post('/api/store/category' , this.data)
       
    }
  }
}
</script>