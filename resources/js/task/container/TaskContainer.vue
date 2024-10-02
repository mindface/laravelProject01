<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <add-box @loadListAction="loadListAction()" />
        <list-box ref="ListBox" />
      </div>
      <ImageUpload />
    </div>
  </div>
</template>

<script lang="ts">
import { ref, defineComponent } from "vue";
import AddBox from "../components/AddBox.vue";
import ListBox from "../components/ListBox.vue";
import ImageUpload from "../../common/components/ImageUpload.vue";

export default defineComponent({
  components: {
    AddBox,
    ListBox,
    ImageUpload
  },
  setup() {
    const title = ref("");
    const body = ref("");
    const ListBox = ref();

    const loadListAction = () => {
      ListBox.value.onLoad();
    }

    return {
      title,
      body,
      ListBox,
      loadListAction
    }
  }
});
</script>
