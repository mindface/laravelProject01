<template>
  <div class="container">
    <div class="list-box">
      <transition-group>
        <div class="item" v-for="item in list" :key="item.id">
          <p>{{ item.title }}</p>
          <edit-box :task="item" @loadListAction="onLoad" />
        </div>
      </transition-group>
    </div>
    <div class="dialog-box">
      <button @click="openDialog">画像一覧を表示</button>

      <dialog ref="imageDialog" class="image-list-dialog p-4">
        <h2>画像一覧</h2>
        <button @click="closeDialog">閉じる</button>
        <div class="image-grid">
          <img
            v-for="(image, index) in images"
            class="w-1/2"
            :key="index"
            :src="image"
            alt="画像"
            @click="selectImage(image)"
          />
        </div>
      </dialog>

      <dialog ref="selectedImageDialog" class="image-dialog">
        <h2>選択した画像</h2>
        <button @click="closeSelectedImageDialog">閉じる</button>
        <img :src="selectedImage" alt="選択した画像" />
      </dialog>
    </div>
  </div>
</template>

<script lang="ts">
import { onMounted, ref, defineComponent } from "vue";
import { Api } from "../../helper/helper-api";
import type { Task } from "../model/task";
import EditBox from "./EditBox.vue";
declare const tasks: Task[];
export default defineComponent({
  components: {
    EditBox
  },
  setup() {
    const list = ref<Task[]>([]);
    // index.blade.phpで読み込み
    const _task = tasks as Task[];
    const selectedImageDialog = ref<HTMLDialogElement>();
    const imageDialog = ref<HTMLDialogElement>();
    const selectedImage = ref("");
    const images = ref([
      'https://via.placeholder.com/150/0000FF/FFFFFF?text=Image+1',
      'https://via.placeholder.com/150/FF0000/FFFFFF?text=Image+2',
    ]);

    const onLoad = async () => {
      const data = await Api.getTaskApi();
      list.value = data;
    }

    const getImages = async () => {
      const data = await Api.getImagesApi();
      images.value = data;
      console.log(data);
    }

    onMounted( async () => {
      onLoad();
      getImages();
    });

    const openDialog = () => {
      if(imageDialog.value) {
        imageDialog.value.showModal();
      }
    }
    const closeDialog = () => {
      if(imageDialog.value) {
        imageDialog.value.close();
      }
    }
    const selectImage = (image: string) => {
      selectedImage.value = image;
      if(selectedImageDialog.value) {
        selectedImageDialog.value.showModal();
      }
    }
    const closeSelectedImageDialog = () => {
      if(selectedImageDialog.value) {
        selectedImageDialog.value.close();
      }
    }

    return {
      list,
      images,
      selectedImageDialog,
      imageDialog,
      onLoad,
      openDialog,
      closeDialog,
      selectedImage,
      selectImage,
      closeSelectedImageDialog,
    }
  }
});
</script>

<style>
.list-box {
  padding: 10px;
}

.image-list-dialog {
  max-width: 640px;
  margin: 0 auto;
}

.image-dialog {
  padding: 20px;
  width: 80%;
  max-width: 800px;
}

.image-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 10px;
}

.image-grid img {
  width: 100%;
  cursor: pointer;
  border: 2px solid transparent;
  transition: border 0.3s;
}

.image-grid img:hover {
  border: 2px solid #007bff;
}

.v-enter-active, .v-leave-active {
  transition: all 500ms;
}
.v-enter, .v-leave-to {
  opacity: 0;
}
.v-leave-active {
  position: absolute;
}
</style>
