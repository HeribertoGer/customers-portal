
<template>
  <div class="card shadow-lg p-1">
    <div class="card-header">
      <a
        href="/checklist:id"
        class="btn btn-outline-info btn-rounded float-left"
        ><i class="fas fa-arrow-circle-left">Back</i></a
      >
      <h2 class="card-title">CL Item <b v-text="userObj"></b></h2>
    </div>
    <div class="card-body">
      <div class="card-row">
        <div class="col border py-2">
          <p>Case & checklist info</p>
        </div>
        <div class="col border py-2">
          <p>CL info</p>
        </div>
      </div>
    </div>

    <div class="card-footer">
      <button
        type="button"
        class="btn btn-primary fas fa-edit float-right"
        @click="openModal('documents', 'store')"
      >
        New document
      </button>
    </div>

    <!-- Modal edit acount -->
    <template v-if="actionType == 1">
      <div
        class="modal fade"
        tabindex="-1"
        :class="{ mostrar: modal }"
        role="dialog"
        aria-labelledby="myModalLabel"
        style="display: none; overflow-y: auto"
        aria-hidden="true"
      >
        <div
          class="modal-dialog modal-primary modal-lg"
          style="padding-top: 55px"
          role="document"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" v-text="modalTitle"></h4>
              <button
                type="button"
                class="close"
                @click="closeModal()"
                aria-label="Close"
              >
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form
                enctype="multipart/form-data"
                class="form-horizontal"
              ></form>
              <div class="flex flex-wrap -m-2">
                <div class="p-2 w-full">
                  <div class="relative">
                    <label
                      for="attachment"
                      class="leading-7 text-sm text-gray-600"
                      >Attachments</label
                    ><br />
                    <vue-dropzone
                      ref="myVueDropzone"
                      id="dropzone"
                      :options="dropzoneOptions"
                      @vdropzone-complete="afterUploadComplete"
                      @vdropzone-sending-multiple="sendMessage"
                    ></vue-dropzone>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button
                v-if="actionType == 1"
                type="button"
                class="btn btn-primary fas fa-save"
                @click="shootMessage"
              >
                Save
              </button>
              <button
                type="button"
                v-if="actionType == 1"
                class="btn btn-danger"
                @click="closeModal()"
              >
                Close
              </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </template>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  data() {
    return {
      dropzoneOptions: {
        url: "/drive/upload",
        thumbnailWidth: 150,
        maxFilesize: 5,
        parallelUploads: 3,
        maxFiles: 3,
        uploadMultiple: true,
        autoProcessQueue: false,

        acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.pdf",
        addRemoveLinks: true,
        dictRemoveFile: "Remove file",
        headers: {
          "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content,
        },
      },

      id: "",
      user_id: "",
      title: "",
      description: "",
      url_files: "",
      expiry_date: "",
      issued_date: "",

      //
      userObj: {},
      modal: 0,
      modalTitle: "",
      actionType: 0,
      submitted: false,
      errors: {},
    };
  },
  components: {
    vueDropzone: vue2Dropzone,
  },
  mounted() {
    this.userFiles();
    //console.log("Component mounted.");
  },
  methods: {
    afterUploadComplete: async function (response) {
      if (response.status == "success") {
        console.log("upload successful");
        this.sendSuccess = true;
      } else {
        console.log("upload failed");
      }
    },
    shootMessage: async function () {
      this.submitted = true;
      this.errors = {};
      // this.valideForm();

      console.log(Object.keys(this.errors));
      if (Object.keys(this.errors).length) {
        console.log(this.errors);
        return;
      }

      console.log("done here");

      this.$refs.myVueDropzone.processQueue();

      let me = this;

      axios
        .post("/drive/upload", file)
        .then(function (response) {
          console.log({ response });
          me.closeModal();
          me.userFiles();
        })
        .catch(function (error) {
          console.table(error);
        });
    },
    sendMessage: async function (files, xhr, formData) {
      formData.append("email", this.email);
      formData.append("message", this.message);
      formData.append("recipient", this.recipient);
    },

    removedfile: function (file, respuesta) {
      console.log(file);

      const params = {
        imagen: file.nombreServidor,
        uuid: document.querySelector("#dropzone").value,
      };

      axios.post("/drive/delete", params).then((respuesta) => {
        console.log(respuesta);

        // Eliminar del DOM
        file.previewElement.parentNode.removeChild(file.previewElement);
      });
    },

    ////////////////////////
    userFiles() {
      let me = this;
      axios
        .get("/documents")
        .then(function (response) {
          console.log({ response });
          me.userObj = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    closeModal() {
      //Cerrar modals
      this.modal = 0;
      (this.title = ""),
        (this.description = ""),
        (this.expiry_date = ""),
        (this.issued_date = ""),
        //(this.active = false);

        (this.submitted = false);
      this.errors = {};
      this.userFiles();
    },

    //Validar campos requeridos
    valideForm() {
      if (!this.title) {
        this.errors.title = "Title field is required";
      }
      this.validateField("title");

      if (!this.description) {
        this.errors.description = "Description is required";
      }
      this.validateField("description");

      if (!this.issued_date) {
        this.errors.issued_date = "Issued date is required";
      }
      this.validateField("issued_date");
      if (!this.expiry_date) {
        this.errors.expiry_date = "Expiry date is required";
      }
      this.validateField("expiry_date");
    },
    validateField(field) {
      if ("" == this.field) {
        this.errors[field] = `El campo ${field} solo admite letras y guiones`;
      }
    },

    openModal(model, action, data = []) {
      //console.log(action);
      switch (model) {
        case "documents": {
          switch (action) {
            case "store": {
              //  / console.log(data);
              this.modal = 1;
              this.modalTitle = "Upload documents";

              this.title = data.title;
              this.description = data.description;
              this.expiry_date = data.expiry_date;
              this.issued_date = data.issued_date;
              this.actionType = 1;
              break;
            }
            case "update": {
              this.modal = 1;
              this.modalTitle = "Upload documents";
              this.title = data.title;
              this.description = data.description;
              this.expiry_date = data.expiry_date;
              this.issued_date = data.issued_date;
              this.id = data.id;
              this.actionType = 2;
              break;
            }
            case "update": {
              this.modal = 1;
              this.modalTitle = "Upload documents";
              this.title = data.title;
              this.description = data.description;
              this.expiry_date = data.expiry_date;
              this.issued_date = data.issued_date;
              this.id = data.id;
              this.actionType = 2;
              break;
            }
          }
        }
      }
    },
  },
};
</script>



