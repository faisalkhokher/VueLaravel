<template>
    <div>
        <h1>EDIT</h1>
        <form @submit.prevent="updatePost">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" name="name" v-model="form.name" class="form-control" placeholder="" aria-describedby="helpId" />
                      <div style="color:red" v-if="form.errors.has('name')" v-html="form.errors.get('name')" class="color:red" />
                    </div>
                    <div class="form-group">
                      <label for="">Number</label>
                      <input type="text" name="number" value="" v-model="form.number" class="form-control" placeholder="" aria-describedby="helpId" />
                      <div style="color:red" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                    </div>
                    <div class="">
                      <div class="form-group">
                        <label for="customSelect">Category</label>
                        <select class="custom-select" id="category_id" v-model="form.category_id">
                              <option
                                v-for="cat in category"
                                :key="cat.id"
                                v-bind:value="cat.id">
                                {{ cat.name }}
                              </option>
                            </select>
                        <div style="color:red" v-if="form.errors.has('category_id')" v-html="form.errors.get('category_id')" />
                      </div>
                    </div>
                    <div class="">
                      <div class="form-group">
                        <label for="customSelect">Users</label>
                        <select class="custom-select" v-model="form.user_id">
                              <option
                                v-for="user in users"
                                :key="user.id"
                                  v-bind:value="user.id">
                                {{ user.name }}
                              </option>                   
                            </select>
                        <div style="color:red" v-if="form.errors.has('user_id')" v-html="form.errors.get('user_id')" />
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                Close
                              </button>
                    <button type="submit" class="btn btn-success">
                                Save changes
                              </button>
                  </div>
                </form>
    </div>
</template>

<script>
export default {
data: () => ({
     category: [],
      users: [],
      form: new Form({
        name: "",
        number: "",
        category_id: "",
        user_id: "",
      }),
    }),

    methods: {
      async  updatePost() {
        await this.form.put('/api/post/UpdatePost/'+this.$route.params.id);
        this.$router.push({name : "post"})
        }
    },

     created() {
      // Fetch Categories on page load
      axios({
        method: "get",
        url: "/api/fetchCategories",
      }).then((rs) => {
        this.category = rs.data;
      });
      // Fetch Users on page load
      axios({
        method: 'get',
        url: "/api/users",
      }).then((rs) => {
        this.users = rs.data;
      })
    
    },
    
mounted () {
//    console.log(this.$route.params.id);
axios({
    method:'get',
    url: '/api/find-single/post/' + this.$route.params.id,
}).then((rs) => {
    this.form.name = rs.data.name;
    this.form.number = rs.data.number;
    this.form.category_id = rs.data.category_id;
    this.form.user_id = rs.data.user_id;
})
}

}
</script>