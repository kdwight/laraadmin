<template>
  <div @click="chooseImage">
    <a href="#" class="btn btn-outline-dark" v-if="!source">Choose an Image</a>
    <input ref="fileInput" type="file" @input="onSelectFile" hidden />

    <label class="preview-container" v-if="source">
      <img :src="source" class="preview-image" />

      <div class="preview-middle">
        <a href="#" class="btn btn-slack btn-sm">choose another</a>
      </div>
    </label>
  </div>
</template>

<script>
export default {
  data() {
    return {
      imageData: null
    };
  },

  computed: {
    source() {
      return this.imageData ? this.imageData : this.$attrs.value;
    }
  },

  methods: {
    chooseImage() {
      this.$refs.fileInput.click();
    },

    onSelectFile() {
      const input = this.$refs.fileInput;
      const files = input.files;

      if (files && files[0]) {
        // create a new FileReader to read this image and convert to base64 format
        const reader = new FileReader();

        // Define a callback function to run, when FileReader finishes its job
        reader.onload = evt => {
          this.imageData = evt.target.result;
        };

        // Start the reader job - read file as a data url (base64 format)
        reader.readAsDataURL(files[0]);
        this.$emit("input", files[0]);
      }
    }
  }
};
</script>

<style scoped>
.preview-container {
  position: relative;
}

.preview-image {
  opacity: 1;
  height: 200px;
  max-width: 100%;
  transition: 0.5s ease;
}

.preview-middle {
  transition: 0.5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.preview-container:hover .preview-image {
  opacity: 0.7;
}

.preview-container:hover .preview-middle {
  opacity: 1;
}
</style>