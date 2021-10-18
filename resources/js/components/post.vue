<template>
  <div class="ml-1">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">POST</h3>
            <button type="button" class="btn btn-secondary ml-1" data-toggle="modal" data-target="#modal-secondary">
                    ADD     
                  </button>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" />
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>   
                        </button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade show" id="modal-secondary" style="display: none; padding-right: 17px" aria-modal="true" role="dialog" ref="MYMODEL">
            <div class="modal-dialog">
              <div class="modal-content bg-secondary">
                <div class="modal-header">
                  <h4 class="modal-title">Save Post</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                </div>
                <!-- FORM -->
                <form @submit.prevent="savePost">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" name="name" v-model="form.name" class="form-control" placeholder="" aria-describedby="helpId" />
                      <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                    </div>
                    <div class="form-group">
                      <label for="">Number</label>
                      <input type="text" name="number" value="" v-model="form.number" class="form-control" placeholder="" aria-describedby="helpId" />
                      <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                    </div>
                    <div class="col-12">
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
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="">Users</label>
                        <div class="form-group">
                          <label for=""></label>
                          <select class="custom-select" v-model="form.user_id">
                          <option
                            v-for="user in users"
                            :key="user.id"
                              v-bind:value="user.id">
                            {{ user.name }}
                          </option>                   
                        </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                            Close
                          </button>
                    <button type="submit" class="btn btn-outline-light">
                            Save changes
                          </button>
                  </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0" style="height: 300px">
            <table class="table table-head-fixed text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Number</th>
                  <th>User</th>
                  <th>Category</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="post in allposts" :key="post.id">
                  <td>{{ post.id }}</td>
                  <td>{{ post.name }}</td>
                  <td>{{ post.number }}</td>
                  <td>{{ post.users.name }}</td>
                  <td>{{ post.category.name }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      category: [],
      users: [],
      allposts: [],
      form: new Form({
        name: "",
        number: "",
        category_id: "",
        user_id: "",
      }),
    }),
    methods: {
      // Saving to fecth all posts
      savePost() {
        this.form.post("/api/save-post", this.data).then((rs) => {
          this.$Progress.start()
          this.fetchposts();
          this.$Progress.finish()
          this.$refs.MYMODEL.click();
          Toast.fire({
            icon: 'success',
            title: 'Saved'
          })
          
        });
      },
      // Function to fecth all posts
      async fetchposts() {
        await axios({
          method: "get",
          url: "/api/posts",
        }).then((rs) => {
          this.allposts = rs.data;
        });
      },
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
      // Fetch Posts on page load
      this.fetchposts();
    },
  };
</script>