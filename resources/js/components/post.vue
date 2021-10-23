<template>
  <div class="ml-1">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">POST</h3>
            <button type="button" class="btn btn-secondary ml-1" data-toggle="modal" data-target="#modal-secondary"
            @click="addRecord"
            >
                        ADD NEW RECORD    
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
          <!-- Post create model -->
          <div class="modal fade show" id="modal-secondary" style="display: none; padding-right: 17px" aria-modal="true" role="dialog" ref="MYMODEL">
            <div class="modal-dialog">
              <div class="modal-content ">
                <div class="modal-header">
                  <h4 class="modal-title">
                    {{ editMode ? "Update Post" : "Save Post" }}
                  </h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                </div>
                <!-- FORM -->
                <form @submit.prevent="editMode ? update() :savePost()">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" name="name" v-model="form.name" class="form-control" placeholder="" aria-describedby="helpId" />
                      <div style="color:red" v-if="form.errors.has('name')" v-html="form.errors.get('name')" class="color:red" />
                    </div>
                    <div class="form-group">
                      <label for="">Number</label>
                      <input type="text" name="number" value="" v-model="form.number" class="form-control" placeholder="" aria-describedby="helpId" />
                      <div style="color:red" v-if="form.errors.has('number')" v-html="form.errors.get('name')" />
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

                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="confirmed" v-model="form.confirmed" value="1">
                          <label class="form-check-label">Active</label>
                        </div>
                        
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="confirmed" v-model="form.confirmed" value="0" style="accent-color:#ff4d6e">
                          <label class="form-check-label">Deavtive</label>
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
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Post Edit modal -->
          <div class="modal fade show" id="modal-default" style="display: show; padding-right: 17px;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                  <p>One fine body…</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0" >
            <table class="table table-head-fixed text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Number</th>
                  <th>User</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(post , index) in allposts.data" :key="post.id">
                  <td>{{ post.id }}</td>
                  <td>{{ post.name }}</td>
                  <td>{{ post.number }}</td>
                  <td>{{ post.users.name }}</td>
                  <td>{{ post.category.name }}</td>
                  <td>
                    <div v-if="post.confirmed == 0">
                      <span class="badge badge-danger">Deactivated</span>
                    </div>
                    <div v-if="post.confirmed == 1">
                      <span class="badge badge-success">Active</span>
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success btn-sm" 
                    @click="editModal(post)"
                    >
                       Edit
                       </button>
                    <a class="btn btn-danger btn-sm" @click="deletePost(post.id)">Delete</a>
                    <router-link :to="'/edit/posts/' + post.id" class="btn btn-sm btn-info">Editing</router-link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <pagination :data="allposts" @pagination-change-page="getResults"></pagination>
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
      editMode: false,
      category: [],
      users: [],
      allposts: {},
      form: new Form({
        name: "",
        id: "",
        number: "",
        category_id: "",
        user_id: "",
        confirmed: "",
      }),
    }),
    methods: {
      getResults(page = 1) {
			axios.get('/api/posts?page=' + page)
				.then(response => {
					this.allposts = response.data;
				});
		   },
      resetFields() {
           this.form.name = "";
           this.form.number = "";
           this.form.category_id = "";
           this.form.user_id = "";
      },
      editModal(post) {    
        this.editMode = true;
        this.form.clear();
        this.form.reset();
        this.form.fill(post)
        $("#modal-secondary").modal("show");
         
      },
      addRecord() {
         this.form.reset();
        $("#modal-secondary").modal("show");
      },
      //! Saving a post API
      savePost() {
        this.editMode = false;
        this.form.post("/api/save-post", this.data)
        .then((rs) => {
          // ! Progress bar start
          this.$Progress.start()
           // ! Event call that post is created and then =>  event call all post function 
          this.$emit('created')
           // ! Progress end
          this.$Progress.finish()
           // ! Success Modal
          this.$refs.MYMODEL.click();
          this.resetFields();
          Toast.fire({
            icon: 'success',
            title: 'Post Saved successfuly'
          })
        });
      },

      // ! UpdatePost
      update() {
        console.log(this.form.id);
        this.editMode = true;
       this.form.put('/api/post/UpdatePost/'+this.form.id)
        .then((result) => {
          this.$Progress.start()
          this.$emit('updatePostEvnt')
          this.$Progress.finish()
          $("#modal-secondary").modal("hide");
        }).catch((err) => {
          
        });
      },
  
      //! Function to fecth all posts
      async fetchposts() {
        await axios({
          method: "get",
          url: "/api/posts",
        }).then((rs) => {
          this.allposts = rs;
        });
      },

      // ! Resirect Next Page To update records
     
      //! Func to dlt posts 
      async deletePost(id) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            // ! Axios Call to delete post
            axios({
              method: 'delete',
              url: '/api/dlt-post/' + id
            }).then((rs) => {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              // Call Custome emit that i was ensure the delete is call and then all posts api call
              this.$emit('deletePost')
            })
          }
        })
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
      // Fetch Posts on page load
      this.fetchposts();
      // Event call that new data is created
      this.$on('created', () => {
        // then POSTS MED CALL
        this.fetchposts();
        	this.getResults();
      })
      // Event call that data is dlted
      this.$on('deletePost', () => {
        this.fetchposts();
        	this.getResults();
      })

      this.$on('updatePostEvnt' , ()=> {
        this.fetchposts();
        	this.getResults();
      })
    },
    mounted() {
		// Fetch initial results
		this.getResults();
	},
  };
</script>