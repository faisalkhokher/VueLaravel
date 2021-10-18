<template>
  <div class="mt-4">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><strong>CRM</strong></h3>

            <button
              class="ml-2 btn btn-success"
              data-toggle="modal"
              data-target="#crm_modal"
              @click="showModel = true"
            >
              Add new record
            </button>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px">
                <input
                  type="text"
                  name="table_search"
                  class="form-control float-right"
                  placeholder="Search"
                />

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Text</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="blog in blogs" :key="blog.id">
                  <td>{{ blog.id }}</td>
                  <td>{{ blog.name | uppercase }}</td>
                  <td>{{ blog.text | allupercase }}</td>
                  <td>
                    <span v-if="blog.is_true == 0" class="text-danger"
                      >Non Activate</span
                    >
                    <span class="text-success" v-else="blog.is_true === 1">
                      Activate</span
                    >
                  </td>
                  <td>{{ blog.created_at }}</td>
                  <td>
                    {{ blog.date }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="crm_modal"
      ref="crm"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="createdCRM">
              <div class="form-group">
                <label for="">Name</label>
                <input
                  type="text"
                  name="name"
                  v-model="form.name"
                  class="form-control"
                  placeholder=""
                  aria-describedby="helpId"
                />
                <div
                  v-if="form.errors.has('name')"
                  v-html="form.errors.get('name')"
                />
              </div>
              <div class="form-group">
                <label for="">Comment</label>
                <textarea
                  rows=""
                  cols=""
                  class="form-control"
                  name="text"
                  v-model="form.text"
                ></textarea>
                <small id="helpId" class="text-muted"></small>
              </div>
              <div
                v-if="form.errors.has('text')"
                v-html="form.errors.get('text')"
              />
              <div class="form-group">
                <label for=""></label>

                <div class="form-check">
                  <label class="form-check-label">
                    <input
                      type="radio"
                      class="form-check-input"
                      name="is_true"
                      v-model="form.is_true"
                      id=""
                      value="1"
                    />
                    YES
                  </label>
                  <div
                    v-if="form.errors.has('is_true')"
                    v-html="form.errors.get('is_true')"
                  />
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input
                      type="radio"
                      class="form-check-input"
                      name="is_true"
                      v-model="form.is_true"
                      id=""
                      value="0"
                    />
                    No
                  </label>
                </div>

                <div
                  v-if="form.errors.has('is_true')"
                  v-html="form.errors.get('is_true')"
                />

                {{ form.is_true }}
              </div>

              <div class="form-group">
                <div class="form-group">
                  <label for="">Users</label>
                  <div class="form-group">
                    <label for=""></label>
                    <select class="form-control" v-model="form.category_id">
                      <option
                        v-for="user in categoies"
                        :key="user.id"
                        v-bind:value="user.id"
                      >
                        {{ user.name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                  Save changes
                </button>
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Close
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categoies: [],
      blogs: [],
      form: new Form({
        name: "",
        text: "",
        is_true: "",
        category_id: "",
      }),
    };
  },

  methods: {
    getuser() {
      axios.get("/api/users").then(
        function (res) {
          this.categoies = res.data;
        }.bind(this)
      );
    },

    createdCRM() {
      this.getuser();
      this.form.post("/api/save-blog", this.data).then((rs) => {
        this.fetchCrms();
      });
    },

    async fetchCrms() {
      await axios
        .get("/api/get-blog")
        .then((res) => {
          this.blogs = res.data;
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },

  beforeMount() {
    this.getuser();
  },

  created: function () {
    this.fetchCrms();
  },

  mounted() {},
};
</script>
