<template>
  <div>
    <div class="my-2">
      <span v-for="(image, key) in imagesData" :key="key">
        <img class="thumb" :ref="`image${parseInt( key )}`" @change="onFileChange" />
      </span>
    </div>

    <input class="form-control" type="file" @change="onFileChange" multiple />
  </div>
</template>

<script>
export default {
  data() {
    return {
      imagesData: []
    };
  },

  methods: {
    onFileChange(e) {
      this.imagesData = [];

      var selectedFiles = e.target.files;
      for (var i = 0; i < selectedFiles.length; i++) {
        this.imagesData.push(selectedFiles[i]);
      }

      for (let i = 0; i < this.imagesData.length; i++) {
        let reader = new FileReader(); //instantiate a new file reader

        reader.addEventListener(
          "load",
          function() {
            this.$refs["image" + parseInt(i)][0].src = reader.result;
          }.bind(this),
          false
        ); //add event listener

        reader.readAsDataURL(this.imagesData[i]);
      }

      this.$emit("input", this.imagesData);
    }
  }
};
</script>

<style scoped>
/*  */
</style>