<template>
  <div class="container">
    <h2>画像アップロード</h2>
    <form @submit.prevent="submitImage">
      <input type="file" @change="onFileChange" />
      <button type="submit">アップロード</button>
    </form>
    <div v-if="message">{{ message }}</div>
    <div v-if="imageUrl">
      <img :src="imageUrl" alt="Uploaded Image" width="300px" />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";

export default defineComponent({
  setup() {
    const image = ref(null);
    const message = ref('');
    const imageUrl = ref(''); 

    const onFileChange = (event) => {
      image.value = event.target.files[0];
    };
    const submitImage = async () => {
      if (!image.value) {
        message.value = '画像を選択してください';
        return;
      }

      const formData = new FormData();
      formData.append('image', image.value);
      const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
      const res = await fetch('/upload', {
          method: "POST",
          headers: {
            // 'Content-Type': 'multipart/form-data',
            "X-CSRF-TOKEN": token
          },
          body: formData
        })
      const data = await res.json();
      message.value = data.message;
      imageUrl.value = `/images/${data.image}`;
    };    

    return {
      message,
      imageUrl,
      onFileChange,
      submitImage
    }
  }
})
</script>
